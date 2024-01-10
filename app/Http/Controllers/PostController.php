<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Models\Subcategory;

class PostController extends Controller
{
    public function Authlogin()
    {
        $admin_username = Session::get('admin_username');
        if (!$admin_username) {
            return Redirect::to('admin/login')->send();
        }
    }

    public function baiviethienthi()
    {
        $this->Authlogin();
        $dslietke = Post::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID') ->get();
        return view('admin.baiviet.lietke')->with('dslietke', $dslietke);
    }

    public function baivietthem()
    {
        $this->Authlogin();
        $dsdanhmuc = Post::where('TrangThaiBV', 1)->get();
        $dschude = Subcategory::where('TrangThaiCD', 1)->get();
        return view('admin.baiviet.them')->with('dschude', $dschude)
        ->with('dsdanhmuc', $dsdanhmuc);
    }

    public function baivietaction_them(Request $request)
    {
        Post::createNewPost($request);
        return back();
    }
    
    public function baiviethidden($id)
    {
        $this->Authlogin();
        Post::hidePostById($id);
        return redirect()->to('admin/baiviet/hienthi');
    }

    public function baivietshow($id)
    {
        $this->Authlogin();
        Post::showPostById($id);
        return redirect()->to('admin/baiviet/hienthi');
    }

    public function baivietaction_sua(Request $request, $id)
    {
        Post::updatePost($request, $id);
        return back();
    }

    public function baivietsuadm($id){
        $this->Authlogin();
        $dsdanhmucsua = Post::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
        ->where('tblbaiviet.IDBV', $id)
        ->get();

        return view('admin.baiviet.sua')->with('dsdanhmucsua', $dsdanhmucsua);
    }
    
    public function baivietxoadm($id)
    {
        $this->Authlogin();
        Post::deletePostById($id);
        return back();
    }
}
