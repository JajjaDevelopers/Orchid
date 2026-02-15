<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\ContactUsController;
use App\Http\Controllers\Dashboard\EventController;
use App\Http\Controllers\Dashboard\FrontPageCms;
use App\Http\Controllers\Dashboard\GalleryController;
use App\Http\Controllers\Dashboard\NewsletterController;
use App\Http\Controllers\Dashboard\SermonsController;
use App\Http\Controllers\Dashboard\SubscriberController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::post('/comment/store/', [BlogController::class, 'storeComment'])->name('comment.store');
Route::prefix('orchid')->name('orchid.')->group(function () {
    Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
    Route::get('/aboutus', [PageController::class, 'aboutus'])->name('aboutus');
    Route::get('/events', [PageController::class, 'events'])->name('events');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
    Route::get('/blog/detailed/{slug}', [PageController::class,'blogDetailed'])->name('blog.detailed');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Protected dashboard route, redirect to admin dashboard upon authentication
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group admin routes under a common name prefix with auth middleware
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard'); // Admin dashboard
    //cms
    Route::get('/front/cms',[FrontPageCms::class,'index'])->name('front.content');
    Route::post('/front/cms',[FrontPageCms::class,'storeOrUpdate'])->name('frontpage.update');
//Blog routes
    Route::get('/blog/view', [BlogController::class, 'index'])->name('blog.view');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

//gallery images
 Route::resource('gallery', GalleryController::class);

//Sermons routes
    Route::get('/sermon/view', [SermonsController::class, 'index'])->name('sermons.view');
    Route::get('/sermon/create', [SermonsController::class, 'create'])->name('sermons.create');
    Route::post('/sermon/store', [SermonsController::class, 'store'])->name('sermons.store');
    Route::get('/sermon/edit/{id}', [SermonsController::class, 'edit'])->name('sermons.edit');
    Route::put('/sermon/update/{id}', [SermonsController::class, 'update'])->name('sermons.update');
    Route::delete('/sermon/destroy/{id}', [SermonsController::class, 'destroy'])->name('sermons.destroy');
 //events
    Route::get('/event/view', [EventController::class, 'index'])->name('event.view');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/event/update/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/destroy/{id}', [EventController::class, 'destroy'])->name('event.destroy');

//Subscriber routes
    Route::get('/subscriber/view', [SubscriberController::class,'index'])->name('subscriber.view');
    Route::get('/subscriber/create', [SubscriberController::class, 'create'])->name('subscriber.create');
    Route::post('/subscriber/store', [SubscriberController::class, 'store'])->name('subscriber.store');
    Route::get('/subscriber/edit/{id}', [SubscriberController::class, 'edit'])->name('subscriber.edit');
    Route::put('/subscriber/update/{id}', [SubscriberController::class, 'update'])->name('subscriber.update');
    Route::delete('/subscriber/destroy/{id}', [SubscriberController::class, 'destroy'])->name('subscriber.destroy');

//Newsletter routes
    Route::get('/newsletter/view', [NewsletterController::class,'index'])->name('newsletter.view');
    Route::get('/newsletter/create', [NewsletterController::class, 'create'])->name('newsletter.create');
    Route::post('/newsletter/store', [NewsletterController::class, 'store'])->name('newsletter.store');
    Route::post('/newsletter/send/{id}', [NewsletterController::class, 'send'])->name('newsletter.send');
    Route::get('/newsletter/edit/{id}', [NewsletterController::class, 'edit'])->name('newsletter.edit');
    Route::put('/newsletter/update/{id}', [NewsletterController::class, 'update'])->name('newsletter.update');
    Route::delete('/newsletter/destroy/{id}', [NewsletterController::class, 'destroy'])->name('newsletter.destroy');

//contact routes
    Route::get('/contacts/view', [ContactUsController::class,'index'])->name('contact.view');
    Route::get('/contact/details/{id}', [ContactUsController::class, 'show'])->name('contact.detail');
    Route::delete('/contact/destroy/{id}', [ContactUsController::class, 'destroy'])->name('contact.destroy');
    Route::post('/contact/reply/{id}', [ContactUsController::class, 'reply'])->name('contact.reply');
    Route::get('/contact/replied/{id}', [ContactUsController::class, 'markReplied'])->name('contact.mark-replied');

//users routes
    Route::get('/user/view', [UserController::class, 'index'])->name('user.view');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

//categories
    Route::get('/categories/get', [AdminController::class, 'blogCategories'])->name('categories');
    Route::post('/categories/store', [AdminController::class, 'store'])->name('categories.store');
});


Route::middleware('auth')->group(function () {
    Route::get('prbc/profile', [ProfileController::class, 'editUser'])->name('prbc.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route to create subscriber
Route::post('/subscriber', [SubscriberController::class,'store'])->name('subscription.store');
//Route to confrm subscriber subscription
Route::get('/subscriber/confirm/{token}', [SubscriberController::class,'confirmSubscription']);
Route::get('/unsubscribe/{email}', [SubscriberController::class, 'unsubscribe'])->name('unsubscribe');
Route::get('/event/register/{slug}', [EventController::class, 'register'])->name('event.register');
Route::post('/event/register', [EventController::class, 'storeRegister'])->name('event.register.store');

//Route to store contact us info
Route::post('/contact', [ContactUsController::class,'Store'])->name('contact.store');

require __DIR__ . '/auth.php';