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

        $SixPostsNewUpdate = Post::getLatestPosts(6);
        $viewPost = Post::getViewsPosts(4);
        return view('user.page.home', [
            'menuCategory' => $menuCategory,
            'FourPosts' => $FourPosts,
            'fourCategoryContent' => $fourCategoryContent,
            'twoLatestCategoriesWithPosts' => $twoLatestCategoriesWithPosts,
            'SixPostsNewUpdate' => $SixPostsNewUpdate,
            'viewPost' => $viewPost
        ]);
    }

}
