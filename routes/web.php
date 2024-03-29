<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\CheckAdminLogin;
use App\Http\Middleware\CheckAdminPermission;
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
     Route::group(['middleware' => 'checkadminpermission'], function () use ($accounts, $adminController, $adminRoutePrefix) {
          Route::get("$accounts/get", [$adminController, 'getAccounts'])->name("$adminRoutePrefix.$accounts.get");
          Route::post("$accounts/store", [$adminController, 'store'])->name("$adminRoutePrefix.$accounts.store");
          Route::get("$accounts/{id}/edit", [$adminController, 'edit'])->name("$adminRoutePrefix.$accounts.sua");
          Route::put("$accounts/update/{id}", [$adminController, 'update'])->name("$adminRoutePrefix.$accounts.update");
          Route::post("$accounts/xoa/{id}", [$adminController, 'destroy'])->name("$adminRoutePrefix.$accounts.xoa");
          Route::get("$accounts/status/{id}", [$adminController, 'status'])->name("$adminRoutePrefix.$accounts.status");
          Route::get("$accounts/getaccountByID/{id}", [$adminController, 'getaccountByID'])->name("$adminRoutePrefix.$accounts.getaccountByID");
     });

     $vaitroRoute = 'vaitro';
     $vaitroController = 'App\Http\Controllers\RolesController';
     Route::group(['middleware' => 'checkadminpermission'], function () use ($vaitroRoute, $vaitroController, $adminRoutePrefix) {
          Route::post("$vaitroRoute", [$vaitroController, 'store'])->name("$adminRoutePrefix.$vaitroRoute.store");
          Route::get("$vaitroRoute/{id}/edit", [$vaitroController, 'edit'])->name("$adminRoutePrefix.$vaitroRoute.sua");
          Route::put("$vaitroRoute/update/{id}", [$vaitroController, 'update'])->name("$adminRoutePrefix.$vaitroRoute.update");
          Route::post("$vaitroRoute/{id}", [$vaitroController, 'destroy'])->name("$adminRoutePrefix.$vaitroRoute.xoa");
          Route::get("$vaitroRoute/status/{id}", [$vaitroController, 'status'])->name("$adminRoutePrefix.$vaitroRoute.status");
          Route::post("$vaitroRoute/updateDataroute/{id}", [$vaitroController, 'updateDataroute'])->name("$adminRoutePrefix.$vaitroRoute.update-dataroute");
          Route::get("$vaitroRoute/get", [$vaitroController, 'get'])->name("$adminRoutePrefix.$vaitroRoute.get");
     });

     $permissions = 'permissions';
     $permissionsController = 'App\Http\Controllers\PermissionsController';
     Route::get('$permissions/get/{id}', [$permissionsController, 'getRoutes'])->name("$adminRoutePrefix.$permissions.getRoutes");

     $permissionRole = 'permissionRole';
     $permissionRoleController = 'App\Http\Controllers\PermissionRoleController';
     Route::get('$permissionRole', [$permissionRoleController, 'index'])->name("$adminRoutePrefix.$permissionRole.index");
     Route::post('$permissionRole/addPermissionRole', [$permissionRoleController, 'addPermissionRole'])->name("$adminRoutePrefix.$permissionRole.addPermissionRole");
     Route::post('$permissionRole/updatePermissionRole/{id}', [$permissionRoleController, 'updatePermissionRole'])->name("$adminRoutePrefix.$permissionRole.updatePermissionRole");
     Route::get('$permissionRole/getRoutesPermissionByID/{id}', [$permissionRoleController, 'getRoutesPermissionByID'])->name("$adminRoutePrefix.$permissionRole.getRoutesPermissionByID");

     $danhmucRoute = 'danhmuc';
     $categoryController = 'App\Http\Controllers\CategoryController';
     Route::group(['middleware' => 'checkadminpermission'], function () use ($danhmucRoute, $categoryController, $adminRoutePrefix) {
          Route::get("$danhmucRoute", [$categoryController, 'index'])->name("$adminRoutePrefix.$danhmucRoute.index");
          Route::get("$danhmucRoute/create", [$categoryController, 'create'])->name("$adminRoutePrefix.$danhmucRoute.create");
          Route::post("$danhmucRoute", [$categoryController, 'store'])->name("$adminRoutePrefix.$danhmucRoute.store");
          Route::get("$danhmucRoute/{id}/edit", [$categoryController, 'edit'])->name("$adminRoutePrefix.$danhmucRoute.sua");
          Route::put("$danhmucRoute/{id}", [$categoryController, 'update'])->name("$adminRoutePrefix.$danhmucRoute.update");
          Route::post("$danhmucRoute/{id}", [$categoryController, 'destroy'])->name("$adminRoutePrefix.$danhmucRoute.xoa");
          Route::get("$danhmucRoute/status/{id}", [$categoryController, 'status'])->name("$adminRoutePrefix.$danhmucRoute.status");
     });

     $chudeRoute = 'chude';
     $subcategoryController = 'App\Http\Controllers\SubcategoryController';
     Route::group(['middleware' => 'checkadminpermission'], function () use ($chudeRoute, $subcategoryController, $adminRoutePrefix) {
          Route::get("$chudeRoute", [$subcategoryController, 'index'])->name("$adminRoutePrefix.$chudeRoute.index");
          Route::get("$chudeRoute/create", [$subcategoryController, 'create'])->name("$adminRoutePrefix.$chudeRoute.create");
          Route::post("$chudeRoute", [$subcategoryController, 'store'])->name("$adminRoutePrefix.$chudeRoute.store");
          Route::get("$chudeRoute/{id}/edit", [$subcategoryController, 'edit'])->name("$adminRoutePrefix.$chudeRoute.sua");
          Route::put("$chudeRoute/{id}", [$subcategoryController, 'update'])->name("$adminRoutePrefix.$chudeRoute.update");
          Route::post("$chudeRoute/{id}", [$subcategoryController, 'destroy'])->name("$adminRoutePrefix.$chudeRoute.xoa");
          Route::get("$chudeRoute/status/{id}", [$subcategoryController, 'status'])->name("$adminRoutePrefix.$chudeRoute.status");
     });

     $baivietRoute = 'baiviet';
     $postController = 'App\Http\Controllers\PostController';
     Route::group(['middleware' => 'checkadminpermission'], function () use ($baivietRoute, $postController, $adminRoutePrefix) {
          Route::get("$baivietRoute", [$postController, 'index'])->name("$adminRoutePrefix.$baivietRoute.index");
          Route::get("$baivietRoute/create", [$postController, 'create'])->name("$adminRoutePrefix.$baivietRoute.create");
          Route::post("$baivietRoute", [$postController, 'store'])->name("$adminRoutePrefix.$baivietRoute.store");
          Route::put("$baivietRoute/{id}", [$postController, 'update'])->name("$adminRoutePrefix.$baivietRoute.update");
          Route::get("$baivietRoute/{id}/edit", [$postController, 'edit'])->name("$adminRoutePrefix.$baivietRoute.sua");
          Route::post("$baivietRoute/{id}", [$postController, 'destroy'])->name("$adminRoutePrefix.$baivietRoute.xoa");
          Route::get("$baivietRoute/status/{id}", [$postController, 'status'])->name("$adminRoutePrefix.$baivietRoute.status");
     });

});
