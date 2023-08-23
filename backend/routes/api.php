<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Seller\ServiceController;
use App\Http\Controllers\Api\Seller\SellerController as SellerMangeController;
use App\Http\Controllers\Api\Buyer\JobController;
use App\Http\Controllers\Api\Buyer\BuyerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\TermConditionController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OrderController as OrderManageController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\Seller\WithdrawalController;
use App\Http\Controllers\Api\Seller\ReviewsController;

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

Route::post('/register',[AuthController::class,'Register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/forgot_password',[AuthController::class,'forgotPassword']);
Route::post('/change_password',[AuthController::class,'changePassword']);

Route::get('/categories',[CategoryController::class,'index']);
Route::get('/home',[CategoryController::class,'home']);
Route::get('/subcategories/{id}',[CategoryController::class,'subcategories']);
Route::get('/lang-currency',[TermConditionController::class, 'getLangCur']);

Route::get('/categories/{id}/services',[CategoryController::class,'getServicesBySubCategory']);
Route::get('/search',[CategoryController::class,'search']);
Route::get('/seller/services/{id}',[ServiceController::class,'show']);
Route::get('/service/{id}/reviews',[SellerController::class,'getServiceReviews']);

Route::middleware(['auth:sanctum'])->group(function(){


    Route::get('/countries&categories',[CountryController::class,'index']);
    Route::post('/update_password',[AuthController::class,'updatepassword']);

    Route::get('/connect_stripe_account', [PaymentController::class, 'connectStripeAccount']);


    Route::get('/profile',[AuthController::class,'UserProfile']);
    Route::post('/update_profile',[AuthController::class,'updateProfile']);
    Route::post('/store_user_info',[AuthController::class,'storeLatLng']);
    Route::post('/logout',[AuthController::class,'logout']);


    Route::prefix('buyer')->group(function(){
        Route::apiResource('jobs',JobController::class);
        Route::get('/jobs/{id}/offers',[BuyerController::class,'getJobOffers']);
        Route::delete('/delete_job_requests/{id}',[BuyerController::class,'destroy']);

        Route::middleware('checkorder')->group(function() {

            Route::post('/chat_order',[BuyerController::class,'storeChatOrder']);
            Route::post('/custom_order',[BuyerController::class,'customOrder']);

        });
        Route::post('/offer_order',[BuyerController::class,'jobOfferOrder']);

        Route::post('/manage_order',[BuyerController::class,'manageOrder']);
        Route::get('/orders',[BuyerController::class,'show']);

        Route::post('/extend_order_request',[BuyerController::class,'handleOrderExtendTimeRequest']);
    });

    Route::prefix('seller')->group( function () {
        Route::apiResource('services' , ServiceController::class)->except(['show']);
        Route::get('/{id}/reviews',[SellerMangeController::class,'getSellerReviews']);
        Route::get('/buyer_requests',[SellerController::class,'getBuyerRequests']);
        Route::post('/send_offer',[SellerController::class,'sendOffer']);
        Route::delete('/cancel_offer/{id}',[SellerController::class,'cancelOffer']);
        Route::post('/manage_order',[SellerMangeController::class,'manageOrders']);
        Route::get('/orders',[SellerMangeController::class,'show']);
        Route::get('/analytics',[SellerController::class,'getAnalytics']);
        Route::get('/earningDetails',[SellerController::class,'earningDetails']);
        Route::post('/withdrawal_account',[WithdrawalController::class,'addBankAccount']);
        Route::get('/withdrawal_account',[WithdrawalController::class,'BankAccount']);
        Route::get('/withdrawRequest',[WithdrawalController::class,'withdrawRequest']);
        Route::get('/withdrawRequest',[WithdrawalController::class,'getWithdrawalRequest']);
        Route::get('/withdraw',[WithdrawalController::class,'withdrawBalance']);
        Route::get('/serviceReviews',[ReviewsController::class,'serviceReviews']);
        Route::post('/extend_order', [SellerMangeController::class, 'extendOrderDeliveryDays']);
    });

    // from web
    Route::post('/referer_service/{id}', [ServiceController::class, 'getRefererService']);

    Route::post('/serviceclicks',[ServiceController::class,'serviceclicks']);

    Route::post('/become_freelancer',[SellerController::class,'store']);
    Route::get('/order/{id}/activity',[OrderManageController::class,'getTimeline']);
    Route::get('/notification',[NotificationController::class,'index']);
    Route::post('/sendNotifications',[NotificationController::class,'sendNotifications']);
    Route::delete('/notifications/{id}/delete',[NotificationController::class,'delete']);

    // USER WISHLIST
    Route::get('/get_wishlist',[WishlistController::class,'index']);
    Route::post('/wishlist',[WishlistController::class,'wishlist']);
    // CUSTOMER SUPPORT
    Route::post('/customer_support',[TermConditionController::class,'support']);
    Route::get('/get_order/{id}',[OrderManageController::class,'index']);

    Route::post('/token',[PaymentController::class,'create']);

});
Route::get('/term_condition',[TermConditionController::class, 'index']);
