<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

Route::get('/profile', [UserController::class, 'create'])->name('user.create');
Route::post('/profile', [UserController::class, 'store'])->name('user.store');

Route::middleware(['auth'])
    ->prefix('app')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        
        Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/profile', [UserController::class, 'update'])->name('user.update');
        
        Route::resource('/categories', CategoryController::class);
        
        Route::resource('/products', ProductController::class); 

        Route::resource('/shopping-lists', ShoppingListController::class); 
        
        // Rotas para gerenciar produtos nas listas
        Route::post('/shopping-lists/{shoppingList}/products', [ShoppingListController::class, 'addProduct'])->name('shopping-lists.add-product');
        Route::delete('/shopping-lists/{shoppingList}/products/{product}', [ShoppingListController::class, 'removeProduct'])->name('shopping-lists.remove-product');
    });
