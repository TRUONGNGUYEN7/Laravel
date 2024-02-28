<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

//Homeuser
Route::prefix('/')->group(function () {
     Route::get('/index', [HomeController::class, 'index'])->name('user.home');
});

$CommentController = 'App\Http\Controllers\CommentController';
$user = 'user';
Route::prefix('user')->group(function () use ($CommentController, $user) {
     Route::post('add/{id}', [$CommentController, 'addcomment'])->name("$user.comment.add");
});

$userController = 'App\Http\Controllers\UserController';
$user = 'user'; 
Route::prefix('user')->group(function () use ($userController, $user) {
     Route::get('baiviet/detail/{id}', [$userController, 'detail'])->name("$user.baiviet.detail");
     Route::get('submenu/{id}/{iddm?}', [$userController, 'hienthi'])->name("$user.hienthi");
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

     $accounts = 'accounts';
     Route::get("$accounts/get", [$adminController, 'getAccounts'])->name("$adminRoutePrefix.$accounts.get");
     Route::post("$accounts/store", [$adminController, 'store'])->name("$adminRoutePrefix.$accounts.store");
     Route::get("$accounts/{id}/edit", [$adminController, 'edit'])->name("$adminRoutePrefix.$accounts.sua");
     Route::put("$accounts/update/{id}", [$adminController, 'update'])->name("$adminRoutePrefix.$accounts.update");
     Route::post("$accounts/xoa/{id}", [$adminController, 'destroy'])->name("$adminRoutePrefix.$accounts.xoa");
     Route::get("$accounts/status/{id}/{value}", [$adminController, 'status'])->name("$adminRoutePrefix.$accounts.status");
     //laythongtintaikhoansuapopup
     Route::get("$accounts/get/{id}", [$adminController, 'getaccountByID'])->name("$adminRoutePrefix.$accounts.getaccountByID");

     // Admin taikhoan
     $nhomquyenRoute = 'nhomquyen';
     $nhomquyenController = 'App\Http\Controllers\RolesController';
     Route::get("$nhomquyenRoute", [$nhomquyenController, 'index'])->name("$adminRoutePrefix.$nhomquyenRoute.index");
     Route::post("$nhomquyenRoute", [$nhomquyenController, 'store'])->name("$adminRoutePrefix.$nhomquyenRoute.store");
     Route::get("$nhomquyenRoute/{id}/edit", [$nhomquyenController, 'edit'])->name("$adminRoutePrefix.$nhomquyenRoute.sua");
     Route::put("$nhomquyenRoute/update/{id}", [$nhomquyenController, 'update'])->name("$adminRoutePrefix.$nhomquyenRoute.update");
     Route::post("$nhomquyenRoute/{id}", [$nhomquyenController, 'destroy'])->name("$adminRoutePrefix.$nhomquyenRoute.xoa");
     Route::get("$nhomquyenRoute/status/{id}/{value}", [$nhomquyenController, 'status'])->name("$adminRoutePrefix.$nhomquyenRoute.status");
     Route::post("$nhomquyenRoute/updateDataroute/{id}", [$nhomquyenController, 'updateDataroute'])->name("$adminRoutePrefix.$nhomquyenRoute.update-dataroute");
     Route::get("$nhomquyenRoute/get", [$nhomquyenController, 'get'])->name("$adminRoutePrefix.$nhomquyenRoute.get");

     // Admin phanquyen
     $functionRoute = 'chucnang';
     $functionController = 'App\Http\Controllers\FunctionController';
     Route::get("$functionRoute/create", [$functionController, 'createfunction'])->name("$adminRoutePrefix.$functionRoute.create");
     Route::post("$functionRoute", [$functionController, 'store'])->name("$adminRoutePrefix.$functionRoute.store");
     Route::get('getChucNangByChucNangId/{id}', [$functionController, 'getChucNangByChucNangId'])->name('getChucNangByChucNangId');
     Route::get("$functionRoute/{id}/edit", [$functionController, 'edit'])->name("$adminRoutePrefix.$functionRoute.sua");
     Route::post("$functionRoute/{id}", [$functionController, 'update'])->name("$adminRoutePrefix.$functionRoute.update");
     Route::post("$functionRoute/{id}", [$functionController, 'destroy'])->name("$adminRoutePrefix.$functionRoute.xoa");

     $permissions = 'permissions';
     $permissionsController = 'App\Http\Controllers\PermissionsController';
     Route::get('$permissions/get/{id}', [$permissionsController, 'getRoutes'])->name("$adminRoutePrefix.$permissions.getRoutes");

     $permissionRole = 'permissionRole';
     $permissionRoleController = 'App\Http\Controllers\PermissionRoleController';
     Route::post('$permissionRole/addPermissionRole', [$permissionRoleController, 'addPermissionRole'])->name("$adminRoutePrefix.$permissionRole.addPermissionRole");
     Route::post('$permissionRole/updatePermissionRole/{id}', [$permissionRoleController, 'updatePermissionRole'])->name("$adminRoutePrefix.$permissionRole.updatePermissionRole");
     Route::get('$permissionRole/getRoutesPermissionByID/{id}', [$permissionRoleController, 'getRoutesPermissionByID'])->name("$adminRoutePrefix.$permissionRole.getRoutesPermissionByID");

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
