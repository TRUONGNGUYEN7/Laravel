<?php

namespace App\Models;

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
        $subcategory = new self();
        $subcategory->TrangThaiCD = $request->has('hienthi') ? 1 : 0;
        $subcategory->TenChuDe = $request->tenchude;
        $subcategory->DanhMucID = $request->iddanhmuc;
        $subcategory->save();
    }

    public static function getSubmenuForCate($id)
    {
        return self::join('tbldanhmuc', 'tbldanhmuc.IDDM', '=', 'tblchude.DanhMucID') 
        ->where('tbldanhmuc.IDDM', $id)
        ->get();
    }
    
    public static function getActiveSubcategories() {
        return self::where('TrangThaiCD', 1)->get();
    }

    public static function updateSubcategory($request, $id)
    {
        self::where('IDCD', $id)->update([
            'TenChuDe' => $request->tenchude,
            'DanhMucID' => $request->iddanhmuc,
            'TrangThaiCD' => $request->has('hienthi') ? 1 : 0
        ]);

        return back();
    }

    public static function deleteSubcategoryById($id)
    {
        self::destroy($id);
    }

    public static function changeStatusSubcategory($id)
    {
        $Subcate = self::findOrFail($id);
        $oldTrangThai = $Subcate->TrangThaiCD;
        $Subcate->update(['TrangThaiCD' => !$oldTrangThai]);
        return $oldTrangThai;
    }

    //mot chu de thuoc ve mot danh muc
    public function danhmuc()
    {
        return $this->belongsTo(Category::class, 'IDDM');

    }

    //mot chude co nhieu bai viet
    public function baiviets()
    {
        return $this->hasMany(Post::class, 'ChuDeID');
    }

}
