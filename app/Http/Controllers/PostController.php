<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Admin\Post;
use App\Models\Admin\Subcategory;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index()
    {
        $dslietke = Post::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID') ->get();
        return view('admin.baiviet.lietke')->with('dslietke', $dslietke);
    }

    public function create()
    {
        $dsdanhmuc = Post::where('TrangThaiBV', 1)->get();
        $dschude = Subcategory::where('TrangThaiCD', 1)->get();
        return view('admin.baiviet.them')->with('dschude', $dschude)
        ->with('dsdanhmuc', $dsdanhmuc);
    }

    public function store(PostRequest $request)
    {
        Post::createNewPost($request);
        return back();
    }
    
    public function status($id, $value)
    {
        Post::StatusPostById($id, $value);
        return back();
    }

    public function action_sua(PostRequest $request, $id)
    {
        Post::updatePost($request, $id);
        return back();
    }

    public function sua($id){
        $dsdanhmucsua = Post::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
        ->where('tblbaiviet.IDBV', $id)
        ->get();

        $dsChude = Subcategory::where('TrangThaiCD', 1)->get();
        return view('admin.baiviet.sua')
        ->with('dsdanhmucsua', $dsdanhmucsua)
        ->with('dsChude', $dsChude);
    }
    
    public function xoa($id)
    {
        Post::deletePostById($id);
        return back();
    }
}
