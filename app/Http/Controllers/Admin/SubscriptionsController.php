<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class SubscriptionsController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::all();

        return view('admin.subscriptions.index', [
            "payments" => $payments,
        ]);
    }
}
