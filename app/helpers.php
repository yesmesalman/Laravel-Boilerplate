<?php

use Khsing\World\Models\Country;
use Khsing\World\Models\Division;
use App\Models\Plan;
use App\Models\Service;
use App\Models\Wallet;
use App\Models\Setting;


function getAllCountries()
{
    return Country::get([
        "id",
        "name",
        "full_name"
    ]);
}

function getCountry($id)
{
    return Country::where('id', $id)->first();
}

function getStates($id)
{
    $country = Country::where('id', $id)->first();
    return $country->divisions()->get();
}

function getCities($id)
{
    $model = Division::where('id', $id)->first();

    return $model->children();
}

function getPlans()
{
    $models = Plan::get([
        "id",
        "name",
        "slug",
        "stripe_plan",
        "price",
        "description"
    ]);

    return $models;
}

function getServices()
{
    $models = Service::get([
        "id",
        "name",
        "description",
        "status",
    ]);

    return $models;
}

function getLeadPrice()
{
    $lead_price = 10;

    $lead_setting = Setting::where('key', 'lead_price')->first();

    return $lead_setting ? $lead_setting->value : $lead_price;
}

function checkIfUserCanBuyLead($user)
{
    $userBalances = getUserBalances($user);
    $userBalance = $userBalances["total"] - $userBalances["usage"];

    return $userBalance >= getLeadPrice();
}

// function topUpWallet($user_id, $payment_id, $amount)
// {
//     $wallet = new Wallet();
//     $wallet->user_id = $user_id;
//     $wallet->payment_id = $payment_id;
//     $wallet->amount = $amount;
//     $wallet->used = 0;
//     $wallet->save();

//     return $wallet;
// }

function chargeWalletForLead($user_id, $lead_id)
{
    $wallet = new Wallet();
    $wallet->user_id = $user_id;
    $wallet->lead_id = $lead_id;
    $wallet->amount = getLeadPrice();
    $wallet->used = 1;
    $wallet->save();

    return $wallet;
}
