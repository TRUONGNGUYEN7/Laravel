<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Models\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $dsdanhmuc = Category::paginate(5)->fragment('dsdanhmuc');
        return view('admin.danhmuc.lietke')->with('dsdanhmuc', $dsdanhmuc);
    }

    public function create()
    {
        return view('admin.danhmuc.them');
    }

    public function store(CategoryCreateRequest $request)
    {
        Category::checkAndCreateCategory($request); 
        return back();
    }
    
    public function status($id, $value)
    {
        Category::changeStatusCategory($id, $value);
        return response()->json(['status' => $value]);
    }

    public function update(CategoryUpdateRequest $request, $id){
        Category::updateCategory($id, $request);
        return back();
    }

    public function edit($id){
        $dsdanhmuc = Category::getCategoryById($id);
        return view('admin.danhmuc.sua') -> with('dsdanhmuc', $dsdanhmuc);
    }

    public function destroy($id)
    {
        Category::deleteCategoryById($id);
        return back();
    }
}
