<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Home;
use App\Models\Admin\Post;
use App\Models\Admin\Category;

class Home extends Model
{
    use HasFactory;


    public static function getIndexData()
    {
        $maxViewPosts = Post::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID')
            ->orderByDesc('tblbaiviet.LuotXem')
            ->orderByDesc('tblbaiviet.IDBV')
            ->take(1)
            ->get();

        $secondPost = collect(); // Create a default empty collection.

        if (!$maxViewPosts->isEmpty()) {
            $secondPost = Post::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID')
                ->where('tblbaiviet.IDBV', '<>', $maxViewPosts->first()->IDBV)
                ->orderByDesc('tblbaiviet.IDBV')
                ->take(1)
                ->get();
        }

        if (!$maxViewPosts->isEmpty() && !$secondPost->isEmpty()) {
            $thirdPost = Post::join('tblchude', 'tblchude.IDCD', '=', 'tblbaiviet.ChuDeID')
                ->where('tblbaiviet.IDBV', '<>', $maxViewPosts->first()->IDBV)
                ->where('tblbaiviet.IDBV', '<>', $secondPost->first()->IDBV)
                ->orderByDesc('tblbaiviet.IDBV')
                ->take(2)
                ->get();
        }

        // Similar logic for third and fourth posts...

        $menuCategory = Category::where('TrangThaiDM', 1)->get();
        $fourCategoryContent = Category::where('TrangThaiDM', 1)->take(2)->get();
        return [
            'menuCategory' => $menuCategory,
            'maxViewPosts' => $maxViewPosts,
            'secondPost' => $secondPost,
            'thirdPost' => $thirdPost,
            'fourCategoryContent' => $fourCategoryContent,
        ];
    }

    public static function getCategoryContent()
    {
        return Category::where('TrangThaiDM', 1)->take(2)->get();
    }
    public function hienthidanhmuc($id)
    {
        $maxViewPost = Post::getMaxViewPosts($id);
        $fourPosts = Post::getFourPosts($id, $maxViewPost->first()->IDBV ?? null);

        $menuCategory = Category::where('TrangThaiDM', 1)->get();
        $ttdanhmuc = Category::find($id);

        return view('user.danhmuc.danhmuc', [
            'menuCategory' => $menuCategory,
            'ttdanhmuc' => $ttdanhmuc,
            'maxViewPost' => $maxViewPost,
            'FourPosts' => $fourPosts,
        ]);
    }
}
