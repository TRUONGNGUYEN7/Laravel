<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function Authlogin()
    {
        $admin_username = Session::get('admin_username');
        if (!$admin_username) {
            return Redirect::to('admin/login')->send();
        }
    }

    public function chudehienthi()
    {
        $this->Authlogin();
        $dsdanhmuc = Subcategory::join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM') ->get();
        return view('admin.chude.lietke')->with('dsdanhmuccon', $dsdanhmuc);
    }

    public function chudethem()
    {
        $this->Authlogin();
        $dsdanhmuc = Category::where('TrangThaiDM', 1)->get();
        return view('admin.chude.them')->with('dsdanhmuc', $dsdanhmuc);
    }

    public function chudeaction_them(Request $request)
    {
        Subcategory::createNewSubcategory($request);
        return back();
    }

    public function chudehidden($id)
    {
        $this->Authlogin();
        Subcategory::hideSubcategoryById($id);
        return redirect()->to('admin/chude/hienthi');
    }

    public function chudeshow($id)
    {
        $this->Authlogin();
        Subcategory::showSubcategoryById($id);
        return redirect()->to('admin/chude/hienthi');
    }

    //suadm
    //POST
    public function chudeaction_sua(Request $request, $id){
        Subcategory::updateSubcategory($request, $id);
        return back();
    }

    public function chudesuadm($id){
        $this->Authlogin();
        $this->Authlogin();

        $dsdanhmucsua = Subcategory::join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM')
            ->where('tblchude.IDCD', $id)
            ->get();
    
        return view('admin.chude.sua')->with('dsdanhmucsua', $dsdanhmucsua);
    
    }
    
    public function chudexoadm($id)
    {
        $this->Authlogin();
        Subcategory::deleteSubcategoryById($id);
        return back();
    }

}
