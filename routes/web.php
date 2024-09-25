<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JenisSidangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Models\JenisSidang;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['prefix' => 'jenis_sidang'], function(){
    Route::get('/', [JenisSidangController::class, 'index'])->name('jenis_sidang.index');
    Route::get('/create', [JenisSidangController::class, 'create'])->name('jenis_sidang.create');
    Route::post('/store', [JenisSidangController::class, 'store'])->name('jenis_sidang.store');
});

//Route::get('/dashboard', function(){return view("dashboard");})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function(){
    return view('landing.index');
});




Route::middleware(['auth', 'verified'])->group(function () {

    // Admin Middleware
    Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
        Route::get('/dashboard', [WelcomeController::class, 'index'])->name('admin.dashboard');
        Route::group(['prefix' => 'antrian'], function(){
            Route::get('/', [AntrianController::class, 'index'])->name('admin.antrian.index');
            Route::post('/list', [AntrianController::class, 'list'])->name('admin.antrian.list');
            Route::get('/create', [AntrianController::class, 'create'])->name('admin.antrian.create');
            Route::post('/store', [AntrianController::class, 'store'])->name('admin.antrian.store');
            Route::get('/{id}', [AntrianController::class, 'show'])->name('admin.antrian.show');
            Route::get('/{id}/edit', [AntrianController::class, 'edit'])->name('admin.antrian.edit');
            Route::put('/{id}', [AntrianController::class, 'update'])->name('admin.antrian.update');
            Route::delete('/{id}', [AntrianController::class, 'delete'])->name('admin.antrian.delete');
        });
    });

    // User Middleware
    Route::prefix('user')->middleware(UserMiddleware::class)->group(function () {
        Route::get('/dashboard', [WelcomeController::class, 'index'])->name('user.dashboard');
        Route::group(['prefix' => 'customers'], function(){
            Route::get('/', [CustomerController::class, 'index'])->name('user.customers.index');
            Route::post('/about', [CustomerController::class, 'list'])->name('user.customers.about');
            Route::post('/list', [CustomerController::class, 'list'])->name('user.customers.list');
            Route::get('/form-pendaftaran', [CustomerController::class, 'create'])->name('user.customers.form-pendaftaran');
            Route::post('/customers', [CustomerController::class, 'store'])->name('user.customers.store');
            Route::get('/{customers}', [CustomerController::class, 'show'])->name('user.customers.show');
            Route::get('/{customers}/edit', [CustomerController::class, 'edit'])->name('user.customers.edit');
            Route::put('/{customers}', [CustomerController::class, 'update'])->name('user.customers.update');
            Route::delete('/{customers}', [CustomerController::class, 'delete'])->name('user.customers.delete');
        });
    });
    
});

require __DIR__.'/auth.php';
