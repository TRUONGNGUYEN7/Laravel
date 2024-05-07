<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth as Auth;
class AdminModel extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $fillable = [
   'name', 'password', 'fullName', 'email', 'roleID', 'status', 'created', 'created_by','modified',	'modified_by'
    ];
    protected $folderUpload = '' ;
    protected $crudNotAccepted = [
        '_token',
    ];

    public function setCreatedHistory(&$params)
    {
        $params['created_by'] = Auth::guard('admin')->user()->id;
        $params['created']    = date('Y-m-d');
    }

    public function setModifiedHistory(&$params){
        $params['modified_by']   = Auth::guard('admin')->user()->id;
        $params['modified']      = date('Y-m-d');
    }

    public function uploadFile($fileObj) {
        if (!is_array($fileObj)){
            $tmpObj[] = $fileObj;
            $fileObj = $tmpObj;
        }
        $arrFileAttach = array();
        $arrFileHash = array();
        foreach($fileObj as $fileItem){
            $fileName       = Str::random(10) . '.' . $fileItem->clientExtension();
            // $fileItem->storeAs($this->folderUpload, $fileName, 'ntg_storage' );
            $arrFileHash[] = $fileName;
            $name = basename($fileItem->getClientOriginalName(), '.'. $fileItem->getClientOriginalExtension());
            $arrFileAttach[] = Str::slug($name ,'-') . '.' . $fileItem->clientExtension();;
        }
        $arrFileHash = implode('|',$arrFileHash);
        $arrFileAttach = implode('|',$arrFileAttach);
        return [
        'fileAttach' =>$arrFileAttach,
        'fileHash'  => $arrFileHash
        ];
    }

    public function prepareParams($params){
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }

    //mot admin có 1 vai tro
    public function roles()
    {
        return $this->belongsTo(Roles::class, 'roleID', 'id');
    }

    public static function Authenticate($adminname, $adminpass)
    {
        $admin = self::where('name', $adminname)->first(); 
        if ($admin && Hash::check($adminpass, $admin->password)) {
            return $admin;
        }
        return null;
    }

    public static function getAdmin()
    {
        return self::all();
    }

    public static function getaccountByID($id)
    {
        $admin = self::find($id);
        if ($admin) {
            // Chuyển đổi đối tượng Admin thành mảng
            $adminArray = $admin->toArray();
            return $adminArray;
        }
        return null;
    }

    // Admin.php

    public function updateAccount($id, $data)
    {
        // Update account information directly
        $this->where('id', $id)->update([
            'name' => $data['name'],
            'fullName' => $data['fullName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'roleID' => $data['roleID'],
            'status' => $data['status']
        ]);
    }

    public static function changeStatusAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $oldTrangThai = $admin->status;
        $admin->update(['status' => !$oldTrangThai]);
        return $oldTrangThai;
    }

    public static function deleteAdminById($id)
    {
        self::destroy($id);
    }

}
