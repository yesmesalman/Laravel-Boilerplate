<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Plan;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            "monthly_earning" => 100,
            "annual_earning" => 1500,
            "total_leads" => 1548,
            "total_assigned_leads" => 1000,
            "earning_overview" => [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
            "revenue_sources_labels" => ["Direct", "Referral", "Social"],
            "revenue_sources_data" => [55, 30, 15],
        ]);
    }
}
