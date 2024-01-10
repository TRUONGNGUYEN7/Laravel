<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;

class CategoryController extends Controller
{
    public function Authlogin()
    {
        $admin_username = Session::get('admin_username');
        if (!$admin_username) {
            return Redirect::to('admin/login')->send();
        }
    }

    public function hienthi()
    {
        $this->Authlogin();
        $dsdanhmuc = DB::table('tbldanhmuc')->get();
        return view('admin.danhmuc.lietke')->with('dsdanhmuc', $dsdanhmuc);
    }

    public function them()
    {
        return view('admin.danhmuc.them');
    }

    public function action_them(Request $request)
    {
        return Category::checkAndCreateCategory($request);
    }

    public function hidden($id)
    {
        $this->Authlogin();
        Category::hideCategoryById($id);
        return redirect()->to('admin/danhmuc/hienthi');
    }

    public function show($id)
    {
        $this->Authlogin();
        Category::showCategoryById($id);
        return redirect()->to('admin/danhmuc/hienthi');
    }

    public function action_sua(Request $request, $id){
        return Category::updateCategory($id, $request);
    }

    public function suadm($id){
        $this -> Authlogin();
        $dsdanhmuc = Category::where('IDDM', $id)->get();
        // $dsdanhmuc = DB::table('tbldanhmuc') -> where('IDDM', $id) -> get();
        return view('admin.danhmuc.sua') -> with('dsdanhmuc', $dsdanhmuc);
    }

    public function xoadm($id)
    {
        $this->Authlogin();
        Category::deleteCategoryById($id);
        return back();
    }
}
