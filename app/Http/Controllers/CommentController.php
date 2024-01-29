<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function addcomment(CommentRequest $request, $id)
    {
        Comment::Addcomment($request, $id);
        return response()->json([
            'success' => true,
            'route' => route('user.home', ['idbv' => $id])
        ]);
    }
}
