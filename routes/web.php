<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index']);

Route::get('/users/index/{type}', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users.index');
Route::get('/users/view/{id}', [App\Http\Controllers\Admin\UsersController::class, 'view'])->name('users.view');
Route::post('/users/view/{id}', [App\Http\Controllers\Admin\UsersController::class, 'view']);

Route::get('/states/get-cities', [App\Http\Controllers\Admin\CommonController::class, 'getCities'])->name('states.get-cities');

Route::get('/subscriptions', [App\Http\Controllers\Admin\SubscriptionsController::class, 'index'])->name('subscriptions.index');

Route::get('/plans/view/{id?}', [App\Http\Controllers\Admin\PlansController::class, 'index'])->name('plans.index');
Route::get('/plans/create', [App\Http\Controllers\Admin\PlansController::class, 'create'])->name('plans.create');
Route::post('/plans/create', [App\Http\Controllers\Admin\PlansController::class, 'create']);
Route::get('/plans/delete/{id}', [App\Http\Controllers\Admin\PlansController::class, 'delete'])->name('plans.delete');
Route::get('/plans/edit/{id}', [App\Http\Controllers\Admin\PlansController::class, 'update'])->name('plans.edit');
Route::post('/plans/edit/{id}', [App\Http\Controllers\Admin\PlansController::class, 'update']);

Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
Route::post('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index']);