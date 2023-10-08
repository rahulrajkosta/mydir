<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;

// use App\Http\Controllers\API\%%tblname%%_Controller;
use App\Http\Controllers\API\Category_Controller;
use App\Http\Controllers\API\Cms_images_table_Controller;
use App\Http\Controllers\API\Cms_pages_table_Controller;
use App\Http\Controllers\API\Design_templates_table_Controller;
use App\Http\Controllers\API\Order_items_table_Controller;
use App\Http\Controllers\API\Orders_table_Controller;
use App\Http\Controllers\API\Payment_transactions_table_Controller;
use App\Http\Controllers\API\Product_images_table_Controller;
use App\Http\Controllers\API\Products_table_Controller;
use App\Http\Controllers\API\Promotions_discounts_table_Controller;
use App\Http\Controllers\API\Reviews_ratings_table_Controller;
use App\Http\Controllers\API\Shipping_information_table_Controller;
use App\Http\Controllers\API\Shopping_cart_table_Controller;
use App\Http\Controllers\API\User_design_templates_table_Controller;
use App\Http\Controllers\API\User_designs_table_Controller;
use App\Http\Controllers\API\Users_table_Controller;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
     
// Route::middleware('auth:sanctum')->group( function () {
    // Route::resource('%%tblname%%s', %%tblname%%_Controller::class);
// });

Route::middleware('auth:sanctum')->group( function () {
						Route::resource('category', category_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('cms_images_table', cms_images_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('cms_pages_table', cms_pages_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('design_templates_table', design_templates_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('order_items_table', order_items_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('orders_table', orders_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('payment_transactions_table', payment_transactions_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('product_images_table', product_images_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('products_table', products_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('promotions_discounts_table', promotions_discounts_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('reviews_ratings_table', reviews_ratings_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('shipping_information_table', shipping_information_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('shopping_cart_table', shopping_cart_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('user_design_templates_table', user_design_templates_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('user_designs_table', user_designs_table_Controller::class);});
Route::middleware('auth:sanctum')->group( function () {
						Route::resource('users_table', users_table_Controller::class);});

