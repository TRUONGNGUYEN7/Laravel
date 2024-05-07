<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Models\AdminModel;
use DB;

class Subcategory extends AdminModel
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
          'id',  'name', 'danhmucID', 'status', 'created', 'created_by','modified',	'modified_by'
    ];
    protected $primaryKey = 'id';
    protected $table = 'chude';

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
            $this->setModifiedHistory($params);
            return self::create($params);
        }

        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            return self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public static function createNewSubcategory($request)
    {
        $subcategory = new self();
        $subcategory->status = $request->has('hienthi') ? 1 : 0;
        $subcategory->name = $request->name;
        $subcategory->danhmucID = $request->iddanhmuc;
        $subcategory->save();
    }

    public static function getSubmenuForCate($id)
    {
        return self::where('danhmucID', $id)->get();
    }

    public static function getActiveSubcategories() {
        return self::where('status', 'active')->get();
    }

    public static function updateSubcategory($request, $id)
    {
        self::where('id', $id)->update([
            'name' => $request->name,
            'danhmucID' => $request->iddanhmuc,
            'status' => $request->has('hienthi') ? 1 : 0
        ]);

        return back();
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

    public static function changeStatusSubcategory($id)
    {
        $Subcate = self::findOrFail($id);
        $oldTrangThai = $Subcate->status;
        $Subcate->update(['status' => !$oldTrangThai]);
        return $oldTrangThai;
    }

    //mot chu de thuoc ve mot danh muc
    public function danhmuc()
    {
        return $this->belongsTo(Category::class, 'danhmucID');

    }

    //mot chude co nhieu bai viet
    public function baiviets()
    {
        return $this->hasMany(Post::class, 'chudeID');
    }

}
