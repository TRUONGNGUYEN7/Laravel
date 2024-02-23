<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Functionality extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'IDCN';
    protected $table = 'tblchucnang';
    public $incrementing = false;
    protected $fillable = [
          'IDCN',  'TenCN'
    ];

    public static function getActiveFunction() {
        return self::get();
    }

    public static function checkAndCreateFunctionality($request)
    {
        $FunctionalityName = $request->tencn;

        $FunctionalityCheck = self::where('TenCN', $FunctionalityName)->first();

        $Function = new self();
        $Function->TenCN = $FunctionalityName;
        $Function->save();
        Session::put('message', 'Thêm thành công');
        
    }

    public static function updateFunction($id, $request)
    {
        $Function = self::find($id);

        $newFunctionName = $request->TenCN;
        console.log($newFunctionName);
        $isNameExists = self::where('TenCN', $newFunctionName)
            ->where('IDCN', '<>', $id)
            ->exists();

        if ($isNameExists) {
            return response()->json(['message' => 'Tên chức năng đã tồn tại!!!'], 400);
        } else {
            $Function->TenCN = $newFunctionName;
            $Function->save();
            return response()->json(['message' => 'Cập nhật thành công!!!'], 200);
        }
    }

    public static function deleteFunctionById($id)
    {
        self::destroy($id);
    }
    
}
