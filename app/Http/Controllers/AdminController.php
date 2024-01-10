<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function Authlogin(){
        $admin_username = Session::get('admin_username');
        if($admin_username){
            return Redirect::to('admin') -> send();
        } else {
            return Redirect::to('admin/login') -> send();;
        }
    }

    public function showhome(){
        return view('admin.pages.home');
    }
    public function login(){
        return view('admin.pages.login');
    }

    public function home(Request $request){
        $adminname = $request->adminname;
        $adminpass = md5($request->adminpass);

        $result = DB::table('tbladmin')-> where('Ten',$adminname)->where('MatKhau',$adminpass) ->first();
        if($result) {
            if($result-> TrangThai == 0){
                Session::put('message', 'Bạn chưa có quyền đăng nhập!!!');
                return back();
            } else {
                Session::put('admin_username', $result -> Ten);
                Session::put('admin_id', $result -> ID);
            
                return Redirect::to('/admin');
            }
        } else {

            Session::put('message', 'Tài khoản hoặc mật khẩu của bạn không đúng, vui lòng thử lại!!!');
            return Redirect::to('/admin/login');
        }
    }
    public function logout(){

        session() -> flush();
        return redirect('/admin/login');
    }


}
