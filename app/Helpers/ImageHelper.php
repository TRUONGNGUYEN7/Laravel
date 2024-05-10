<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class ImageHelper
{
    public static function getImageUrl($PostTemp, $imagesFTP, $fileUploadPath)
    {
          return in_array($PostTemp->imageHash, $imagesFTP) 
          ? route('displayImages', ['fileName' => $PostTemp->imageHash])
          : asset($fileUploadPath . $PostTemp->imageHash);
    }
}
