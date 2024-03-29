<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App\Models\Subcategory;
use App\Models\Category;

use App\Http\Requests\SubcategoryCreateRequest;
use App\Http\Requests\SubcategoryUpdateRequest;

class SubcategoryController extends Controller
{

    public function index()
    {
        $dsdanhmuc = Subcategory::join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM')->paginate(5);
        return view('admin.chude.lietke', ['dsdanhmuccon' => $dsdanhmuc]);
    }

    public function create()
    {
        $dsdanhmuc = Category::where('TrangThaiDM', 1)->get();
        return view('admin.chude.them')->with('dsdanhmuc', $dsdanhmuc);
    }

    public function store(SubcategoryCreateRequest $request)
    {
        Subcategory::createNewSubcategory($request);
        return back();
    }

    public function status($id)
    {
        $value = Subcategory::changeStatusSubcategory($id);
        return response()->json(['status' => $value]);
    }

    public function update(SubcategoryUpdateRequest $request, $id){
        Subcategory::updateSubcategory($request, $id);
        return back();
    }

    public function edit($id){
        $dschudesua = Subcategory::join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM')
            ->where('tblchude.IDCD', $id)
            ->get();
        $dsdanhmuc = Category::where('TrangThaiDM', 1)->get();

        return view('admin.chude.sua')->with('dschudesua', $dschudesua)
        ->with('dsdanhmuc', $dsdanhmuc);
        
    }
    
    public function destroy($id)
    {
        Subcategory::deleteSubcategoryById($id);
        return back();
    }

}
