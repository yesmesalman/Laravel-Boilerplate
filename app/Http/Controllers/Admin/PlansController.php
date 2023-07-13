<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Redirect;

class PlansController extends Controller
{
    public function index(Request $request, $id = null)
    {
        $plans = Plan::all();

        if ($id != null) {
            $plans = Plan::where("id", $id)->get();
        }

        return view('admin.plans.index', [
            "plans" => $plans
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => ['required', 'string', 'unique:plans'],
                'slug' => ['required', 'string', 'unique:plans'],
                'price' => ['required', 'numeric'],
                'recurring' => 'required',
            ]);

            $plan = new Plan();
            $plan->name = $request->name;
            $plan->slug = $request->slug;
            $plan->stripe_plan = $request->slug;
            $plan->price = $request->price;
            $plan->recurring = $request->recurring;
            $plan->currency = $request->currency;
            $plan->description = $request->description;

            if ($plan->save()) {
                $stripe = new \Stripe\StripeClient('sk_test_51J8ROIFyJKeHlHtSctFzqEuHniCT9mjHKR774MZtpNBu2V07cnqBdHpyhAWgO5ZVvHFWeUGiygTeOwKQBI9WcIJc00fjPD0PCR');
                $product_detail = $stripe->products->create([
                    'name' => $request->name,
                ]);

                $product_id = $product_detail->id;
                $plan_price = $stripe->prices->create([
                    'unit_amount' => $request->price * 100,
                    'currency' => $request->currency,
                    'recurring' => ['interval' => $request->recurring], // it defines the recurring interval
                    'product' => $product_id,
                ]);
                $plan->price_id = $plan_price->id;
                $plan->save();
                return Redirect::back()->with(['flash_success' => "Congratulations!, Plan has been created."]);
            }

            return Redirect::back()->with(['flash_error' => "Oops!, Something went wrong."]);
        }

        return view('admin.plans.create');
    }



    public function update(Request $request, $id)
    {
        $plan = Plan::where('id', $id)->first();

        if ($plan == null) {
            return Redirect::back()->with(['flash_error' => "Oops!, Invalid Plan."]);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'mode' => 'required',
            ]);

            $plan->mode = $request->mode;

            if ($plan->save()) {
                return Redirect::back()->with(['flash_success' => "Congratulations!, Plan has been updated."]);
            }

            return Redirect::back()->with(['flash_error' => "Oops!, Something went wrong."]);
        }

        return view('admin.plans.edit', [
            "plan" => $plan
        ]);
    }
}
