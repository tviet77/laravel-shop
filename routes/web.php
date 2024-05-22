<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

# Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/products/{slug}', [FrontendController::class, 'productDetail'])->name('product-detail');

# Shop
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('/add-to-cart-form', [CartController::class, 'addToCartForm'])->name('add-to-cart-form');
Route::get('/shop', [FrontendController::class, 'showShop'])->name('shop');
Route::get('/product-category/{slug}', [FrontendController::class, 'getProductByCategory'])->name('product-category');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/check-out', [CartController::class, 'checkOut'])->name('cart.checkOut');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/check-out', [cartController::class, 'handleCheckOut'])->name('cart.checkOut.handle');
Route::get('/thank-you', [FrontendController::class, 'thankYou'])->name('thank-you');
Route::get('/confirm-order/{token}', [FrontendController::class, 'confirmOrder'])->name('confirm-order');

# Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'handleLogin'])->name('admin.handleLogin');
    Route::middleware('auth:admin')->group(function () {
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');

        Route::prefix('profile')->group(function () {
            Route::get('/', [AdminController::class, 'profile'])->name('admin.profile');
            Route::post('/update/profile/{id}', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
            Route::post('/update/password/{id}', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
        });

        Route::get('/', function () {
            return view('home');
        })->name('admin.home');
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index')->middleware('can:category-list');
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('can:category-create');
            Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('categories.update')->middleware('can:category-update');
            Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete')->middleware('can:category-delete');
        });

        Route::prefix('menus')->group(function () {
            Route::get('/index', [MenuController::class, 'index'])->name('menus.index');
            Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
            Route::post('/store', [MenuController::class, 'store'])->name('menus.store');
            Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menus.edit');
            Route::post('update/{id}', [MenuController::class, 'update'])->name('menus.update');
            Route::get('/delete/{id}', [MenuController::class, 'delete'])->name('menus.delete');
        });

        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/store', [ProductController::class, 'store'])->name('products.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('update/{id}', [ProductController::class, 'update'])->name('products.update');
            Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
        });

        Route::prefix('sliders')->group(function () {
            Route::get('/', [SliderController::class, 'index'])->name('sliders.index');
            Route::get('/create', [SliderController::class, 'create'])->name('sliders.create');
            Route::post('/store', [SliderController::class, 'store'])->name('sliders.store');
            Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('sliders.edit');
            Route::post('update/{id}', [SliderController::class, 'update'])->name('sliders.update');
            Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('sliders.delete');
        });

        Route::prefix('setting')->group(function () {
            Route::get('/', [AdminSettingController::class, 'index'])->name('settings.index');
            Route::get('/create', [AdminSettingController::class, 'create'])->name('settings.create');
            Route::post('/store', [AdminSettingController::class, 'store'])->name('settings.store');
            Route::get('/edit/{id}', [AdminSettingController::class, 'edit'])->name('settings.edit');
            Route::post('update/{id}', [AdminSettingController::class, 'update'])->name('settings.update');
            Route::get('/delete/{id}', [AdminSettingController::class, 'delete'])->name('settings.delete');
        });

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('update/{id}', [UserController::class, 'update'])->name('users.update');
            Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
        });

        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
            Route::post('update/{id}', [RoleController::class, 'update'])->name('roles.update');
            Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
        });

        Route::prefix('permissions')->group(function () {
            Route::get('/create',[PermissionController::class, 'create'])->name('permissions.create');
            Route::post('/store',[PermissionController::class, 'store'])->name('permissions.store');
        });

        Route::prefix('order')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('order.index');
            Route::get('/detail-order/{id}', [OrderController::class, 'detailOrder'])->name('order.detail');
            Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');
        });
    });
});


