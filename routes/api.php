<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagePostController;
use App\Http\Controllers\ProfilePhotosController;

Route::post("register", [UserController::class, "register"]);
Route::post("login", [UserController::class, "login"]);

Route::get('getAll', [UserController::class, 'allUser']);

Route::middleware('auth:api')->group(function () {
    Route::post("logout", [UserController::class, "logout"]);
    Route::get("showUser", [UserController::class, "getUserData"]);
    Route::put("updateUser", [UserController::class, "update"]);
    Route::get("viewUser/{id}", [UserController::class, "getUserDetails"]);  
    Route::post('manage-posts', [ManagePostController::class, 'store']);
    Route::post('manage-profile', [ProfilePhotosController::class, 'setProfilePhoto']);
    Route::get('get-posts', [ManagePostController::class, 'getPost']);
    Route::post("searchUser", [UserController::class, 'findUser']);
    
    // Route::resource('customer', CustomerController::class);
    // Route::resource('product', ProductController::class);
    // Route::resource('order', OrderController::class);
    // Route::resource('order-item', OrderItemController::class);
    // Route::get('orders/challan', [OrderController::class, "challan"]);
    // Route::delete('challan/{id}', [OrderController::class, "challanDelete"]);
    // Route::get('customer/orders/{id}', [CustomerController::class, 'orders']);
    // Route::get('invoice/{id}', [PDFController::class, 'invocePDF']);
    // Route::get('challan/{id}', [PDFController::class, 'challanPDF']);
    // Route::get('dashboard', [HomeController::class, 'index']);
    
});
