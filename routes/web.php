<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;


Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'LoginProcess']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {

    Route::get('/dashbord', function () {
        return view('dashbord');
    });

    Route::get('/lendings', [\App\Http\Controllers\LendingController::class, 'index'])->name('lendings.index');
    Route::get('/lendings/export', [\App\Http\Controllers\LendingController::class, 'export'])->name('lendings.export');

    Route::get('/items/export', [ItemController::class, 'export'])->name('items.export');
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');

    Route::get('/users/export', [\App\Http\Controllers\UserController::class, 'export'])->name('users.export');
    Route::post('/users/{user}/reset-password', [\App\Http\Controllers\UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::resource('users', \App\Http\Controllers\UserController::class)->except(['show']);

    Route::middleware('role:admin')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    });

    Route::middleware('role:staff')->group(function () {
        Route::get('/lendings/create', [\App\Http\Controllers\LendingController::class, 'create'])->name('lendings.create');
        Route::post('/lendings', [\App\Http\Controllers\LendingController::class, 'store'])->name('lendings.store');
        Route::put('/lendings/{lending}/return', [\App\Http\Controllers\LendingController::class, 'markAsReturned'])->name('lendings.return');
        Route::delete('/lendings/{lending}', [\App\Http\Controllers\LendingController::class, 'destroy'])->name('lendings.destroy');
    });

});