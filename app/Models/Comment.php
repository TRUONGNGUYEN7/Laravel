<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $primaryKey = 'IDUS';
    protected $table = 'tblbinhluan';
    public static function Addcomment($request, $id)
    {
        $comment = new self();
        $comment->Noidung = $request->noidung;
        $comment->Email = $request->email;
        $comment->UserID = $id;
        $comment->save();


    }

}
