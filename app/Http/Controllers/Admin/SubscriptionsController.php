<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;

class SubscriptionsController extends Controller
{
    public function index()
    {
        $subscription = Subscription::all();

        return view('admin.subscriptions.index', [
            "subscription" => $subscription,
        ]);
    }
}
