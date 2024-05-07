<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Models\AdminModel;
use DB;

class Category extends AdminModel
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'danhmuc';
    public $incrementing = false;
    protected $fillable = [
          'id',  'name', 'status', 'created', 'created_by','modified',	'modified_by'
    ];

    public static function getItem($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::where('id', $params['id'])->first();
        }
        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            self::create($params);
        }

        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public static function checkAndCreateCategory($request)
    {
        $categoryName = $request->TenDanhMuc;
        $category = new self();
        $category->status = $request->has('hienthi') ? 1 : 0;
        $category->TenDanhMuc = $categoryName;
        $category->save();
    }

    
    public static function getCategoryById($id) {
        return self::where('id', $id)->get();
    }

    public static function changeStatusCategory($id)
    {
        $cate = self::findOrFail($id);
        $oldTrangThai = $cate->status;
        $cate->update(['status' => !$oldTrangThai]);
        return $oldTrangThai;
    }

    public static function getDanhMucData($id)
    {
        $maxViewPost = Post::join('chude', 'baiviet.chudeID', '=', 'chude.id')
            ->join('danhmuc', 'chude.danhmucID', '=', 'danhmuc.id')
            ->where('danhmuc.id', $id)
            ->orderByDesc('baiviet.id')
            ->take(1)
            ->get();

        $fourPosts = collect(); // Tạo một Collection trống mặc định.
        if (!$maxViewPost->isEmpty()) {
            // Lấy 4 bài viết khác trong cùng danh mục
            $fourPosts = Post::join('chude', 'baiviet.chudeID', '=', 'chude.id')
                ->join('danhmuc', 'chude.danhmucID', '=', 'danhmuc.id')
                ->where('danhmuc.id', $id)
                ->where('baiviet.id', '<>', $maxViewPost->first()->id)
                ->orderByDesc('baiviet.id')
                ->take(4)
                ->get();
        }

        $menuCategory = Category::where('status', 1)->get();
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
        return $this->where('id', $id)->get();
    }
    public static function getActiveCategories()
    {
        return self::where('status', 'active')->get();
    }

    public static function getCategories($sl)
    {
        return self::where('status', 'active')
        ->orderByDesc('danhmuc.id')
        ->take($sl)
        ->get(); 
    }

    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
            $record = self::find($params['id']);
            if (!$record) {
                return false;
            }
            $record->delete();
        }
    }
    //mot danh muc co nhieu chu de
    public function chudes()
    {
        return $this->hasMany(Subcategory::class, 'danhmucID');
    }


}
