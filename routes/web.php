<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Controllers\UserController;

//Homeuser
Route::prefix('/')->group(function () {
     Route::get('/', [HomeController::class, 'index'])->name('user.home');
});

$userController = 'App\Http\Controllers\UserController';
$user = 'user'; 
Route::prefix('user')->group(function () use ($userController, $user) {
     Route::get('baiviet/detail/{id}', [$userController, 'detail'])->name("$user.baiviet.detail");
     Route::get('submenu/{id}/{iddm?}', [$userController, 'hienthi'])->name("$user.hienthi");
     Route::post('add', [$userController, 'addcomment'])->name("$user.comment.add");
     Route::get('signup', [$userController, 'signup'])->name("$user.signup");
     Route::post('signup_action', [$userController, 'signup_action'])->name("$user.signup_action");
     Route::get('signin', [$userController, 'signin'])->name("$user.signin");
     Route::post('signin_action', [$userController, 'signin_action'])->name("$user.signin_action");
     Route::get('logout', [$userController, 'logout'])->name("$user.logout");
});

 
$adminController = 'App\Http\Controllers\AdminController';
Route::prefix('admin')->group(function () use ($adminController) {
    Route::get('', [$adminController, 'login'])->name('admin.home');
    Route::get('login', [$adminController, 'login'])->name('admin.login');
    Route::post('loginaction', [$adminController, 'loginaction'])->name('admin.login.action');
    Route::get('logout', [$adminController, 'logout'])->name('admin.logout');
});

//Admin
$adminRoutePrefix = 'admin';
Route::group(['prefix' => "$adminRoutePrefix", 'middleware' => 'checkadminlogin'], function () use ($adminRoutePrefix) {

     $adminController = 'App\Http\Controllers\AdminController';
     Route::get('index', [$adminController, 'showhome'])->name("$adminRoutePrefix.showhome");

     // Admin Danhmuc
     $danhmucRoute = 'danhmuc';
     $categoryController = 'App\Http\Controllers\CategoryController';
     Route::get("$danhmucRoute", [$categoryController, 'index'])->name("$adminRoutePrefix.$danhmucRoute.index");
     Route::get("$danhmucRoute/create", [$categoryController, 'create'])->name("$adminRoutePrefix.$danhmucRoute.create");
     Route::post("$danhmucRoute", [$categoryController, 'store'])->name("$adminRoutePrefix.$danhmucRoute.store");
     Route::get("$danhmucRoute/{id}/edit", [$categoryController, 'edit'])->name("$adminRoutePrefix.$danhmucRoute.sua");
     Route::put("$danhmucRoute/{id}", [$categoryController, 'update'])->name("$adminRoutePrefix.$danhmucRoute.update");
     Route::post("$danhmucRoute/{id}", [$categoryController, 'destroy'])->name("$adminRoutePrefix.$danhmucRoute.xoa");
     Route::get("$danhmucRoute/status/{id}/{value}", [$categoryController, 'status'])->name("$adminRoutePrefix.$danhmucRoute.status");

     // Admin Chude
     $chudeRoute = 'chude';
     $subcategoryController = 'App\Http\Controllers\SubcategoryController';
     Route::get("$chudeRoute", [$subcategoryController, 'index'])->name("$adminRoutePrefix.$chudeRoute.index");
     Route::get("$chudeRoute/create", [$subcategoryController, 'create'])->name("$adminRoutePrefix.$chudeRoute.create");
     Route::post("$chudeRoute", [$subcategoryController, 'store'])->name("$adminRoutePrefix.$chudeRoute.store");
     Route::get("$chudeRoute/{id}/edit", [$subcategoryController, 'edit'])->name("$adminRoutePrefix.$chudeRoute.sua");
     Route::put("$chudeRoute/{id}", [$subcategoryController, 'update'])->name("$adminRoutePrefix.$chudeRoute.update");
     Route::post("$chudeRoute/{id}", [$subcategoryController, 'destroy'])->name("$adminRoutePrefix.$chudeRoute.xoa");
     Route::get("$chudeRoute/status/{id}/{value}", [$subcategoryController, 'status'])->name("$adminRoutePrefix.$chudeRoute.status");

     // Admin Baiviet
     $baivietRoute = 'baiviet';
     $postController = 'App\Http\Controllers\PostController';
     Route::get("$baivietRoute", [$postController, 'index'])->name("$adminRoutePrefix.$baivietRoute.index");
     Route::get("$baivietRoute/create", [$postController, 'create'])->name("$adminRoutePrefix.$baivietRoute.create");
     Route::post("$baivietRoute", [$postController, 'store'])->name("$adminRoutePrefix.$baivietRoute.store");
     Route::put("$baivietRoute/{id}", [$postController, 'update'])->name("$adminRoutePrefix.$baivietRoute.update");
     Route::get("$baivietRoute/{id}/edit", [$postController, 'edit'])->name("$adminRoutePrefix.$baivietRoute.sua");
     Route::post("$baivietRoute/{id}", [$postController, 'destroy'])->name("$adminRoutePrefix.$baivietRoute.xoa");
     Route::get("$baivietRoute/status/{id}/{value}", [$postController, 'status'])->name("$adminRoutePrefix.$baivietRoute.status");
});
