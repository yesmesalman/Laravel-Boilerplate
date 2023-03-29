<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CommonController;
use App\Http\Controllers\API\SubscriptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('forgot-password', [UserController::class, 'forgotPassword']);
Route::post('reset-password', [UserController::class, 'resetPassword']);
Route::post('social-authentication', [UserController::class, 'socialAuthentication']);

// Common APIs
Route::post('get-countries/{id?}', [CommonController::class, 'getCountries']);
Route::post('get-states/{id}', [CommonController::class, 'getStates']);
Route::post('get-cities/{id}', [CommonController::class, 'getcities']);
Route::post('terms-and-condition', [CommonController::class, 'termsAndCondition']);
Route::post('privacy-policy', [CommonController::class, 'privacyPolicy']);

Route::middleware('auth:api')->group(function () {
    Route::group(['middleware' => 'check.user'], function () {
        Route::post('logout', [UserController::class, 'logout']);

        Route::post('edit-profile', [UserController::class, 'editProfile']);
        Route::post('edit-profile/upload-picture', [UserController::class, 'uploadPicture']);
        Route::post('get-profile-details', [UserController::class, 'getProfileDetails']);

        Route::post('create-chat-room', [UserController::class, 'createChatRoom']);
        Route::post('get-all-chats-rooms', [UserController::class, 'getAllChatsRooms']);

        Route::post('get-plans', [SubscriptionController::class, 'getPlans']);
        Route::post('purchase-plan', [SubscriptionController::class, 'purchasePlan']);

        Route::post('update-card', [SubscriptionController::class, 'updateCard']);
    });
});
