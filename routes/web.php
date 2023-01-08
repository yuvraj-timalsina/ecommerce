<?php

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CheckoutComponent;

Route::get('/', HomeComponent::class)->name('home');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/cart', CartComponent::class)->name('shop.cart');
Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');