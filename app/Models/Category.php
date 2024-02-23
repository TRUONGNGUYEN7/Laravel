<?php

namespace App\Models;

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
            Session::flash('message', 'Danh mục đã tồn tại!');
        } else {
            $category = new self();
            $category->TrangThaiDM = $request->has('hienthi') ? 1 : 0;
            $category->TenDanhMuc = $categoryName;
            $category->save();
            Session::flash('message', 'Thêm thành công!');
        }
    }
    
    public static function getCategoryById($id) {
        return self::where('IDDM', $id)->get();
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
                Session::flash('message', 'Tên danh mục đã tồn tại!!!');
            } else {
                $category->TenDanhMuc = $newCategoryName;
                $category->TrangThaiDM = $request->has('hienthi') ? 1 : 0;
                $category->save();
                Session::flash('message', 'Cập nhật thành công!!!');
                return back();
            }
        }
    }

    public static function StatusCategoryById($id, $value)
    {
        $category = self::find($id);

        if ($category) {
            // Toggle TrangThaiDM using a ternary operator
            $category->TrangThaiDM = ($value === 0 || $value === '0') ? 1 : 0;

            // Save the changes
            $category->save();
        }
    }

    public static function getDanhMucData($id)
    {
        $maxViewPost = Post::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
            ->join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM')
            ->where('tbldanhmuc.IDDM', $id)
            ->orderByDesc('tblbaiviet.IDBV')
            ->take(1)
            ->get();

        $fourPosts = collect(); // Tạo một Collection trống mặc định.
        if (!$maxViewPost->isEmpty()) {
            // Lấy 4 bài viết khác trong cùng danh mục
            $fourPosts = Post::join('tblchude', 'tblbaiviet.ChuDeID', '=', 'tblchude.IDCD')
                ->join('tbldanhmuc', 'tblchude.DanhMucID', '=', 'tbldanhmuc.IDDM')
                ->where('tbldanhmuc.IDDM', $id)
                ->where('tblbaiviet.IDBV', '<>', $maxViewPost->first()->IDBV)
                ->orderByDesc('tblbaiviet.IDBV')
                ->take(4)
                ->get();
        }

        $menuCategory = Category::where('TrangThaiDM', 1)->get();
        $ttdanhmuc = Category::find($id);

        return [
            'menuCategory' => $menuCategory,
            'ttdanhmuc' => $ttdanhmuc,
            'maxViewPost' => $maxViewPost,
            'FourPosts' => $fourPosts,
        ];
    }
    public function getCategoriesById($id)
    {
        return $this->where('IDDM', $id)->get();
    }
    public static function getActiveCategories()
    {
        return self::where('TrangThaiDM', 1)->get();
    }

    public static function getCategories($sl)
    {
        return self::where('TrangThaiDM', 1)
        ->orderByDesc('tbldanhmuc.IDDM')
        ->take($sl)
        ->get(); 
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
