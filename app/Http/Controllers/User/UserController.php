<?php

namespace App\Http\Controllers\User;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Auth as Auth;
use App\Helpers\FTPHelper;
class UserController extends HomeController
{
    protected $moduleName = 'user';
    public function __construct()
    {
        $this->folderUpload = config('ntg.folderUpload.mainFolder');
        $this->fileUploadPath = '../' . $this->folderUpload . '/';
        $this->controllerName     = 'dashboard';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle = 'user';
        view()->share([
            'moduleName'     => $this->moduleName,
            'controllerName' => $this->controllerName,
            'pageTitle'=> $this->pageTitle,
            'fileUploadPath' => $this->fileUploadPath,
        ]);
    }

    public function index()
    {
        $CategoriesWithPosts = Category::getCategories(6);
        $menuCategory = Category::getActiveCategories();
        $subCategory = Subcategory::getActiveSubcategories();
        $fourCategoryContent = Category::getActiveCategories();
        $ttdanhmuc = collect();
        $Post = Post::getActivePosts(6);

        $imagesFTP = FTPHelper::downloadImagesFromFTP($Post);

        return view($this->pathViewController .'index', [
            'menuCategory' => $menuCategory,
            'subCategory' => $subCategory,
            'fourCategoryContent' => $fourCategoryContent,
            'CategoriesWithPosts' => $CategoriesWithPosts,
            'Post' => $Post,
            'imagesFTP' => $imagesFTP
        ]);
    }

    public function view($id, $iddm = null)
    {
        $selectedChudeID = $id;
        $Categories = Category::getCategories(4);
        $Post = Post::getActivePosts(6);
        
        // Fetch category and menu data
        $ttdanhmuc = Category::find($iddm ?? $id);
        $menuCategory = Category::getActiveCategories($iddm ?? $id);
        $menuchude = Subcategory::getSubmenuForCate($iddm ?? $id);

        // Fetch posts based on conditions
        if ($iddm !== null) {
            $ttchude = Subcategory::find($id);
            $getPosts = Post::getPostSubCate($id, $iddm, 5);
        } else {
            $ttchude ='';
            $getPosts = Post::getPostsCate($id, 6);
        }

        return view('user.danhmuc.index', compact(
            'menuCategory', 'ttdanhmuc', 'ttchude',
            'getPosts', 'menuchude', 'selectedChudeID', 'Post', 'Categories'
        ));
    }

    public function detail($id)
    {
        $ttbaiviet = Post::find($id);
        $menuCategory = Category::getActiveCategories($id);
        $menuchude = Subcategory::getSubmenuForCate($id);
        $viewPost = Post::getViewsPosts(4);
        $Post = Post::getActivePosts(6);
        $selectedChudeID = '';
        return view('user.elements.detail', compact(
            'menuCategory', 'ttbaiviet',
            'selectedChudeID', 'menuchude', 'Post'
        ));    
    } 

}
