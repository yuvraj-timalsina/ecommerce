<?php

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\EditCategoryComponent;
use App\Http\Livewire\ProductDetailsComponent;
use App\Http\Livewire\Admin\AddProductComponent;
use App\Http\Livewire\Admin\AddCategoryComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminProductsComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminCategoriesComponent;

Route::get('/', HomeComponent::class)->name('home');
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/product/{slug}', ProductDetailsComponent::class)->name('product.details');
Route::get('/cart', CartComponent::class)->name('shop.cart');
Route::get('/wishlist', WishlistComponent::class)->name('shop.wishlist');
Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');
Route::get('/product-category/{slug}', CategoryComponent::class)->name('product.category');
Route::get('/search', SearchComponent::class)->name('product.search');

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
    Route::get('/categories', AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/category/add', AddCategoryComponent::class)->name('admin.category.add');
    Route::get('/category/edit/{category}', EditCategoryComponent::class)->name('admin.category.edit');

    Route::get('/products', AdminProductsComponent::class)->name('admin.products');
    Route::get('/product/add', AddProductComponent::class)->name('admin.product.add');
});

require __DIR__ . '/auth.php';
