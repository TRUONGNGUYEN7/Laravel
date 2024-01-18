<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
class HomeController extends Controller
{
    public function index()
    {
        $twoLatestCategoriesWithPosts = Category::getTwoActiveCategories();
        $FourPosts = Post::getLatestPosts();
    
        $menuCategory = Category::getActiveCategories();
        $fourCategoryContent = Category::getTwoActiveCategories();
        $ttdanhmuc = collect();
    
        return view('user.page.home', [
            'menuCategory' => $menuCategory,
            'FourPosts' => $FourPosts,
            'fourCategoryContent' => $fourCategoryContent,
            'twoLatestCategoriesWithPosts' => $twoLatestCategoriesWithPosts,
        ]);
    }

    public function hienthidanhmuc($id)
    {
        $ttdanhmuc = Category::find($id);
        $menuCategory = Category::getActiveCategories($id);
        $menuchude = Subcategory::getSubmenuForCate($id);
        $FourPosts = Post::getPostsCate($id);
        $selectedChudeID = '';
        return view('user.danhmuc.danhmuc', compact('menuCategory', 'ttdanhmuc', 'FourPosts', 'selectedChudeID', 'menuchude'));
        
    }

    public function hienthichude($id, $iddm)
    {
        $menuCategory = Category::getActiveCategories();
        $ttdanhmuc = Category::find($iddm);
        $ttchude = Subcategory::find($id);
        $FourPosts = Post::getPostSubCate($id, $iddm);
        $menuchude = Subcategory::getSubmenuForCate($iddm);
        $selectedChudeID = $id;
        return view('user.danhmuc.chude', compact('menuCategory', 'ttdanhmuc', 'ttchude', 'FourPosts', 'menuchude', 'selectedChudeID'));
    }
    
    
}
