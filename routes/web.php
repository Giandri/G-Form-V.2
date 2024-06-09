<?php

use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/',function(){
    return view ('login');
});

Route::group(['prefix' => 'account'], function () {

    // Guest middleware
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login',[LoginController::class,'index'])->name('account.login');
        Route::get('register',[LoginController::class,'register'])->name('account.register');
        Route::post('process-register',[LoginController::class,'processRegister'])->name('account.processRegister');
        Route::get('logout',[LoginController::class,'logout'])->name('account.logout');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
       
    });

    // Auth middleware
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout',[LoginController::class,'logout'])->name('account.logout');
        Route::get('dashboard',[DashboardController::class,'create'])->name('account.dashboard');
        Route::post('store', [DashboardController::class, 'store'])->name('account.store');
        Route::get('', [DashboardController::class, 'index'])->name('account.index');
        Route::get('{article}/edit', [DashboardController::class, 'edit'])->name('account.edit'); 
        Route::put('{article}', [DashboardController::class, 'update'])->name('account.update');
        Route::delete('{article}', [DashboardController::class, 'destroy'])->name('account.destroy');
    });
});




Route::group(['prefix' => 'admin'], function () {

    // Guest middleware
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    // Auth middleware
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
        Route::get('logout',[AdminLoginController::class,'logout'])->name('admin.logout');
    });
});

