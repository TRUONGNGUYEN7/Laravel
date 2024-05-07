<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFileUploadAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem URL yêu cầu truy cập trực tiếp vào thư mục fileUpload hay không
        if (strpos($request->url(), '/fileUpload/') !== false) {
            // Nếu yêu cầu truy cập trực tiếp, chuyển hướng hoặc trả về lỗi
            return response()->json(['error' => 'Access forbidden'], 403);
        }

        // Cho phép tiếp tục xử lý yêu cầu nếu không truy cập trực tiếp vào thư mục fileUpload
        return $next($request);
    }
}
