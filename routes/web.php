<?php

use App\Http\Controllers\Admin\LandingComponentController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LandingSectionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/land', [LandingController::class, 'index'])->name('landing');


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
    Route::get('products/{product}/variants/{variant}/edit', [ProductVariantController::class, 'edit'])->name('product.variants.edit');
    Route::put('products/{product}/variants/{variant}', [ProductVariantController::class, 'update'])->name('product.variants.update');
    Route::delete('products/{product}/variants/{variant}', [ProductVariantController::class, 'destroy'])->name('product.variants.destroy');

    // Unit Management
    Route::resource('units', \App\Http\Controllers\Admin\UnitController::class);
    Route::post('units/{unit}/toggle-status', [\App\Http\Controllers\Admin\UnitController::class, 'toggleStatus'])->name('units.toggle-status');



    // Order Management
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'destroy']);
    Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('orders/{order}/update-payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.update-payment-status');
    Route::post('orders/{order}/add-notes', [OrderController::class, 'addNotes'])->name('orders.add-notes');

    // Settings Management
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::post('settings/reset', [SettingController::class, 'reset'])->name('settings.reset');


    Route::resource('attributes', AttributeController::class);

    Route::prefix('attributes/{attribute}')->group(function () {
        Route::resource('values', AttributeValueController::class);
    });
});


Route::get('/product-variant', [ProductVariantController::class, 'getProductVariants'])->name('product.get-variants');


// Fallback routes for compatibility
Route::get('/password/reset', function () {
    return redirect()->route('login')->with('info', 'পাসওয়ার্ড রিসেট ফিচার শীঘ্রই আসছে।');
})->name('password.request');

Route::get('/register', function () {
    return redirect()->route('login')->with('info', 'নিবন্ধন ফিচার শীঘ্রই আসছে।');
})->name('register');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('sections', SectionController::class);
    Route::post('sections/reorder', [SectionController::class, 'reorder'])->name('sections.reorder');
});
