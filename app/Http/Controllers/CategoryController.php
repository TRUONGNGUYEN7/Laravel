<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $dsdanhmuc = Category::all();
        return view('admin.danhmuc.lietke')->with('dsdanhmuc', $dsdanhmuc);
    }

    public function create()
    {
        return view('admin.danhmuc.them');
    }

    public function store(CategoryRequest $request)
    {
        Category::checkAndCreateCategory($request);
        return back();
    }
    

    public function status($id, $value)
    {
        Category::StatusCategoryById($id, $value);
        return back();
    }

    public function action_sua(CategoryRequest $request, $id){
        Category::updateCategory($id, $request);
        return back();
    }

    public function sua($id){
        $dsdanhmuc = Category::getCategoryById($id);
        return view('admin.danhmuc.sua') -> with('dsdanhmuc', $dsdanhmuc);
    }

    public function xoa($id)
    {
        Category::deleteCategoryById($id);
        return back();
    }
}
