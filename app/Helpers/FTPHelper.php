<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Post;
use DB;
use App\Jobs\DownloadImageFromFTP;
use Illuminate\Support\Facades\Response;
class FTPHelper
{    
   public static function processImagesInContent($content)
    {
        // Tìm kiếm các hình ảnh trong nội dung CKEditor
        preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches, PREG_SET_ORDER);
 
        // Duyệt qua từng hình ảnh trong nội dung
        foreach ($matches as $match) {
            $imageUrl = $match[1];
            // Kiểm tra xem đường dẫn hình ảnh là base64 hay URL
            if (strpos($imageUrl, 'data:image') === 0) {
                // Xử lý hình ảnh dưới dạng base64
                $imageHashContent = self::uploadImageFromBase64ToFTP($imageUrl);
            } else {
                // Xử lý hình ảnh dưới dạng URL
                $imageHashContent = self::uploadImageFromURLToFTP($imageUrl);
            }
            
            // Thay thế đường dẫn hình ảnh trong nội dung CKEditor bằng đường dẫn trên FTP
            $content = str_replace($imageUrl, $imageHashContent, $content);
        }
        return $content;
    }

    public static function deleteImagesFromFTP($content, $imageHash)
    {
        // Tìm kiếm các hình ảnh trong nội dung CKEditor
        preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches, PREG_SET_ORDER);

        // Duyệt qua từng hình ảnh trong nội dung để xóa
        foreach ($matches as $match) {
            $imageUrl = $match[1];
            // Lấy tên tệp từ URL
            $fileName = basename($imageUrl);
            // Xóa tệp trên FTP
            Storage::disk('ftp')->delete('/imagesPost/' .$fileName);
        }

        Storage::disk('ftp')->delete('/imagesPost/' .$imageHash);
    }

    public static function deleteImagesContentFTP($contentold)
    {
        // Tìm kiếm các hình ảnh trong nội dung CKEditor
        preg_match_all('/<img[^>]+src="([^">]+)"/', $contentold, $matches, PREG_SET_ORDER);
        
        // Duyệt qua từng hình ảnh trong nội dung để xóa
        foreach ($matches as $match) {
            $imageUrl = $match[1];
            // Lấy tên tệp từ URL
            $fileName = basename($imageUrl);

            // Xóa tệp trên FTP
            Storage::disk('ftp')->delete('/imagesPost/' .$fileName);
        }
    }

    public static function deleteImagesLogoFTP($logo)
    {
        Storage::disk('ftp')->delete('/imagesPost/' .$logo);
    }

    public static function downloadImagesFromFTP($ds)
    {
        $imagesFTP = [];
        foreach ($ds as $post) {
            if (isset($post->image)) {
                // Nếu có imageHash
                $imageHashList = $post->image;
                
                // Kiểm tra xem tệp đã tồn tại trong thư mục fileUpload
                if (!Storage::disk('ntg_storage')->exists($imageHashList)) {
                    $imagesFTP[] = $imageHashList; 
                    DownloadImageFromFTP::dispatch($imageHashList);             
                }
            }
        }

        return $imagesFTP;
    }

    public static function uploadImageToFTP($image, $id = null)
    {

        // Lấy tên file gốc của file
        $filenamewithextension = $image->getClientOriginalName();
        // Lấy tên file không kèm extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        // Lấy extension của file
        $extension = $image->getClientOriginalExtension();
        // Tạo tên file mới để lưu trữ trên server
        $filenametostore = 'imagesPost/logo'.$filename.'_'.uniqid().'.'.$extension;
        $filenamesql = str_replace('imagesPost/', '', $filenametostore);

        // Thực hiện upload file lên máy chủ FTP
        if (Storage::disk('ftp')->put($filenametostore, fopen($image->path(), 'r+'))) {
            // Nếu upload thành công, trả về tên file mới
            return $filenamesql;

            if($id)
            {
                $item = Post::find($id);
                self::deleteImagesLogoFTP($item->content);
            } 

        } else {
            // Nếu upload thất bại, trả về false
            return false;
        }
    }

    public static function uploadImageFromBase64ToFTP($base64Image)
    {
        // Tách dữ liệu hình ảnh từ chuỗi base64
        $base64Data = explode(',', $base64Image);
        $imageData = base64_decode($base64Data[1]); // Dữ liệu hình ảnh sẽ ở phần tử thứ hai
        
        // Lấy loại hình ảnh từ định dạng base64
        $imageType = self::getImageTypeFromBase64($base64Data[0]); // base64Data[0] chứa định dạng hình ảnh (ví dụ: "data:image/jpeg;base64")

        // Kiểm tra xem loại hình ảnh có được hỗ trợ hay không
        if (!$imageType || !in_array($imageType, ['jpeg', 'jpg', 'png', 'gif'])) {
            return false;
        }

        // Tạo tên tệp duy nhất
        $fileName = 'imagesPost/base' . uniqid() . '.' . $imageType;
        $fileNamesql = str_replace('imagesPost/', '', $fileName);
        // Lưu tệp vào đĩa FTP
        if (Storage::disk('ftp')->put($fileName, $imageData)) {
            // Nếu upload thành công, trả về đường dẫn đầy đủ của tệp
            return $fileNamesql;
        } else {
            // Nếu không upload thành công, trả về false hoặc thực hiện xử lý phù hợp
            return false;
        }
    }

    // Hàm để lấy loại hình ảnh từ định dạng base64
    private static function getImageTypeFromBase64($base64Format)
    {
        // Kiểm tra định dạng base64 có tồn tại hay không
        if (preg_match('/^data:image\/(\w+);base64/', $base64Format, $matches)) {
            return $matches[1]; // Trả về loại hình ảnh (ví dụ: "jpeg", "png", "gif")
        } else {
            return false;
        }
    }

    public static function uploadImageFromURLToFTP($imageUrl)
    {
        // Kiểm tra extension của file hình ảnh từ URL
        $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
        
        // Tạo tên file mới để lưu trữ trên máy chủ FTP
        $filename = 'imagesPost/url' . uniqid() . '.' . $extension;

        $filenamesql = str_replace('imagesPost/', '', $filename);
        // Tải dữ liệu hình ảnh từ URL
        $imageData = file_get_contents($imageUrl);
        // Kiểm tra nếu tải dữ liệu thành công
        if ($imageData !== false) {

            if (Storage::disk('ftp')->put($filename, $imageData)) {

                // Nếu upload thành công, trả về tên file mới
                return $filenamesql;
            } else {
                // Nếu upload thất bại, trả về false
                return false;
            }
        } else {
            // Nếu có lỗi khi tải hình ảnh từ URL, trả về false
            return false;
        }
    }

}