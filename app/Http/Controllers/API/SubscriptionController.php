<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\UserCard;
use App\Http\Controllers\StripeController;

class SubscriptionController extends Controller
{
    public function getPlans()
    {
        $response = [
            'status' => 200,
            'message' => "",
            'data' => [
                "plans" => getPlans()
            ]
        ];

        return response()->json($response, 200);
    }

    public function purchasePlan(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'plan_id' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                throw new \ErrorException($validator->errors()->first());
            }

            $plan = Plan::where('id', $request->plan_id)->first();

            if ($plan == null) {
                throw new \ErrorException('Invalid plan');
            }

            $card = UserCard::where('user_id', $request->user()->id)->where('status', 1)->orderby('updated_at', 'DESC')->first();

            if ($card == null) {
                throw new \ErrorException('Card details not found');
            }

            $stripe = new StripeController();
            $token = $stripe->createCardToken([
                'number' => $card->number,
                'exp_month' => $card->exp_month,
                'exp_year' => $card->exp_year,
                'cvc' => $card->cvc,
            ]);
            $customer = $stripe->createCustomer($request->user()->email, $token);
            $charge = $stripe->chargeCustomer($customer, $plan->price * 100);

            // Record Payment
            $payment = new Payment();
            $payment->user_id = $request->user()->id;
            $payment->amount = $plan->price;
            $payment->plan_id = $plan->id;
            $payment->token_response = json_encode($token);
            $payment->customer_response = json_encode($customer);
            $payment->charge_response = json_encode($charge);
            $payment->created_at = date('Y-m-d H:i:s');
            $payment->updated_at = date('Y-m-d H:i:s');
            $payment->save();

            $response = [
                'status' => 200,
                'message' => "Congratulations!, Plan purchased successfully"
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function updateCard(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'number' => 'required|digits:16',
                'exp_month' => 'required|digits:2',
                'exp_year' => 'required|digits:2',
                'cvc' => 'required|digits:3'
            ]);

            if ($validator->fails()) {
                throw new \ErrorException($validator->errors()->first());
            }

            $card = UserCard::where('user_id', $request->user()->id)->where('number', $request->number)->first();

            if ($card == null) {
                $card = new UserCard();
                $card->user_id = $request->user()->id;
            }

            $card->name = $request->name;
            $card->number = $request->number;
            $card->exp_month = $request->exp_month;
            $card->exp_year = $request->exp_year;
            $card->cvc = $request->cvc;
            $card->save();

            $response = [
                'status' => 200,
                'message' => 'Card saved'
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
