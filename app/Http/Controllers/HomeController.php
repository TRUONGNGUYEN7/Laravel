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
        $CategoriesWithPosts = Category::getCategories(6);
        $FourPosts = Post::getLatestPosts();
    
        $menuCategory = Category::getActiveCategories();
        $fourCategoryContent = Category::getActiveCategories();
        $ttdanhmuc = collect();

        $SixPostsNewUpdate = Post::getLatestPosts(6);
        $viewPost = Post::getViewsPosts(4);
        return view('user.page.home', [
            'menuCategory' => $menuCategory,
            'FourPosts' => $FourPosts,
            'fourCategoryContent' => $fourCategoryContent,
            'CategoriesWithPosts' => $CategoriesWithPosts,
            'SixPostsNewUpdate' => $SixPostsNewUpdate,
            'viewPost' => $viewPost
        ]);
    }

}
