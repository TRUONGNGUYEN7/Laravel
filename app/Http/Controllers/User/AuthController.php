<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends HomeController
{

    public function __construct()
    {
        $this->folderUpload = config('ntg.folderUpload.mainFolder');
        $this->fileUploadPath = '../' . $this->folderUpload . '/';
        $this->controllerName     = 'auth';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle = 'auth';
        view()->share([
            'moduleName'     => $this->moduleName,
            'controllerName' => $this->controllerName,
            'pageTitle'=> $this->pageTitle,
            'fileUploadPath' => $this->fileUploadPath,
        ]);
    }
    public function signup()
    {
        return view($this->pathViewController .'signup');
    }

    public function signup_action(Request $request)
    {
        $data = $request->all();
        $existingUser = User::where('name', $request->name)->first();
        if($existingUser)
        {
            return response()->json(['success' => false, 'message' => 'Tên tài khoản đã được sử dụng !']);
        }
        if ($data['password'] !== $data['confirm_password']) {
            return response()->json(['success' => false, 'message' => 'Mật khẩu không khớp, vui lòng nhập lại!!!']);
        }
        $user = User::insert([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'status' => 1,
        ]);

        if ($user) {
            return response()->json(['success' => true, 'message' => 'Đăng ký thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Đăng ký thất bại, vui lòng thử lại!!!']);
        }
    }

    public function signin()
    {
        return view('user.pages.auth.login');
    }
    
    public function signin_action(Request $request)
    {
        $credentials = $request->only('name', 'password');
        if (Auth::guard('user')->attempt($credentials)) {
                $user = Auth::guard('user')->user();
            if ($user->status == 'inactive') {
                return response()->json(['success' => false, 'message' => 'Bạn chưa có quyền đăng nhập!!!']);
            } else {
                return response()->json(['success' => true, 'message' => 'Đăng nhập thành công']);
            }  
        }else{
            return response()->json(['success' => false, 'message' => 'Tài khoản hoặc mật khẩu không đúng, vui lòng thử lại!!!']);
        }

    }

    public function checkLoginStatus()
    {
        if (Auth::guard('user')->check()) {
            return response()->json(['loggedIn' => true]);
        } else {
            return response()->json(['loggedIn' => false]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        return back();
    }
}
