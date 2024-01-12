<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
class HomeController extends Controller
{
    public function index()
    {
        $maxViewPosts = Post::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID')
        ->orderByDesc('tblbaiviet.LuotXem')
        ->orderByDesc('tblbaiviet.IDBV')
        ->take(1)
        ->get();
    
        $SecondPost = collect(); // Tạo một Collection trống mặc định.
        
        if (!$maxViewPosts->isEmpty()) {
            $SecondPost = Post::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID')
                ->where('tblbaiviet.IDBV', '<>', $maxViewPosts->first()->IDBV)
                ->orderByDesc('tblbaiviet.IDBV')
                ->take(1)
                ->get();
        }
        
        $ThirdPost = collect(); // Tạo một Collection trống mặc định.
        
        if (!$maxViewPosts->isEmpty() && !$SecondPost->isEmpty()) {
            $ThirdPost = Post::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID')
                ->where('tblbaiviet.IDBV', '<>', $maxViewPosts->first()->IDBV)
                ->where('tblbaiviet.IDBV', '<>', $SecondPost->first()->IDBV)
                ->orderByDesc('tblbaiviet.IDBV')
                ->take(2)
                ->get();
        }
        
        $menuCategory = Category::where('TrangThaiDM', 1)->get();
        $fourCategoryContent = Category::where('TrangThaiDM', 1)->take(2)->get();
        
        return view('user.page.home', [
            'menuCategory' => $menuCategory,
            'maxViewPosts' => $maxViewPosts,
            'SecondPost' => $SecondPost,
            'ThirdPost' => $ThirdPost,
            'fourCategoryContent' => $fourCategoryContent,
        ]);
    }

    public function hienthidanhmuc($id)
    {
        $maxViewPost = Post::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
        ->join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM')
        ->where('tbldanhmuc.IDDM', $id)
        ->orderByDesc('tblbaiviet.IDBV')
        ->take(1)
        ->get();
        
        $fourPosts = collect(); // Tạo một Collection trống mặc định.
        if (!$maxViewPost->isEmpty()) {
            // Lấy 4 bài viết khác trong cùng danh mục
            $fourPosts = Post::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
            ->join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM')
            ->where('tbldanhmuc.IDDM', $id)
            ->where('tblbaiviet.IDBV', '<>', $maxViewPost->first()->IDBV)
            ->orderByDesc('tblbaiviet.IDBV')
            ->take(4)
            ->get();
        }

        $menuCategory = Category::where('TrangThaiDM', 1)->get();
        $ttdanhmuc = Category::find($id);
        return view('user.danhmuc.danhmuc', [
            'menuCategory' => $menuCategory,
            'ttdanhmuc' => $ttdanhmuc,
            'maxViewPost' => $maxViewPost,
            'FourPosts' => $fourPosts,
        ]);
        
    }

}
