@extends('layout')
@section('contentuser')
<style>
.csstieude12 {
     background-color: #000000bd;
     color: #fff;
     padding: 10px;
     border-radius: 5px;
     text-decoration: none;
     display: table;
     font-size: 20px;
}

.csstieude12:hover {
     background-color: black;
}

.csstieude34 {
     background-color: #00000094;
     color: #fff;
     padding: 10px;
     border-radius: 5px;
     text-decoration: none;
     display: block;

     overflow: hidden;
     white-space: nowrap;
     text-overflow: ellipsis;
     max-width: 230px;
}

.csstieude34:hover {
     background-color: black;
}
</style>

<!-- Feature post -->
<section style="margin-top: 20px" class="bg0">
     <div class="container">
          <div class="row m-rl--1">

               <div class="col-md-6 p-rl-1 p-b-2">
                    @if(isset($FourPosts[0]))
                    <div class="bg-img1 size-a-3 how1 pos-relative"
                         style="background-image: url({{ asset('hinhanh/'.$FourPosts[0]->HinhAnh) }});">
                         <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[0]->IDBV]) }}"
                              class="dis-block how1-child1 trans-03"></a>

                         <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                              <a href="#" style="box-shadow: inset;"
                                   class=" dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                   {{ $FourPosts[0]->TenChuDe }}
                              </a>

                              <h3 class="how1-child2 m-t-14 m-b-10">
                                   <a href="#"
                                        class="csstieude12 how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
                                        {{ $FourPosts[0]->TenBV }}
                                   </a>
                              </h3>
                         </div>
                    </div>
                    @endif
               </div>



               <div class="col-md-6 p-rl-1">
                    <div class="row m-rl--1">
                         <div class="col-12 p-rl-1 p-b-2">
                              <div class="bg-img1 size-a-4 how1 pos-relative"
                                   style="background-image: url({{ asset('hinhanh/'.$FourPosts[1]->HinhAnh) }});">
                                   <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[1]->IDBV]) }}" class="dis-block how1-child1 trans-03"></a>

                                   <div class="flex-col-e-s s-full p-rl-25 p-tb-24">
                                        <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[1]->IDBV]) }}"
                                             class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                             {{ $FourPosts[1]->TenChuDe }}
                                        </a>

                                        <h3 class="how1-child2 m-t-14">
                                             <a href=""
                                                  class="how-txt1 size-a-7 f1-l-2 cl0 hov-cl10 trans-03 csstieude12">
                                                  {{ $FourPosts[1]->TenBV }}
                                             </a>
                                        </h3>
                                   </div>
                              </div>
                         </div>

					@if(isset($FourPosts[2]))
                         <div class="col-sm-6 p-rl-1 p-b-2">
                              <div class="bg-img1 size-a-5 how1 pos-relative"
                                   style="background-image: url({{ asset('hinhanh/'.$FourPosts[2]->HinhAnh) }});">
                                   <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[2]->IDBV]) }}" class="dis-block how1-child1 trans-03"></a>
                                   <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                                        <a href=""
                                             class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                             {{ $FourPosts->isEmpty() ? 'No Category' : $FourPosts[2]->TenChuDe }}
                                        </a>
                                        <h3 class="how1-child2 m-t-14">
                                             <a href=""
                                                  class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03 csstieude34">
                                                  {{ $FourPosts->isEmpty() ? 'No Title' : $FourPosts[2]->TenBV }}
                                             </a>
                                        </h3>
                                   </div>
                              </div>
                         </div>
					@endif

					@if(isset($FourPosts[3]))
                         <div class="col-sm-6 p-rl-1 p-b-2">
                              <div class="bg-img1 size-a-5 how1 pos-relative"
                                   style="background-image: url({{ asset('hinhanh/'.$FourPosts[3]->HinhAnh) }});">
                                   <a href="{{ route('user.baiviet.detail', ['id' => $FourPosts[3]->IDBV]) }}" class="dis-block how1-child1 trans-03"></a>
                                   <div class="flex-col-e-s s-full p-rl-25 p-tb-20">
                                        <a href="#"
                                             class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
                                             {{ $FourPosts->isEmpty() ? 'No Category' : $FourPosts[3]->TenChuDe }}
                                        </a>
                                        <h3 class="how1-child2 m-t-14">
                                             <a href=""
                                                  class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03 csstieude34">
                                                  {{ $FourPosts->isEmpty() ? 'No Title' : $FourPosts[3]->TenBV }}
                                             </a>
                                        </h3>
                                   </div>
                              </div>
                         </div>
					@endif

                    </div>
               </div>
          </div>
     </div>
</section>

<!-- Post -->
<section class="bg0 p-t-70">
     <div class="container">
          <div class="row justify-content-center">
               <div class="col-md-10 col-lg-8">
                    <div class="p-b-20">
                         <!-- Entertainment -->
                         @foreach($twoLatestCategoriesWithPosts as $category)
                         <div class="tab01 p-b-20">
                              <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                   <!-- Brand tab -->
                                   <h3 class="f1-m-2 cl12 tab01-title">
                                        <a href="#">{{ $category->TenDanhMuc }}</a>
                                   </h3>
                                   <!-- Nav tabs -->
                                   <ul class="nav nav-tabs" role="tablist">
                                        @if($category->chudes->isNotEmpty())
                                        @foreach($category->chudes as $key => $chude)
                                        <li class="nav-item">
                                             <a class="nav-link {{ $key == 0 ? 'active' : '' }}"
                                                  href="{{ route('user.hienthi', ['id' => $chude->IDCD, 'iddm' => $chude->DanhMucID]) }}">{{ $chude->TenChuDe }}</a>
                                        </li>
                                        @endforeach
                                        @endif
                                   </ul>
                                   <a href="#"
                                        class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
                                        View all
                                        <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                   </a>
                              </div>
                              <!-- Tab panes -->
                              <div class="tab-content p-t-35">
                                   @if($category->chudes->isNotEmpty())
                                   @foreach($category->chudes as $key => $chude)
                                   <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }}"
                                        id="tab{{ $category->IDDM }}-{{ $chude->IDChuDe }}" role="tabpanel">
                                        <div class="row">
                                             @forelse($chude->baiviets->take(4) as $baiviet)
                                             <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                                  <!-- Item post -->
                                                  <div class="m-b-30">
                                                       <a href="{{ route('user.baiviet.detail', ['id' => $baiviet->IDBV]) }}" class="wrap-pic-w hov1 trans-03">
                                                            <img src='{{ asset("hinhanh/$baiviet->HinhAnh") }}'
                                                                 alt="IMG">
                                                       </a>

                                                       <div class="p-t-20">
                                                            <h5 class="p-b-5">
                                                                 <a href="blog-detail-01.html"
                                                                      class="f1-m-3 cl2 hov-cl10 trans-03">
                                                                      {{ $baiviet->TenBV }}
                                                                 </a>
                                                            </h5>
                                                       </div>
                                                  </div>
                                             </div>
                                             @empty
                                             <!-- Handle case where there are no posts -->
                                             @endforelse
                                        </div>
                                   </div>
                                   @endforeach
                                   @endif
                              </div>
                         </div>
                         @endforeach
                    </div>
               </div>

               <div class="col-md-10 col-lg-4">
                    <div class="p-l-10 p-rl-0-sr991 p-b-20">
                         <!--  -->
                         <div>
                              <div class="how2 how2-cl4 flex-s-c">
                                   <h3 class="f1-m-2 cl3 tab01-title">
                                        Most Popular
                                   </h3>
                              </div>

                              <ul class="p-t-35">
                                   <li class="flex-wr-sb-s p-b-22">
                                        <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                             1
                                        </div>

                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                             Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                        </a>
                                   </li>

                                   <li class="flex-wr-sb-s p-b-22">
                                        <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                             2
                                        </div>

                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                             Proin velit consectetur non neque
                                        </a>
                                   </li>

                                   <li class="flex-wr-sb-s p-b-22">
                                        <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                             3
                                        </div>

                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                             Nunc vestibulum, enim vitae condimentum volutpat lobortis ante
                                        </a>
                                   </li>

                                   <li class="flex-wr-sb-s p-b-22">
                                        <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0 m-b-6">
                                             4
                                        </div>

                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                             Proin velit justo consectetur non neque elementum
                                        </a>
                                   </li>

                                   <li class="flex-wr-sb-s p-b-22">
                                        <div class="size-a-8 flex-c-c borad-3 size-a-8 bg9 f1-m-4 cl0">
                                             5
                                        </div>

                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                             Proin velit consectetur non neque
                                        </a>
                                   </li>
                              </ul>
                         </div>

                    </div>
               </div>
          </div>
     </div>
</section>

<!-- Latest -->
<section class="bg0 p-t-60 p-b-35">
     <div class="container">
          <div class="row justify-content-center">
               <div class="col-md-10 col-lg-8 p-b-20">
                    <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
                         <h3 class="f1-m-2 cl3 tab01-title">
                              Tin mới cập nhật
                         </h3>
                    </div>

                    <div class="row p-t-35">
                         <div class="col-sm-6 p-r-25 p-r-15-sr991">
                              <!-- Item latest -->
						@foreach($SixPostsNewUpdate->take(3) as $post)
							<!-- Item latest -->	
							<div class="m-b-45">
								<a href="{{ route('user.baiviet.detail', ['id' => $post->IDBV]) }}" class="wrap-pic-w hov1 trans-03">
									<img src="{{ asset('hinhanh/'.$post->HinhAnh) }}" alt="IMG">
								</a>

								<div class="p-t-16">
									<h5 class="p-b-5">
										<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
										{{ $post->TenBV }} 
										</a>
									</h5>

									<span class="cl8">
										<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
											by John Alvarado
										</a>

										<span class="f1-s-3 m-rl-3">
											-
										</span>

										<span class="f1-s-3">
                                                  {{ $post->ThoiGianBV }} 
										</span>
									</span>
								</div>
							</div>
						@endforeach
                         </div>

                         <div class="col-sm-6 p-r-25 p-r-15-sr991">
                              <!-- Item latest -->
						@foreach($SixPostsNewUpdate->slice(3) as $post)
							<div class="m-b-45">
								<a href="{{ route('user.baiviet.detail', ['id' => $post->IDBV]) }}" class="wrap-pic-w hov1 trans-03">
									<img src="{{ asset('hinhanh/'.$post->HinhAnh) }}" alt="IMG">
								</a>

								<div class="p-t-16">
									<h5 class="p-b-5">
										<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
											1You wish lorem ipsum dolor sit amet consectetur
										</a>
									</h5>

									<span class="cl8">
										<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
											by John Alvarado
										</a>

										<span class="f1-s-3 m-rl-3">
											-
										</span>

										<span class="f1-s-3">
											Feb 15
										</span>
									</span>
								</div>
							</div>
						@endforeach
                         </div>

                    </div>
               </div>

               <div class="col-md-10 col-lg-4">
                    <div class="p-l-10 p-rl-0-sr991 p-b-20">
                         <!-- Video -->
                         <div class="p-b-55">
                              <div class="how2 how2-cl4 flex-s-c m-b-35">
                                   <h3 class="f1-m-2 cl3 tab01-title">
                                        Featured Video
                                   </h3>
                              </div>

                              <div>
                                   <div class="wrap-pic-w pos-relative">
                                        <img src="images/video-01.jpg" alt="IMG">

                                        <button class="s-full ab-t-l flex-c-c fs-32 cl0 hov-cl10 trans-03"
                                             data-toggle="modal" data-target="#modal-video-01">
                                             <span class="fab fa-youtube"></span>
                                        </button>
                                   </div>

                                   <div class="p-tb-16 p-rl-25 bg3">
                                        <h5 class="p-b-5">
                                             <a href="#" class="f1-m-3 cl0 hov-cl10 trans-03">
                                                  Music lorem ipsum dolor sit amet consectetur
                                             </a>
                                        </h5>

                                        <span class="cl15">
                                             <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                  by John Alvarado
                                             </a>

                                             <span class="f1-s-3 m-rl-3">
                                                  -
                                             </span>

                                             <span class="f1-s-3">
                                                  Feb 18
                                             </span>
                                        </span>
                                   </div>
                              </div>
                         </div>

                         <!-- Subscribe -->
                         <div class="bg10 p-rl-35 p-t-28 p-b-35 m-b-55">
                              <h5 class="f1-m-5 cl0 p-b-10">
                                   Subscribe
                              </h5>

                              <p class="f1-s-1 cl0 p-b-25">
                                   Get all latest content delivered to your email a few times a month.
                              </p>

                              <form class="size-a-9 pos-relative">
                                   <input class="s-full f1-m-6 cl6 plh9 p-l-20 p-r-55" type="text" name="email"
                                        placeholder="Email">

                                   <button class="size-a-10 flex-c-c ab-t-r fs-16 cl9 hov-cl10 trans-03">
                                        <i class="fa fa-arrow-right"></i>
                                   </button>
                              </form>
                         </div>

                         <!-- Tag -->
                         <div class="p-b-55">
                              <div class="how2 how2-cl4 flex-s-c m-b-30">
                                   <h3 class="f1-m-2 cl3 tab01-title">
                                        Tags
                                   </h3>
                              </div>

                              <div class="flex-wr-s-s m-rl--5">
                                   <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Fashion
                                   </a>

                                   <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Lifestyle
                                   </a>

                                   <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Denim
                                   </a>

                                   <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Streetstyle
                                   </a>

                                   <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Crafts
                                   </a>

                                   <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Magazine
                                   </a>

                                   <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        News
                                   </a>

                                   <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Blogs
                                   </a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>

@endsection