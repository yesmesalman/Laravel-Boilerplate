<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plan;

class SubscriptionController extends Controller
{
    public function getPlans(Request $request)
    {
        $user = $request->user();

        $response = [
            'status' => 200,
            'message' => "",
            'data' => [
                "plans" => Plan::where('status','1')->get(),
                'user' => $user->getUserDisplayFields()
            ]
        ];

        return response()->json($response, 200);
    }

    public function purchasePlan(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'plan_id' => 'required|numeric',
                'number' => 'required|digits:16',
                'exp_month' => 'required|digits:2',
                'exp_year' => 'required|digits:2',
                'cvc' => 'required|digits:3'
            ]);

            if ($validator->fails()) {
                throw new \ErrorException($validator->errors()->first());
            }

            $plan = Plan::where('id', $request->plan_id)->first();

            if ($plan == null) {
                throw new \ErrorException('Invalid plan');
            }

            $user = $request->user();

            $user->createOrGetStripeCustomer();
            $user->createSetupIntent();
            $stripe = new \Stripe\StripeClient('sk_test_51J8ROIFyJKeHlHtSctFzqEuHniCT9mjHKR774MZtpNBu2V07cnqBdHpyhAWgO5ZVvHFWeUGiygTeOwKQBI9WcIJc00fjPD0PCR');
            $paymentMethods = $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => $request->number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);
            $paymentMethods = $user->addPaymentMethod($paymentMethods);
            $request->user()->newSubscription(
                $plan->name,
                $plan->price_id
            )->create($paymentMethods->id);


            $response = [
                'status' => 200,
                'message' => "Congratulations!, Plan purchased successfully",
                'data' => [
                    'user' => $user->getUserDisplayFields(),
                ]
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function cancelPlan(Request $request, Plan $plan)
    {
        $user = $request->user();
        $user->subscription($plan->name)->cancel();

        $response = [
            'status' => 200,
            'message' => "Subscription cancelled successfully",
            'data' => [
                "user" => $user->getUserDisplayFields(),
            ]
        ];
        return response()->json($response, 200);
    }
}
