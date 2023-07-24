<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionsController extends Controller
{
    public function index(Request $request)
    {
        $subscription = Subscription::all();
        if ($request->ajax()) {
            return DataTables::of($subscription)
                ->addIndexColumn()
                ->addColumn('created_at', function (Subscription $subscription) {
                    return $subscription->getCreatedAtForHumans();
                })
                ->addColumn('user_name', function (Subscription $subscription) {
                    return $subscription->user->name;
                })
                ->addColumn('plan_name', function (Subscription $subscription) {
                    return $subscription->plan->name;
                })
                ->addColumn('amount', function (Subscription $subscription) {
                    return $subscription->plan->amount;
                })
                ->make(true);
        }
        return view('admin.subscriptions.index');
    }
}
