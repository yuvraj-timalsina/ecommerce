<?php

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;

Route::get('/', HomeComponent::class)->name('home');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/cart', CartComponent::class)->name('shop.cart');
Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});


Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});

Route::middleware(['auth', 'auth.admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
});

require __DIR__ . '/auth.php';
