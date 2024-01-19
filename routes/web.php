<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\CheckAdminLogin;

//Homeuser
Route::prefix('/')->group(function () {
     Route::get('/', [Homecontroller::class, 'index']);
     Route::get('/trangchu', [Homecontroller::class, 'index']);
});

//User-danhmuc
Route::prefix('/user')->group(function () {
     Route::get('/submenu/{id}', [Homecontroller::class, 'hienthidanhmuc'])->name('admin.hienthidanhmuc');
     Route::get('/submenu/{id}/{iddm}', [Homecontroller::class, 'hienthichude'])->name('admin.hienthichude');
});

Route::prefix('/admin')->group(function () {
     Route::get('/', [AdminController::class, 'login'])->name('admin.home');
     Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
     Route::post('/loginaction', [AdminController::class, 'loginaction'])->name('admin.login.action');
     Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

//Admin
$adminController = AdminController::class;
$categoryController = CategoryController::class;
$subcategoryController = SubcategoryController::class;
$postController = PostController::class;

$adminRoutePrefix = 'admin';
Route::group(['prefix' => "$adminRoutePrefix", 'middleware' => 'checkadminlogin'], function () 
     use ($adminRoutePrefix, $adminController, $categoryController, $subcategoryController, $postController) {
     Route::get('/index', [$adminController, 'showhome'])->name("$adminRoutePrefix.showhome");

     // Admin Danhmuc
     $danhmucRoute = 'danhmuc';
     Route::get("$danhmucRoute", [$categoryController, 'index'])->name("$adminRoutePrefix.$danhmucRoute.index");
     Route::get("$danhmucRoute/create", [$categoryController, 'create'])->name("$adminRoutePrefix.$danhmucRoute.create");
     Route::post("$danhmucRoute", [$categoryController, 'store'])->name("$adminRoutePrefix.$danhmucRoute.store");
     Route::get("$danhmucRoute/{id}/edit", [$categoryController, 'edit'])->name("$adminRoutePrefix.$danhmucRoute.sua");
     Route::put("$danhmucRoute/{id}", [$categoryController, 'update'])->name("$adminRoutePrefix.$danhmucRoute.action_sua");
     Route::delete("$danhmucRoute/{id}", [$categoryController, 'destroy'])->name("$adminRoutePrefix.$danhmucRoute.xoa");
     Route::get("$danhmucRoute/status/{id}/{value}", [$categoryController, 'status'])->name("$adminRoutePrefix.$danhmucRoute.status");

     // Admin Chude
     $chudeRoute = 'chude';
     Route::get("$chudeRoute", [$subcategoryController, 'index'])->name("$adminRoutePrefix.$chudeRoute.index");
     Route::get("$chudeRoute/create", [$subcategoryController, 'create'])->name("$adminRoutePrefix.$chudeRoute.create");
     Route::post("$chudeRoute", [$subcategoryController, 'store'])->name("$adminRoutePrefix.$chudeRoute.store");
     Route::get("$chudeRoute/{id}/edit", [$subcategoryController, 'edit'])->name("$adminRoutePrefix.$chudeRoute.sua");
     Route::put("$chudeRoute/{id}", [$subcategoryController, 'update'])->name("$adminRoutePrefix.$chudeRoute.action_sua");
     Route::delete("$chudeRoute/{id}", [$subcategoryController, 'destroy'])->name("$adminRoutePrefix.$chudeRoute.xoa");
     Route::get("$chudeRoute/status/{id}/{value}", [$subcategoryController, 'status'])->name("$adminRoutePrefix.$chudeRoute.status");

     // Admin Baiviet
     $baivietRoute = 'baiviet';
     Route::get("$baivietRoute", [$postController, 'index'])->name("$adminRoutePrefix.$baivietRoute.index");
     Route::get("$baivietRoute/create", [$postController, 'create'])->name("$adminRoutePrefix.$baivietRoute.create");
     Route::post("$baivietRoute", [$postController, 'store'])->name("$adminRoutePrefix.$baivietRoute.store");
     Route::get("$baivietRoute/{id}/edit", [$postController, 'edit'])->name("$adminRoutePrefix.$baivietRoute.sua");
     Route::put("$baivietRoute/{id}", [$postController, 'update'])->name("$adminRoutePrefix.$baivietRoute.action_sua");
     Route::delete("$baivietRoute/{id}", [$postController, 'destroy'])->name("$adminRoutePrefix.$baivietRoute.xoa");
     Route::get("$baivietRoute/status/{id}/{value}", [$postController, 'status'])->name("$adminRoutePrefix.$baivietRoute.status");
     Route::get("/$baivietRoute/status/{id}/{value}", "$postController@status")->name("$adminRoutePrefix.$baivietRoute.status");
});
