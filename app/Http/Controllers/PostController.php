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

use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    public function index()
    {
        $dslietke = Post::getPostsWithChudeInfo()->paginate(5);
        return view('admin.baiviet.lietke', ['dslietke' => $dslietke]);
    }


    public function create() {
        $dsdanhmuc = Post::getActivePosts();
        $dschude = Subcategory::getActiveSubcategories();
    
        return view('admin.baiviet.them', compact('dschude', 'dsdanhmuc'));
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

    public function update(PostRequest $request, $id)
    {
        Post::updatePost($request, $id);
        return back();
    }

    public function edit($id) {
        $dsdanhmucsua = Post::getPostForEdit($id);
        $dsChude = Subcategory::getActiveSubcategories();
    
        return view('admin.baiviet.sua', compact('dsdanhmucsua', 'dsChude'));
    }
    
    public function xoa($id)
    {
        Post::deletePostById($id);
        return back();
    }
}
