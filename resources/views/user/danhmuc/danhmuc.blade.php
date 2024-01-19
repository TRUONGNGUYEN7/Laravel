@extends('user.danhmuc.submenu')
@section('danhmuc')

<section class="bg0">
     <div class="container">
          <div class="row m-rl--1">
               @if(isset($FourPosts[0]))
               <div class="col-12 p-rl-1 p-b-2">
                    <div class="bg-img1 size-a-3 how1 pos-relative"
                         style="background-image: url({{ asset('hinhanh/'.$FourPosts[0]->HinhAnh) }});">
                         <a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

                         <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                              <a href="#"
                                   class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                   {{ $FourPosts[0]->TenChuDe }}
                              </a>

                              <h3 class="how1-child2 m-t-14 m-b-10">
                                   <a href="blog-detail-01.html" class="how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
                                        {{ $FourPosts[0]->TenBV }}
                                   </a>
                              </h3>

                              <span class="how1-child2">
                                   <span class="f1-s-4 cl11">
                                        {{ $FourPosts[0]->Mota }}
                                   </span>

                                   <span class="f1-s-3 cl11 m-rl-3">
                                        -
                                   </span>

                                   <span class="f1-s-3 cl11">
                                        Feb 16
                                   </span>
                              </span>
                         </div>
                    </div>
               </div>
               @endif

               @foreach($FourPosts->slice(1) as $post)
               <div class="col-sm-6 col-md-3 p-rl-1 p-b-2">
                    <div class="bg-img1 size-a-14 how1 pos-relative"
                         style="background-image: url({{ asset('hinhanh/'.$post->HinhAnh) }});">
                         <a href="blog-detail-01.html" class="dis-block how1-child1 trans-03"></a>

                         <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                              <a href="#"
                                   class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                   {{ $post->TenBV }}
                              </a>

                              <h3 class="how1-child2 m-t-14">
                                   <a href="blog-detail-01.html" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03">
                                        {{ $post->Mota }}
                                   </a>
                              </h3>
                         </div>
                    </div>
               </div>
               @endforeach
          </div>
     </div>
</section>


<!-- Post -->
<section class="bg0 p-t-110 p-b-25">
     <div class="container">
          <div class="row justify-content-center">
               <div class="col-md-10 col-lg-8 p-b-80">
                    <div class="row">
                         <div class="col-sm-6 p-r-25 p-r-15-sr991">
                              <!-- Item -->
                              <div class="p-b-53">
                                   <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                        <img src="images/entertaiment-06.jpg" alt="IMG">
                                   </a>

                                   <div class="flex-col-s-c p-t-16">
                                        <h5 class="p-b-5 txt-center">
                                             <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                  You wish lorem ipsum dolor sit amet consectetur
                                             </a>
                                        </h5>

                                        <div class="cl8 txt-center p-b-17">
                                             <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                  Celebrity
                                             </a>

                                             <span class="f1-s-3 m-rl-3">
                                                  -
                                             </span>

                                             <span class="f1-s-3">
                                                  Feb 18
                                             </span>
                                        </div>

                                        <p class="f1-s-11 cl6 txt-center p-b-16">
                                             Curabitur volutpat bibendum molestie. Vestibulum ornare gravida semper.
                                             Aliquam a dui suscipit, fringilla metus id, maximus leo.
                                        </p>

                                        <a href="blog-detail-01.html" class="f1-s-1 cl9 hov-cl10 trans-03">
                                             Read More
                                             <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                        </a>
                                   </div>
                              </div>

                              <!-- Item -->
                              <div class="p-b-53">
                                   <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                        <img src="images/entertaiment-17.jpg" alt="IMG">
                                   </a>

                                   <div class="flex-col-s-c p-t-16">
                                        <h5 class="p-b-5 txt-center">
                                             <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                  Curabitur lacinia nisl eget aliquet porttitor
                                             </a>
                                        </h5>

                                        <div class="cl8 txt-center p-b-17">
                                             <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                  Celebrity
                                             </a>

                                             <span class="f1-s-3 m-rl-3">
                                                  -
                                             </span>

                                             <span class="f1-s-3">
                                                  Feb 18
                                             </span>
                                        </div>

                                        <p class="f1-s-11 cl6 txt-center p-b-16">
                                             Curabitur volutpat bibendum molestie. Vestibulum ornare gravida semper.
                                             Aliquam a dui suscipit, fringilla metus id, maximus leo.
                                        </p>

                                        <a href="blog-detail-01.html" class="f1-s-1 cl9 hov-cl10 trans-03">
                                             Read More
                                             <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                        </a>
                                   </div>
                              </div>

                              <!-- Item -->
                              <div class="p-b-53">
                                   <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                        <img src="images/entertaiment-18.jpg" alt="IMG">
                                   </a>

                                   <div class="flex-col-s-c p-t-16">
                                        <h5 class="p-b-5 txt-center">
                                             <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                  Vestibulum euismod lorem sed porttitor bibendum
                                             </a>
                                        </h5>

                                        <div class="cl8 txt-center p-b-17">
                                             <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                  Celebrity
                                             </a>

                                             <span class="f1-s-3 m-rl-3">
                                                  -
                                             </span>

                                             <span class="f1-s-3">
                                                  Feb 18
                                             </span>
                                        </div>

                                        <p class="f1-s-11 cl6 txt-center p-b-16">
                                             Curabitur volutpat bibendum molestie. Vestibulum ornare gravida semper.
                                             Aliquam a dui suscipit, fringilla metus id, maximus leo.
                                        </p>

                                        <a href="blog-detail-01.html" class="f1-s-1 cl9 hov-cl10 trans-03">
                                             Read More
                                             <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                        </a>
                                   </div>
                              </div>
                         </div>

                         <div class="col-sm-6 p-r-25 p-r-15-sr991">
                              <!-- Item -->
                              <div class="p-b-53">
                                   <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                        <img src="images/entertaiment-19.jpg" alt="IMG">
                                   </a>

                                   <div class="flex-col-s-c p-t-16">
                                        <h5 class="p-b-5 txt-center">
                                             <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                  Dolor sit amet consectetur adipiscing elit
                                             </a>
                                        </h5>

                                        <div class="cl8 txt-center p-b-17">
                                             <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                  Celebrity
                                             </a>

                                             <span class="f1-s-3 m-rl-3">
                                                  -
                                             </span>

                                             <span class="f1-s-3">
                                                  Feb 18
                                             </span>
                                        </div>

                                        <p class="f1-s-11 cl6 txt-center p-b-16">
                                             Curabitur volutpat bibendum molestie. Vestibulum ornare gravida semper.
                                             Aliquam a dui suscipit, fringilla metus id, maximus leo.
                                        </p>

                                        <a href="blog-detail-01.html" class="f1-s-1 cl9 hov-cl10 trans-03">
                                             Read More
                                             <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                        </a>
                                   </div>
                              </div>

                              <!-- Item -->
                              <div class="p-b-53">
                                   <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                        <img src="images/entertaiment-20.jpg" alt="IMG">
                                   </a>

                                   <div class="flex-col-s-c p-t-16">
                                        <h5 class="p-b-5 txt-center">
                                             <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                  Leo enim interdum nisl non mollis lacus est nec
                                             </a>
                                        </h5>

                                        <div class="cl8 txt-center p-b-17">
                                             <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                  Celebrity
                                             </a>

                                             <span class="f1-s-3 m-rl-3">
                                                  -
                                             </span>

                                             <span class="f1-s-3">
                                                  Feb 18
                                             </span>
                                        </div>

                                        <p class="f1-s-11 cl6 txt-center p-b-16">
                                             Curabitur volutpat bibendum molestie. Vestibulum ornare gravida semper.
                                             Aliquam a dui suscipit, fringilla metus id, maximus leo.
                                        </p>

                                        <a href="blog-detail-01.html" class="f1-s-1 cl9 hov-cl10 trans-03">
                                             Read More
                                             <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                        </a>
                                   </div>
                              </div>

                              <!-- Item -->
                              <div class="p-b-53">
                                   <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                        <img src="images/entertaiment-21.jpg" alt="IMG">
                                   </a>

                                   <div class="flex-col-s-c p-t-16">
                                        <h5 class="p-b-5 txt-center">
                                             <a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                  Vestibulum justo nunc pulvinar nec mi eget
                                             </a>
                                        </h5>

                                        <div class="cl8 txt-center p-b-17">
                                             <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                  Celebrity
                                             </a>

                                             <span class="f1-s-3 m-rl-3">
                                                  -
                                             </span>

                                             <span class="f1-s-3">
                                                  Feb 18
                                             </span>
                                        </div>

                                        <p class="f1-s-11 cl6 txt-center p-b-16">
                                             Curabitur volutpat bibendum molestie. Vestibulum ornare gravida semper.
                                             Aliquam a dui suscipit, fringilla metus id, maximus leo.
                                        </p>

                                        <a href="blog-detail-01.html" class="f1-s-1 cl9 hov-cl10 trans-03">
                                             Read More
                                             <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                        </a>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <!-- Pagination -->
                    <div class="flex-wr-c-c m-rl--7 p-t-28">
                         <a href="#" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 pagi-active">1</a>
                         <a href="#" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7">2</a>
                    </div>
               </div>

          </div>
     </div>
</section>
@endsection