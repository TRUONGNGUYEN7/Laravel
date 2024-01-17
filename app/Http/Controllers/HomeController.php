<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Post;
use App\Models\Admin\Subcategory;
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
        $ttdanhmuc = collect(); 

        return view('user.page.home', [
            'menuCategory' => $menuCategory,
            'maxViewPosts' => $maxViewPosts,
            'SecondPost' => $SecondPost,
            'ttdanhmuc' => $ttdanhmuc,
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

        $menuchude = Subcategory::join('tbldanhmuc', 'tbldanhmuc.IDDM', '=', 'tblchude.DanhMucID')
        ->where('tbldanhmuc.IDDM', $id)
        ->get();

        return view('user.danhmuc.danhmuc', [
            'menuCategory' => $menuCategory,
            'ttdanhmuc' => $ttdanhmuc,
            'maxViewPost' => $maxViewPost,
            'FourPosts' => $fourPosts,
            'menuchude' => $menuchude,
            'selectedChudeID' => $id,
        ]);
        
    }

    public function hienthichude($id, $iddm)
    {
        $maxViewPost = Post::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
            ->where('tblchude.IDCD', $id)
            ->orderByDesc('tblbaiviet.IDBV')
            ->take(1)
            ->get();
    
        $fourPosts = collect(); // Tạo một Collection trống mặc định.
        if (!$maxViewPost->isEmpty()) {
            // Lấy 4 bài viết khác trong cùng danh mục
            $fourPosts = Post::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
                ->where('tblchude.IDCD', $id)
                ->where('tblbaiviet.IDBV', '<>', $maxViewPost->first()->IDBV)
                ->orderByDesc('tblbaiviet.IDBV')
                ->take(4)
                ->get();
        }
    
        $menuCategory = Category::where('TrangThaiDM', 1)->get();
        $ttchude = Subcategory::find($id);
        $ttdanhmuc = Category::find($iddm);
        $menuchude = Subcategory::join('tbldanhmuc', 'tbldanhmuc.IDDM', '=', 'tblchude.DanhMucID')
            ->where('tbldanhmuc.IDDM', $iddm)
            ->get();
    
        return view('user.danhmuc.chude', [
            'menuCategory' => $menuCategory,
            'ttdanhmuc' => $ttdanhmuc,
            'ttchude' => $ttchude,
            'maxViewPost' => $maxViewPost,
            'FourPosts' => $fourPosts,
            'menuchude' => $menuchude,
            'selectedChudeID' => $id,
        ]);
    }
    
}
