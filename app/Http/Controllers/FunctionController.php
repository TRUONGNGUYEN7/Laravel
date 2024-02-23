<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Functionality;
use App\Models\Routes;

class FunctionController extends Controller
{
    public function createfunction()
    {
        $ds = Functionality::paginate(5)->fragment('ds');
        return view('admin.chucnang.lietke', ['ds' => $ds]);
    }

    public function getChucNangByChucNangId($id) {
        // Lấy danh sách chức năng từ bảng tblchucnang dựa trên ID chức năng
        $dsChucNang = Routes::where('IDCN', $id)->get();

        // Trả về danh sách chức năng dưới dạng JSON
        return response()->json($dsChucNang);
    }

    public function store(Request $request)
    {
        Functionality::checkAndCreateFunctionality($request);
        return back();
    }

    public function update(Request $request, $id){
        Functionality::updateFunction($request, $id);
        return back();
    }

    public function destroy($id)
    {
        Functionality::deleteFunctionById($id);
        return back();
    }
}
