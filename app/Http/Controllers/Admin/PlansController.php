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
            "plans" => $plans,
            "lead_price" => getLeadPrice()
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => ['required', 'string', 'unique:plans'],
                'slug' => ['required', 'string', 'unique:plans'],
                'price' => ['required', 'numeric'],
            ]);

            $plan = new Plan();
            $plan->name = $request->name;
            $plan->slug = $request->slug;
            $plan->stripe_plan = $request->slug;
            $plan->price = $request->price;
            $plan->description = $request->description;

            if ($plan->save()) {
                return Redirect::back()->with(['flash_success' => "Congratulations!, Plan has been created."]);
            }

            return Redirect::back()->with(['flash_error' => "Oops!, Something went wrong."]);
        }

        return view('admin.plans.create');
    }

    public function delete($id)
    {
        $plan = Plan::where('id', $id)->first();

        if ($plan == null) {
            return Redirect::back()->with(['flash_error' => "Oops!, Invalid Plan."]);
        }

        if ($plan->delete()) {
            return Redirect::back()->with(['flash_success' => "Congratulations!, Plan has been removed."]);
        }

        return Redirect::back()->with(['flash_error' => "Oops!, Something went wrong."]);
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::where('id', $id)->first();

        if ($plan == null) {
            return Redirect::back()->with(['flash_error' => "Oops!, Invalid Plan."]);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => ['required', 'string'],
                'slug' => ['required', 'string'],
                'price' => ['required', 'numeric'],
            ]);

            $plan->name = $request->name;
            $plan->slug = $request->slug;
            $plan->stripe_plan = $request->slug;
            $plan->price = $request->price;
            $plan->description = $request->description;

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
