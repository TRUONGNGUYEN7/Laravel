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
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function hienthi($id, $iddm = null)
    {
        if ($iddm !== null) {
            $menuCategory = Category::getActiveCategories();
            $ttdanhmuc = Category::find($iddm);
            $ttchude = Subcategory::find($id);
            $FourPosts = Post::getPostSubCate($id, $iddm, 5);
            $menuchude = Subcategory::getSubmenuForCate($iddm);
            $SixPostsNewUpdate = Post::getPostsCate($id,6);
            $selectedChudeID = $id;
            $viewPost = Post::getViewsPosts(4);
            return view('user.danhmuc.chude', compact(
                'menuCategory', 'ttdanhmuc', 'ttchude',
                'FourPosts', 'menuchude', 'selectedChudeID', 'viewPost','SixPostsNewUpdate',
            ));
        } else {
            $ttdanhmuc = Category::find($id);
            $menuCategory = Category::getActiveCategories($id);
            $menuchude = Subcategory::getSubmenuForCate($id);
            $FourPosts = Post::getPostsCate($id, 5);
            $SixPostsNewUpdate = Post::getPostsCate($id,6);
            $CategoriesWithPosts = Category::getCategories(4);
            $selectedChudeID = '';
            $viewPost = Post::getViewsPosts(4);
            return view('user.danhmuc.danhmuc', compact(
                'menuCategory', 'ttdanhmuc', 'FourPosts', 
                'selectedChudeID', 'menuchude', 'SixPostsNewUpdate', 'viewPost', 'CategoriesWithPosts'
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

    public function signup_action(Request $request)
    {
        // Xác thực dữ liệu đầu vào và đặt các thông báo tùy chỉnh
        $validatedData = $request->validate([
            'TenUS' => 'required|unique:tbluser,TenUS',
            'MatKhauUS' => 'required',
            'EmailUS' => 'required|email|unique:tbluser,EmailUS',
        ], [
            'TenUS.required' => 'Tên đăng nhập là trường bắt buộc.',
            'TenUS.unique' => 'Tên đăng nhập đã được sử dụng, vui lòng chọn tên khác.',
            'MatKhauUS.required' => 'Mật khẩu là trường bắt buộc.',
            'EmailUS.required' => 'Địa chỉ email là trường bắt buộc.',
            'EmailUS.email' => 'Địa chỉ email không hợp lệ.',
            'EmailUS.unique' => 'Địa chỉ email đã được sử dụng, vui lòng sử dụng địa chỉ email khác.',
        ]);

        $user= User::Signup($request);
        if ($user) {
            $request->session()->flash('message', 'Đăng ký thành công');
            return redirect()->to('/user/signin');
        } else {
            
            return back();
        }
        
    }

    public function signin()
    {
        return view('user.page.login.login');
    }
    
    public function signin_action(Request $request)
    {
        $username = $request->name;
        $userpass = $request->password;

        $authenticateduser = User::Signin($username, $userpass);

        if ($authenticateduser) {
            if ($authenticateduser->TrangThaiUS == 0) {
                return response()->json(['success' => false, 'message' => 'Bạn chưa có quyền đăng nhập!!!']);
            } else {
                $userData = [
                    'user_username' => $authenticateduser->TenUS,
                    'user_id' => $authenticateduser->IDUS,
                ];

                Session::put('user_data', $userData);
                return response()->json(['success' => true, 'message' => 'Đăng nhập thành công']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Tài khoản hoặc mật khẩu không đúng, vui lòng thử lại!!!']);
        }
    }

    public function logout(){
        Session::forget('admin_data');
        return back();
    }
    
}
