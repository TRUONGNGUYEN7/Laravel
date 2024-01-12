<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Category extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'IDDM';
    protected $table = 'tbldanhmuc';
    public $incrementing = false;
    protected $fillable = [
          'IDDM',  'TenDanhMuc',  'TrangThaiDM'
    ];

    public static function checkAndCreateCategory($request)
    {
        $categoryName = $request->tendanhmuc;

        $categoryCheck = self::where('TenDanhMuc', $categoryName)->first();

        if ($categoryCheck) {
            return redirect()->back()->with('error', 'Danh mục đã tồn tại');
        } elseif ($categoryName == null) {
            Session::put('message', 'Các trường không được để trống!!!');
            return back();
        } else {
            $category = new self();
            $category->TrangThaiDM = $request->has('hienthi') ? 1 : 0;
            $category->TenDanhMuc = $categoryName;
            $category->save();
            Session::put('message', 'Thêm thành công');
            return back();
        }
    }

    public static function updateCategory($id, $request)
    {
        $category = self::find($id);
        $newCategoryName = $request->tendanhmuc;

        if ($category->TenDanhMuc == $newCategoryName) {
            $category->TrangThaiDM = $request->has('hienthi') ? 1 : 0;
            $category->save();
        } else {
            $isNameExists = self::where('TenDanhMuc', $newCategoryName)
                ->where('IDDM', '<>', $id)
                ->exists();

            if ($isNameExists) {
                Session::put('message', 'Tên danh mục đã tồn tại!!!');
            } else {
                $category->TenDanhMuc = $newCategoryName;
                $category->TrangThaiDM = $request->has('hienthi') ? 1 : 0;
                $category->save();
                Session::put('message', 'Cập nhật thành công!!!');
                return back();
            }
        }
    }

    public static function StatusCategoryById($id, $value)
    {
        $category = self::find($id);

        if ($category) {
            if($value == 0)
            {
                $category->TrangThaiDM = 1;
                $category->save();
            }else
            {
                $category->TrangThaiDM = 0;
                $category->save();
            }

        }
    }

    public static function deleteCategoryById($id)
    {
        self::destroy($id);
    }

    public function chudes()
    {
        return $this->hasMany(Subcategory::class, 'DanhMucID');
    }
}
