<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Subcategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'IDCD',  'TenChuDe', 'DanhMucID', 'TrangThaiCD'
    ];
 
    protected $primaryKey = 'IDCD';
    protected $table = 'tblchude';

    public static function createNewSubcategory($request)
    {
        $tenChuDe = $request->tenchude;
        $subCategoryCheck = self::where('TenChuDe', $tenChuDe)->first();

        if ($subCategoryCheck) {
            return redirect()->back()->with('error', 'Chủ đề đã tồn tại');
        } else {
            $subcategory = new self();
            $subcategory->TrangThaiCD = $request->has('hienthi') ? 1 : 0;
            $subcategory->TenChuDe = $tenChuDe;
            $subcategory->DanhMucID = $request->idchude;
            $subcategory->save();

            Session::put('message', 'Thêm thành công');
            return back();
        }
    }

    public static function updateSubcategory($request, $id)
    {
        $chuDe = self::find($id);
        $tenChuDeMoi = $request->tenchude;

        if ($chuDe->TenChuDe == $tenChuDeMoi) {
            $chuDe->TrangThaiCD = $request->has('hienthi') ? 1 : 0;
            $chuDe->save();
        }

        $kiemTraTonTai = self::where('TenChuDe', $tenChuDeMoi)
            ->where('IDCD', '<>', $id)
            ->exists();

        if ($kiemTraTonTai) {
            Session::put('message', 'Tên danh mục đã tồn tại!!!');
        } else {
            $chuDe->TenChuDe = $tenChuDeMoi;
            $chuDe->DanhMucID = $request->iddanhmuc;
            $chuDe->TrangThaiCD = $request->has('hienthi') ? 1 : 0;
            $chuDe->save();
            Session::put('message', 'Cập nhật thành công!!!');
            return back();
        }
    }

    public static function deleteSubcategoryById($id)
    {
        self::destroy($id);
    }

    public static function StatusSubcategoryById($id, $value)
    {
        $subcategory = self::find($id);

        if ($subcategory) {
            if($value == 0)
            {
                $subcategory->TrangThaiCD = 1;
                $subcategory->save();
            }else
            {
                $subcategory->TrangThaiCD = 0;
                $subcategory->save();
            }

        }
    }

    public function danhmuc()
    {
        return $this->belongsTo(Category::class, 'DanhMucID');
    }
}
