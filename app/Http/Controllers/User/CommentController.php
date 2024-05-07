<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\User\HomeController;

class CommentController extends HomeController
{
    public function add(CommentRequest $request, $id)
    {
        $data = $request->all();
        $user = Comment::insert([
            'content' => $data['name'],
            'userID' => $id,
        ]);
        return response()->json([
            'success' => true,
            'route' => route('user.home', ['id' => $id])
        ]);
    }
}
