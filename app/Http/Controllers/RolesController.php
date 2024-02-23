<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use App\Models\Functionality;
use App\Models\Routes;
use App\Models\Roles;


class RolesController extends Controller
{
    public function index()
    {
        $dschucnang = Functionality::getActiveFunction();
        $dsvaitro = Roles::getRoles();
        return view('admin.nhomquyen.them')->with('dschucnang', $dschucnang)->with('dsvaitro', $dsvaitro);
    }

    public function store(Request $request)
    {
        Roles::checkAndCreateRoles($request);
        return back();
    }

    public function updateDataroute(Request $request, $id)
    {
        // Lấy dữ liệu JSON từ request
        $jsonData = $request->json()->all();

        // Lấy giá trị dataroute từ JSON
        $dataroute = $jsonData['selectedActions'];

        // Gọi phương thức updateDataroute trong model Role để cập nhật dữ liệu
        Roles::updateDataroute($id, $dataroute);

        // Trả về phản hồi (nếu cần)
        return response()->json(['message' => 'Dữ liệu đã được cập nhật thành công'], 200);
    }
}
