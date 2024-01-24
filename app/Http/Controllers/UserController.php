<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;
class UserController extends Controller
{
    public function addcomment(CommentRequest $request)
    {
        User::Addcomment($request);
        return back();
    }

    public function hienthi($id, $iddm = null)
    {
        if ($iddm !== null) {
            $menuCategory = Category::getActiveCategories();
            $ttdanhmuc = Category::find($iddm);
            $ttchude = Subcategory::find($id);
            $FourPosts = Post::getPostSubCate($id, $iddm, 4);
            $menuchude = Subcategory::getSubmenuForCate($iddm);
            $selectedChudeID = $id;
            return view('user.danhmuc.chude', compact(
                'menuCategory', 'ttdanhmuc', 'ttchude',
                'FourPosts', 'menuchude', 'selectedChudeID'
            ));
        } else {
            $ttdanhmuc = Category::find($id);
            $menuCategory = Category::getActiveCategories($id);
            $menuchude = Subcategory::getSubmenuForCate($id);
            $FourPosts = Post::getPostsCate($id, 4);

            $selectedChudeID = '';
            return view('user.danhmuc.danhmuc', compact(
                'menuCategory', 'ttdanhmuc', 'FourPosts', 
                'selectedChudeID', 'menuchude'
            ));    
        }
    } 

    public function detail($id)
    {
        $ttbaiviet = Post::find($id);
        $menuCategory = Category::getActiveCategories($id);
        $menuchude = Subcategory::getSubmenuForCate($id);
        $viewPost = Post::getViewsPosts(4);
        Post::ViewPlusPost($id);
        $selectedChudeID = '';
        return view('user.page.detail', compact(
            'menuCategory', 'ttbaiviet',
            'selectedChudeID', 'menuchude', 'viewPost'
        ));    
    } 

    public function signup()
    {
        return view('user.page.signup.signup');
    }
    public function signup_action(CommentRequest $request)
    {
        $user =User::Signup($request);
        if ($user) {
            $request->session()->flash('message', 'Đăng ký thành công');
        } else {
            $request->session()->flash('message', 'Có lỗi xảy ra trong quá trình đăng ký');
        }
        return redirect()->to('/user/signin');
    }

    public function signin()
    {
        return view('user.page.login.login');
    }
    public function signin_action(CommentRequest $request)
    {
        $username = $request->name;
        $userpass = $request->password;
    
        $authenticateduser = User::Signin($username, $userpass);
    
        if ($authenticateduser) {
            if ($authenticateduser->TrangThaiUS == 0) {
                Session::put('message', 'Bạn chưa có quyền đăng nhập!!!');
                return back();
            } else {

                $userData = [
                    'user_username' => $authenticateduser->TenUS,
                    'user_id' => $authenticateduser->IDUS,
                ];
                
                Session::put('user_data', $userData);
                return redirect()->route('user.home');
            }
        } else {
            $request->session()->flash('message', 'Tài khoản hoặc mật khẩu của bạn không đúng, vui lòng thử lại!!!');
            return back();
        }
    }

    public function logout(){

        session() -> flush();
        return back();
    }
    
}
