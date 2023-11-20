<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicityController;

Route::get('/{user_id?}', [ProductController::class, 'showProduct']);
Route::get('/cart-count', [ProductController::class, 'showCartCount']);
Route::get('/cart-item-quantity/{user_id}', [ProductController::class, 'showCartItemQuantity']);
Route::post('/register', [UserController::class, 'store']);
Route::post('/profile/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/my-profile/{id}', [UserController::class, 'show']);
Route::post('/update-profile/{user_id}', [UserController::class, 'update']);
Route::get('/view/home/{id?}', [ProductController::class, 'showAdminHome']);
Route::get('/view/order', [ProductController::class, 'showOrderAdmin']);
Route::post('/order/{product_id}', [ProductController::class, 'findProduct']);
Route::get('/profile/{id}', [UserController::class, 'profile']);
Route::get('/view/add-product', [ProductController::class, 'addProductView']);
Route::post('/add-product', [ProductController::class, 'addProduct']);
Route::get('/cart/{user_id}', [ProductController::class, 'listCartItems']);
Route::post('/cart/{user_id}', [ProductController::class, 'cancelCartOrder']);
Route::post('/add-to-cart/{product_id}/{user_id}', [ProductController::class, 'insertToCart']);
Route::post('/cart/delete-product/{product_id}/{user_id}', [ProductController::class, 'deleteCartItem']);
Route::post('/cart/add-product-quantity/{cart_id}/{user_id}', [ProductController::class, 'addQuantity']);
Route::post('/cart/subtract-product-quantity/{cart_id}/{user_id}', [ProductController::class, 'subtractQuantity']);
Route::post('/cart/confirm-order/{user_id}', [ProductController::class, 'confirmOrder']);
Route::get('/confirm-order/{user_id}', [ProductController::class, 'showOrderItem']);
Route::post('/confirm-order/{user_id}', [ProductController::class, 'storeOrder']);
Route::get('/order/{user_id}', [ProductController::class, 'showOrder']);
Route::get('/view/show-client', [UserController::class, 'showClient']);
Route::get('/view/show-product', [ProductController::class, 'showProductAdmin']);
Route::get('/view/publicity', [PublicityController::class, 'show']);
Route::post('/add-publicity', [PublicityController::class, 'storePub']);
Route::post('/delete-publicity/{id}', [PublicityController::class, 'delete']);
Route::post('/order/accept-order/{order_id}', [ProductController::class, 'updateStatusToExecuting']);
Route::post('/order/finish-order/{order_id}', [ProductController::class, 'updateStatusToFinished']);
Route::post('/store-sale/{order_id}', [ProductController::class, 'storeSale']);
Route::get('/view/show-all-products', [ProductController::class, 'showAllProducts']);
Route::get('/view/show-sales', [ProductController::class, 'showSales']);
Route::post('/edit-product/{product_id}', [ProductController::class, 'editProduct']);