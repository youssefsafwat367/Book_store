<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Track_orderController;
use App\Http\Controllers\RefundPolicyController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Models\Branch;
use App\Models\Cart;

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



Auth::routes(['verify' => true]);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', function () {
        return view('welcome');
    });
Route::middleware(['User'])->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');
    Route::get('/favorites/{id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/delete/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get(
    '/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/checkout/{total}', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/order_details/{id}', [OrderController::class, 'order_details'])->name('order_details');
    Route::get('/account_details', [ProfileController::class, 'account_details'])->name('account_details');
    Route::get('/track-order', [Track_orderController::class, 'index'])->name('track-order');
    Route::post('/cart/{id}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/delete/{cart_id}', [CartController::class, 'destroy'])->name('cart.delete');
    Route::post('/order/store/{total}', [OrderController::class, 'create'])->name('order.confirm');
    Route::post('/user/update/{id}', [ProfileController::class, 'update'])->name('user.update');
    Route::post('/user/update/password/{id}', [ProfileController::class, 'update_password'])->name('user.update_password');
});
Route::get('/books', [BookController::class, 'index'])->name('books');
Route::get('/books/{id}', [BookController::class, 'show'])->name('specific-books');
Route::get('/', [IndexController::class, 'index'])->name('homePage');
Route::get('/branches', [BranchController::class, 'index'])->name('branches');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/refund-policy', [RefundPolicyController::class, 'index'])->name('refund-policy');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('specific-book');

Route::middleware('Admin')->group(function () {
    Route::view('/admin/home', 'admin.home')->name('admin.home');
    // users
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
    //categories
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
    //contacts
    Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts');
    Route::post('/admin/contacts/store', [ContactController::class, 'store'])->name('admin.contacts.store');
    Route::get('/admin/contacts/edit/{id}', [ContactController::class, 'edit'])->name('admin.contacts.edit');
    Route::put('/admin/contacts/update/{id}', [ContactController::class, 'update'])->name('admin.contacts.update');
    Route::delete('/admin/contacts/delete/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.delete');
    //products
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/delete/{id}', [ProductController::class, 'destroy'])->name('admin.products.delete');
    //branches
    Route::get('/admin/branches', [BranchController::class, 'index'])->name('admin.branches');
    Route::post('/admin/branches/store', [BranchController::class, 'store'])->name('admin.branches.store');
    Route::get('/admin/branches/edit/{id}', [BranchController::class, 'edit'])->name('admin.branches.edit');
    Route::put('/admin/branches/update/{id}', [BranchController::class, 'update'])->name('admin.branches.update');
    Route::delete('/admin/branches/delete/{id}', [BranchController::class, 'destroy'])->name('admin.branches.delete');
    //sliders
    Route::get('/admin/sliders', [SliderController::class, 'index'])->name('admin.sliders');
    Route::post('/admin/sliders/store', [SliderController::class, 'store'])->name('admin.sliders.store');
    Route::get('/admin/sliders/edit/{id}', [SliderController::class, 'edit'])->name('admin.sliders.edit');
    Route::put('/admin/sliders/update/{id}', [SliderController::class, 'update'])->name('admin.sliders.update');
    Route::delete('/admin/sliders/delete/{id}', [SliderController::class, 'destroy'])->name('admin.sliders.delete');
    //orders
    Route::get('/admin/orders', [OrderController::class, 'admin_orders'])->name('admin.orders');
    Route::put('/admin/orders/confirm/{id}', [OrderController::class, 'confirm'])->name('admin.orders.confirm');
    Route::put('/admin/orders/received/{id}', [OrderController::class, 'received'])->name('admin.orders.received');

});
