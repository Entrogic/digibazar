<?php

use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/checkout/product/{product}', [CheckoutController::class, 'product'])->name('checkout.product');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success/{orderNumber}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/track-order', [CheckoutController::class, 'trackForm'])->name('track.form');
Route::post('/track-order', [CheckoutController::class, 'trackOrder'])->name('track.order');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Category Management
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');

    //Banner Management 
    Route::resource('banners', BannerController::class);

    // Product Management
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::post('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('products.toggle-featured');
    Route::get('products/{product}/variants/create', [ProductVariantController::class, 'create'])->name('product.variants.create');
    Route::post('products/{product}/variants', [ProductVariantController::class, 'store'])->name('product.variants.store');

    Route::get('/product-variant',[ProductVariantController::class, 'getProductVariants'])->name('product.get-variants');

    // Order Management
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'destroy']);
    Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('orders/{order}/update-payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.update-payment-status');
    Route::post('orders/{order}/add-notes', [OrderController::class, 'addNotes'])->name('orders.add-notes');

    // Settings Management
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('settings/reset', [SettingController::class, 'reset'])->name('settings.reset');
});

// Fallback routes for compatibility
Route::get('/password/reset', function () {
    return redirect()->route('login')->with('info', 'পাসওয়ার্ড রিসেট ফিচার শীঘ্রই আসছে।');
})->name('password.request');

Route::get('/register', function () {
    return redirect()->route('login')->with('info', 'নিবন্ধন ফিচার শীঘ্রই আসছে।');
})->name('register');
