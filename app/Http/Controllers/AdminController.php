<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin\Admin;

class AdminController extends Controller
{

    public function showhome(){
        return view('admin.pages.home');
    }
    public function login(){
        return view('admin.pages.login');
    }

    public function loginaction(AdminLoginRequest $request)
    {
        $adminname = $request->adminname;
        $adminpass = $request->adminpass;

        $authenticatedAdmin = Admin::Authenticate($adminname, $adminpass);

        if ($authenticatedAdmin) {
            if ($authenticatedAdmin->TrangThai == 0) {
                Session::put('message', 'Bạn chưa có quyền đăng nhập!!!');
                return back();
            } else {

                $adminData = [
                    'admin_username' => $authenticatedAdmin->Ten,
                    'admin_id' => $authenticatedAdmin->IDAD,
                ];
                
                Session::put('admin_data', $adminData);

                return redirect()->to('/admin/index');
            }
        } else {
            Session::put('message', 'Tài khoản hoặc mật khẩu của bạn không đúng, vui lòng thử lại!!!');
            return redirect()->to('/admin/login');
        }
    }
    
    public function logout(){

        session() -> flush();
        return redirect('/admin');
    }


}
