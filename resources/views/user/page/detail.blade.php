@extends('layout')
@section('detail')
<!-- Content -->
<style>
.noidung {
     max-width: 100%;
     height: auto;
     vertical-align: middle;
     cursor: pointer;
     display: block;
     margin: 0 auto;
}
</style>
<section class="bg0 p-b-140 p-t-10">
     <div class="container">
          <div class="row justify-content-center">
               <div class="col-md-10 col-lg-8 p-b-30">
                    <div class="p-r-10 p-r-0-sr991">
                         <!-- Blog Detail -->
                         @if ($ttbaiviet)
                         <div class="p-b-70">
                              <!-- <a href="#" class="f1-s-10 cl2 hov-cl10 trans-03 text-uppercase">
                                   Danh mục
                              </a> -->

                              <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                                   {{ $ttbaiviet->TenBV }}
                              </h3>

                              <div class="flex-wr-s-s p-b-40">
                                   <span class="f1-s-3 cl8 m-r-15">
                                        <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                             {{ $ttbaiviet->NguoiDangBV }}
                                        </a>
                                        <span class="m-rl-3">-</span>
                                        <span>
                                             {{ $ttbaiviet->ThoiGianBV }}
                                        </span>
                                   </span>

                                   <span class="f1-s-3 cl8 m-r-15">
                                        {{ $ttbaiviet->LuotXem }} Views
                                   </span>

                                   <a href="#" class="f1-s-3 cl8 hov-cl10 trans-03 m-r-15">
                                        0 Comment
                                   </a>
                              </div>

                              <p class="f1-s-11 cl6 p-b-25">
                                   {{ $ttbaiviet->Mota }}
                              </p>
                              <div class="noidung">
                              <?php
                                   $content = $ttbaiviet->NoiDung;
                                   // Check if the content contains images
                                   if (strpos($content, '<img') !== false) {
                                        preg_match_all('/<img[^>]+>/i', $content, $matches);
                                        $images = $matches[0];
                                        // Apply styling to each image
                                        foreach ($images as $image) {
                                             $styledImage = str_replace('<img ', '<img style="max-width:99%; height:auto;" ', $image);
                                             $content = str_replace($image, $styledImage, $content);
                                        }
                                   }
                                   echo '<div style="line-height:;">' . str_replace('<p>', '<p style="margin-bottom: -25px;">', nl2br($content)) . '</div>';
                              ?>
                              </div>

                              <br>
                              <!-- Tag -->
                              <div class="flex-s-s p-t-12 p-b-15">
  
                              </div>

                              <!-- Share -->
                              <div class="flex-s-s">
                                   <span class="f1-s-12 cl5 p-t-1 m-r-15">
                                        Share:
                                   </span>

                                   <div class="flex-wr-s-s size-w-0">
                                        <a href="#"
                                             class="dis-block f1-s-13 cl0 bg-facebook borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                             <i class="fab fa-facebook-f m-r-7"></i>
                                             Facebook
                                        </a>

                                        <a href="#"
                                             class="dis-block f1-s-13 cl0 bg-twitter borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                             <i class="fab fa-twitter m-r-7"></i>
                                             Twitter
                                        </a>

                                        <a href="#"
                                             class="dis-block f1-s-13 cl0 bg-google borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                             <i class="fab fa-google-plus-g m-r-7"></i>
                                             Google+
                                        </a>

                                        <a href="#"
                                             class="dis-block f1-s-13 cl0 bg-pinterest borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                                             <i class="fab fa-pinterest-p m-r-7"></i>
                                             Pinterest
                                        </a>
                                   </div>
                              </div>
                         </div>
                         @else
                         Bài viết không tồn tại
                         @endif
                         <!-- Leave a comment -->
                         <div>
                              <h4 class="f1-l-4 cl3 p-b-12">
                              Để lại một bình luận
                              </h4>

                              <p class="f1-s-13 cl8 p-b-40">
                                   Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu *
                              </p>

                              <form action="{{ route('user.comment.add') }}" method="POST">
                              {{ csrf_field() }}
                                   <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20"
                                        name="noidung" id="noidung" required placeholder="Comment..."></textarea>
                                   <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20"
                                        type="text" name="name" required placeholder="Name*">
                                   <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20"
                                        type="text" name="email" required placeholder="Email*">
                                   <button class="size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">
                                        Post Comment
                                   </button>
                              </form>
                         </div>
                    </div>
               </div>

               <!-- Sidebar -->
               <div class="col-md-10 col-lg-4 p-b-30">
                    <div class="p-l-10 p-rl-0-sr991 p-t-70">

                         <!-- Popular Posts -->
                         <div class="p-b-30">
                              <div class="how2 how2-cl4 flex-s-c">
                                   <h3 class="f1-m-2 cl3 tab01-title">
                                        Xem nhiều
                                   </h3>
                              </div>

                              <ul class="p-t-35">
                                   <li class="flex-wr-sb-s p-b-30">
                                        @foreach($viewPost as $key)
                                             <a href="#" class="size-w-10 wrap-pic-w hov1 trans-03">
                                                  <img style="margin-bottom: 10px" src='{{asset("hinhanh/$key->HinhAnh")}}' alt="IMG">
                                             </a>

                                             <div class="size-w-11">
                                             <h6 class="p-b-4">
                                                  <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                       {{ Illuminate\Support\Str::limit($key->TenBV, $limit = 77, $end = '...') }}
                                                  </a>
                                             </h6>

                                             </div>
                                        @endforeach
                                   </li>
                              </ul>
                         </div>

                         <!-- Tag -->
                         <div>
                              <div class="how2 how2-cl4 flex-s-c m-b-30">
                                   <h3 class="f1-m-2 cl3 tab01-title">
                                        Danh mục
                                   </h3>
                              </div>

                              <div class="flex-wr-s-s m-rl--5">
                                   @foreach($menuCategory as $key)
                                        <a href="{{ route('user.hienthi', ['id' => $key->IDDM]) }}"
                                             class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                             {{ $key->TenDanhMuc }}
                                        </a>
                                   @endforeach
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
@endsection