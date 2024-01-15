<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\CheckAdminLogin;
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
//Homeuser
Route::prefix('/')->group(function () {
     Route::get('/', [Homecontroller::class, 'index']);
     Route::get('/trangchu', [Homecontroller::class, 'index']);
});

//User-danhmuc
Route::prefix('/user')->group(function () {
     Route::get('/danhmuc/danhmuc/{id}', [Homecontroller::class, 'hienthidanhmuc']);
});

Route::prefix('/admin')->group(function () {
     Route::get('/', [AdminController::class, 'login']);
     Route::get('/login', [AdminController::class, 'login']);
     Route::post('/loginaction', [AdminController::class, 'loginaction']);
     Route::get('/logout', [AdminController::class, 'logout']);
});

// Admin
Route::middleware('checkadminlogin')->group(function () {
     Route::prefix('/admin')->group(function () {
          Route::get('/index', [AdminController::class, 'showhome'])->name('admin.showhome');
          
          // Admin Danhmuc
          Route::prefix('/danhmuc')->group(function () {
               Route::resource('danhmuc', CategoryController::class)->names([
                    'index' => 'admin.danhmuc.lietke',
                    'create' => 'admin.danhmuc.them',
                    'store' => 'admin.danhmuc.action_them',
               ]);
               Route::get('/sua/{id}', [CategoryController::class, 'sua'])->name('admin.danhmuc.sua');
               Route::post('/action_sua/{id}', [CategoryController::class, 'action_sua'])->name('admin.danhmuc.action_sua');
               Route::post('/xoa/{id}', [CategoryController::class, 'xoa'])->name('admin.danhmuc.xoa');
               Route::get('/status/{id}/{value}', [CategoryController::class, 'status'])->name('admin.danhmuc.status');
          });
     
          // Admin Chude
          Route::prefix('/chude')->group(function () {
               Route::resource('chude', SubcategoryController::class)->names([
                    'index' => 'admin.chude.lietke',
                    'create' => 'admin.chude.them',
                    'store' => 'admin.chude.action_them',
               ]);
               Route::get('/sua/{id}', [SubcategoryController::class, 'sua'])->name('admin.chude.sua');
               Route::post('/action_sua/{id}', [SubcategoryController::class, 'action_sua'])->name('admin.chude.action_sua');
               Route::post('/xoa/{id}', [SubcategoryController::class, 'xoa'])->name('admin.chude.xoa');
               Route::get('/status/{id}/{value}', [SubcategoryController::class, 'status'])->name('admin.chude.status');
          });
     
          // Admin Baiviet
          Route::prefix('/baiviet')->group(function () {
               Route::resource('baiviet', PostController::class)->names([
                    'index' => 'admin.baiviet.lietke',
                    'create' => 'admin.baiviet.them',
                    'store' => 'admin.baiviet.action_them',
               ]);
               Route::get('/sua/{id}', [PostController::class, 'sua'])->name('admin.baiviet.sua');
               Route::post('/action_sua/{id}', [PostController::class, 'action_sua'])->name('admin.baiviet.action_sua');
               Route::post('/xoa/{id}', [PostController::class, 'xoa'])->name('admin.baiviet.xoa');
               Route::get('/status/{id}/{value}', [PostController::class, 'status'])->name('admin.baiviet.status');
          });
     });
});
 