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

        $sobaiviet = '6';
        $SixPostsNewUpdate = Post::getLatestPosts($sobaiviet);

        return view('user.page.home', [
            'menuCategory' => $menuCategory,
            'FourPosts' => $FourPosts,
            'fourCategoryContent' => $fourCategoryContent,
            'twoLatestCategoriesWithPosts' => $twoLatestCategoriesWithPosts,
            'SixPostsNewUpdate' => $SixPostsNewUpdate
        ]);
    }

    public function hienthi($id, $iddm = null)
    {
        if ($iddm !== null) {
            $menuCategory = Category::getActiveCategories();
            $ttdanhmuc = Category::find($iddm);
            $ttchude = Subcategory::find($id);
            $sobaiviet = '4';
            $FourPosts = Post::getPostSubCate($id, $iddm, $sobaiviet);
            $menuchude = Subcategory::getSubmenuForCate($iddm);
            $selectedChudeID = $id;
            return view('user.danhmuc.chude', compact(
                'menuCategory', 'ttdanhmuc', 'ttchude',
                'FourPosts', 'menuchude', 'selectedChudeID'
            ));
        } else {
            $ttdanhmuc = Category::find($id);
            $menuCategory = Category::getActiveCategories($id);
            $menuchude = Subcategory::getSubmenuForCate($id);
            $sobaiviet = '4';
            $FourPosts = Post::getPostsCate($id, $sobaiviet);

            $selectedChudeID = '';
            return view('user.danhmuc.danhmuc', compact(
                'menuCategory', 'ttdanhmuc', 'FourPosts', 
                'selectedChudeID', 'menuchude'
            ));    
        }
    } 

    public function detail($id)
    {
        $ttbaiviet = Post::find($id);
        $menuCategory = Category::getActiveCategories($id);
        $menuchude = Subcategory::getSubmenuForCate($id);
        $viewPost = Post::getViewsPosts();
        Post::ViewPlusPost($id);
        $selectedChudeID = '';
        return view('user.page.detail', compact(
            'menuCategory', 'ttbaiviet',
            'selectedChudeID', 'menuchude', 'viewPost'
        ));    
    } 
}
