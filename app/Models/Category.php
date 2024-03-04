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
        $category = new self();
        $category->TrangThaiDM = $request->has('hienthi') ? 1 : 0;
        $category->TenDanhMuc = $categoryName;
        $category->save();
    }

    
    public static function getCategoryById($id) {
        return self::where('IDDM', $id)->get();
    }

    public static function updateCategory($id, $request)
    {
        self::where('IDDM', $id)->update($request->validated());
        return back();
    }

    public static function changeStatusCategory($id, $value)
    {
        self::where('IDDM', $id)->update(['TrangThaiDM' => !$value]);
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

    //mot danh muc co nhieu chu de
    public function chudes()
    {
        return $this->hasMany(Subcategory::class, 'DanhMucID');
    }


}
