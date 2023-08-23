<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\LanguageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\StripeWebhookController;
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


Route::view('verification-success', 'Auth.verification-success');

Route::group(['middleware' => 'admin'], function () {
    Route::view('/', 'index')->name('home');
    Route::view('/buyers', 'admin.users');
    Route::view('/sellers', 'admin.users');
    Route::view('/sub_categories', 'admin.sub_category');
    Route::view('/categories', 'admin.category');
    Route::view('/languages', 'admin.language');
    Route::view('/currencies', 'admin.currency');
    Route::view('/payments', 'admin.payments');
    Route::view('/withdrawal_requests', 'admin.withdrawal_requests');

    Route::GET('/', [DashboardController::class, 'index']);
    Route::POST('changeAdminPassword', [DashboardController::class, 'changeAdminPassword']);

    Route::POST('/registerUser', [AuthController::class, 'registerUser']);
    Route::GET('/deleteUser', [UserController::class, 'deleteUser']);
    Route::GET('/updateUser', [UserController::class, 'updateUser']);
    Route::POST('/updateUser', [UserController::class, 'editUser']);

    Route::POST('/addCategory', [CategoryController::class, 'addCategory']);
    Route::GET('/deteleCategory', [CategoryController::class, 'deteleCategory']);
    Route::GET('/updateCategory', [CategoryController::class, 'updateCategory']);
    Route::POST('/updateCategory', [CategoryController::class, 'editCategory']);


    Route::POST('/addsubCategory', [CategoryController::class, 'addsubCategory']);
    Route::GET('/deleteSubCategory', [CategoryController::class, 'deleteSubCategory']);
    Route::POST('/updatesubCategory', [CategoryController::class, 'editsubCategory']);
    Route::GET('/updatesubCategory', [CategoryController::class, 'updateSubCategory']);

    Route::POST('/addlanguage', [LanguageController::class, 'addlangauge']);
    Route::GET('/deleteLanguage', [LanguageController::class, 'deleteLanguage']);
    Route::POST('/updatelanguage', [LanguageController::class, 'editlanguage']);
    Route::GET('/updatelanguage', [LanguageController::class, 'updatelanguage']);


    Route::POST('/addcurrency', [CurrencyController::class, 'addcurrency']);
    Route::GET('/deleteCurrency', [CurrencyController::class, 'deleteCurrency']);
    Route::GET('/updateCurrency', [CurrencyController::class, 'updateCurrency']);
    Route::POST('/updateCurrency', [CurrencyController::class, 'editCurrency']);
});

// verify
Route::get('/email/verify/{id}', [AuthController::class, 'VerifyEmail']);

Route::get('/login', [AuthController::class, 'index']);

Route::POST('/login', [AuthController::class, 'login']);
Route::GET('/logout', [AuthController::class, 'logout']);

Route::view('forget-password', 'Auth.forgot-password');
Route::view('/privacy-policy', 'privacy-policy-english');
Route::view('/fi/privacy-policy', 'privacy-policy-finch');

// webooks stripe
Route::post('stripe_web_hooks', StripeWebhookController::class)->name('direct_stripe_webhook');
Route::post('connect/stripe_web_hooks', StripeWebhookController::class)->name('connect_stripe_webhook');