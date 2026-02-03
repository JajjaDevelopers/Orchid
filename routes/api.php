<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Dashboard\ContactUsController;
use App\Http\Controllers\MentorshipController;
use App\Http\Controllers\Dashboard\SubscriberController;

// Publicly accessible API routes

// Route::get('/blogs', [BlogController::class, 'getAllBlogs']);

// // Route to fetch a specific document by its ID
// Route::get('/blogs/{id}', [BlogController::class, 'getSingleBlog']);

// //Route to create subscriber
// Route::post('/subscriber', [SubscriberController::class,'store']);
// //Route to confrm subscriber subscription
// Route::get('/subscriber/confirm/{token}', [SubscriberController::class,'confirmSubscription']);
// Route::get('/unsubscribe/{email}', [SubscriberController::class, 'unsubscribe'])->name('unsubscribe');

// //Route to store contact us info
// Route::post('/contact', [ContactUsController::class,'Store']);
//route to get users info
// Route::get('/users', [UserController::class, 'getUsers']);

// restricted access api routes
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
