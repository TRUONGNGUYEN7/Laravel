@extends('layout')
@section('contentuser')
	<style>
		.csstieude12 {
			background-color: #000000de; 
			color: #fff; 
			padding: 10px;
			border-radius: 5px; 
			text-decoration: none;
			display: table;
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
	<section class="bg0">
		<div class="container">
			<div class="row m-rl--1">
				@foreach($maxViewPosts as $post)
					<div class="col-md-6 p-rl-1 p-b-2">
						<div class="bg-img1 size-a-3 how1 pos-relative" style="background-image: url({{ asset("hinhanh/$post->HinhAnh") }});">
							<a href="{{URL::to('admin/baiviet/sua/'.$post -> IDBV)}}" class="dis-block how1-child1 trans-03"></a>

							<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
								<a href="#" style="box-shadow: inset;" class=" dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
									{{ $post->TenChuDe }}
								</a>

								<h3 class="how1-child2 m-t-14 m-b-10">
									<a href="{{URL::to('admin/baiviet/sua/'.$post -> IDBV)}}" class=" csstieude12 how-txt1 size-a-6 f1-l-1 cl0 hov-cl10 trans-03">
										{{ $post->TenBV }}
									</a>
								</h3>
							</div>
						</div>
					</div>
				@endforeach

				<div class="col-md-6 p-rl-1">
					<div class="row m-rl--1">
						<div class="col-12 p-rl-1 p-b-2">
							<!-- Assuming this is inside your Blade view file -->
							@foreach($SecondPost as $post)
								<div class="bg-img1 size-a-4 how1 pos-relative" style="background-image: url({{ asset("hinhanh/$post->HinhAnh") }});">
									<a href="" class="dis-block how1-child1 trans-03"></a>

									<div class="flex-col-e-s s-full p-rl-25 p-tb-24">
										<a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
											{{ $post->TenChuDe }}
										</a>

										<h3 class="how1-child2 m-t-14">
											<a href="" class="how-txt1 size-a-7 f1-l-2 cl0 hov-cl10 trans-03 csstieude12">
												{{ $post->TenBV }}
											</a>
										</h3>
									</div>
								</div>
						   @endforeach
						</div>
						
						@foreach($ThirdPost as $post)
							<div class="col-sm-6 p-rl-1 p-b-2">
								<div class="bg-img1 size-a-5 how1 pos-relative" style="background-image: url({{ asset("hinhanh/$post->HinhAnh") }});">
									<a href="" class="dis-block how1-child1 trans-03"></a>
									<div class="flex-col-e-s s-full p-rl-25 p-tb-20">
										<a href="#" class="dis-block how1-child2 f1-s-2 cl0 bo-all-1 bocl0 hov-btn1 trans-03 p-rl-5 p-t-2">
										{{ $ThirdPost->isEmpty() ? 'No Category' : $post->TenChuDe }}
										</a>
										<h3 class="how1-child2 m-t-14">
											<a href="" class="how-txt1 size-h-1 f1-m-1 cl0 hov-cl10 trans-03 csstieude34">
											{{ $ThirdPost->isEmpty() ? 'No Title' : $post->TenBV }}
											</a>
										</h3>
									</div>						
								</div>
							</div>
					
						@endforeach
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
						@foreach($fourCategoryContent as $category)
						<div class="tab01 p-b-20">
							<div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
								<!-- Brand tab -->
								<h3 class="f1-m-2 cl12 tab01-title">
								<a href="{{URL::to('user/danhmuc/danhmuc/'.$category -> IDDM)}}">{{ $category->TenDanhMuc }}</a>
								</h3>

								<!-- Nav tabs -->			
									<ul class="nav nav-tabs" role="tablist">
									@if($category->chudes->isNotEmpty())
										@foreach($category->chudes as $chude)
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#tab1-1" role="tab">{{ $chude->TenChuDe }}</a>
										</li>
										@endforeach
									@endif
									</ul>
							
								<a href="category-01.html" class="tab01-link f1-s-1 cl9 hov-cl10 trans-03">
									View all
									<i class="fs-12 m-l-5 fa fa-caret-right"></i>
								</a>
							</div>
								
							<!-- Tab panes -->
							<div class="tab-content p-t-35">
								<!-- - -->
								<div class="tab-pane fade show active" id="tab1-1" role="tabpanel">
									<div class="row">
										<div class="col-sm-6 p-r-25 p-r-15-sr991">
											<!-- Item post -->	
											<div class="m-b-30">
												<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
													<img src="hinhanh/banner1.jpg" alt="IMG">
												</a>

												<div class="p-t-20">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
															American live music lorem ipsum dolor sit amet consectetur 
														</a>
													</h5>
													
												</div>
											</div>
										</div>

										<div class="col-sm-6 p-r-25 p-r-15-sr991">
											<!-- Item post -->	
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="hinhanh/banner1.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

												</div>
											</div>
											
											<!-- Item post -->
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-07.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

												</div>
											</div>

											<!-- Item post -->
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-08.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- - -->
								<div class="tab-pane fade" id="tab1-2" role="tabpanel">
									<div class="row">
										<div class="col-sm-6 p-r-25 p-r-15-sr991">
											<!-- Item post -->	
											<div class="m-b-30">
												<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
													<img src="images/post-09.jpg" alt="IMG">
												</a>

												<div class="p-t-20">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
															American live music lorem ipsum dolor sit amet consectetur 
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
															Music
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

										<div class="col-sm-6 p-r-25 p-r-15-sr991">
											<!-- Item post -->
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-08.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Celebrity
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 12
														</span>
													</span>
												</div>
											</div>

											<!-- Item post -->	
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-06.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Music
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 17
														</span>
													</span>
												</div>
											</div>
											
											<!-- Item post -->
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-07.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Game
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 16
														</span>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- - -->
								<div class="tab-pane fade" id="tab1-3" role="tabpanel">
									<div class="row">
										<div class="col-sm-6 p-r-25 p-r-15-sr991">
											<!-- Item post -->	
											<div class="m-b-30">
												<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
													<img src="images/post-08.jpg" alt="IMG">
												</a>

												<div class="p-t-20">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
															American live music lorem ipsum dolor sit amet consectetur 
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
															Music
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

										<div class="col-sm-6 p-r-25 p-r-15-sr991">
											<!-- Item post -->
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-07.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Celebrity
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 12
														</span>
													</span>
												</div>
											</div>

											<!-- Item post -->	
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-06.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Music
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 17
														</span>
													</span>
												</div>
											</div>
											
											<!-- Item post -->
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-05.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Game
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 16
														</span>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- - -->
								<div class="tab-pane fade" id="tab1-4" role="tabpanel">
									<div class="row">
										<div class="col-sm-6 p-r-25 p-r-15-sr991">
											<!-- Item post -->	
											<div class="m-b-30">
												<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
													<img src="images/post-06.jpg" alt="IMG">
												</a>

												<div class="p-t-20">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
															American live music lorem ipsum dolor sit amet consectetur 
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
															Music
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

										<div class="col-sm-6 p-r-25 p-r-15-sr991">
											<!-- Item post -->
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-09.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Celebrity
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 12
														</span>
													</span>
												</div>
											</div>

											<!-- Item post -->	
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-07.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Music
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 17
														</span>
													</span>
												</div>
											</div>
											
											<!-- Item post -->
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-08.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Game
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 16
														</span>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- - -->
								<div class="tab-pane fade" id="tab1-5" role="tabpanel">
									<div class="row">
										<div class="col-sm-6 p-r-25 p-r-15-sr991">
											<!-- Item post -->	
											<div class="m-b-30">
												<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
													<img src="images/post-07.jpg" alt="IMG">
												</a>

												<div class="p-t-20">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
															American live music lorem ipsum dolor sit amet consectetur 
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
															Music
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

										<div class="col-sm-6 p-r-25 p-r-15-sr991">
											<!-- Item post -->
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-08.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Celebrity
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 12
														</span>
													</span>
												</div>
											</div>

											<!-- Item post -->	
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-06.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Music
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 17
														</span>
													</span>
												</div>
											</div>
											
											<!-- Item post -->
											<div class="flex-wr-sb-s m-b-30">
												<a href="blog-detail-01.html" class="size-w-1 wrap-pic-w hov1 trans-03">
													<img src="images/post-09.jpg" alt="IMG">
												</a>

												<div class="size-w-2">
													<h5 class="p-b-5">
														<a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
															Donec metus orci, malesuada et lectus vitae
														</a>
													</h5>

													<span class="cl8">
														<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
															Game
														</a>

														<span class="f1-s-3 m-rl-3">
															-
														</span>

														<span class="f1-s-3">
															Feb 16
														</span>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
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
							Latest Articles
						</h3>
					</div>

					<div class="row p-t-35">
						<div class="col-sm-6 p-r-25 p-r-15-sr991">
							<!-- Item latest -->	
							<div class="m-b-45">
								<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
									<img src="images/latest-01.jpg" alt="IMG">
								</a>

								<div class="p-t-16">
									<h5 class="p-b-5">
										<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
											You wish lorem ipsum dolor sit amet consectetur 
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
											Feb 18
										</span>
									</span>
								</div>
							</div>
						</div>

						<div class="col-sm-6 p-r-25 p-r-15-sr991">
							<!-- Item latest -->	
							<div class="m-b-45">
								<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
									<img src="images/latest-02.jpg" alt="IMG">
								</a>

								<div class="p-t-16">
									<h5 class="p-b-5">
										<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
											You wish lorem ipsum dolor sit amet consectetur 
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
											Feb 16
										</span>
									</span>
								</div>
							</div>
						</div>

						<div class="col-sm-6 p-r-25 p-r-15-sr991">
							<!-- Item latest -->	
							<div class="m-b-45">
								<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
									<img src="images/latest-03.jpg" alt="IMG">
								</a>

								<div class="p-t-16">
									<h5 class="p-b-5">
										<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
											You wish lorem ipsum dolor sit amet consectetur 
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
						</div>

						<div class="col-sm-6 p-r-25 p-r-15-sr991">
							<!-- Item latest -->	
							<div class="m-b-45">
								<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
									<img src="images/latest-04.jpg" alt="IMG">
								</a>

								<div class="p-t-16">
									<h5 class="p-b-5">
										<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
											You wish lorem ipsum dolor sit amet consectetur 
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
											Feb 13
										</span>
									</span>
								</div>
							</div>
						</div>

						<div class="col-sm-6 p-r-25 p-r-15-sr991">
							<!-- Item latest -->	
							<div class="m-b-45">
								<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
									<img src="images/latest-05.jpg" alt="IMG">
								</a>

								<div class="p-t-16">
									<h5 class="p-b-5">
										<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
											You wish lorem ipsum dolor sit amet consectetur 
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
											Feb 10
										</span>
									</span>
								</div>
							</div>
						</div>

						<div class="col-sm-6 p-r-25 p-r-15-sr991">
							<!-- Item latest -->	
							<div class="m-b-45">
								<a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
									<img src="images/latest-06.jpg" alt="IMG">
								</a>

								<div class="p-t-16">
									<h5 class="p-b-5">
										<a href="blog-detail-01.html" class="f1-m-3 cl2 hov-cl10 trans-03">
											You wish lorem ipsum dolor sit amet consectetur 
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
											Feb 09
										</span>
									</span>
								</div>
							</div>
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

									<button class="s-full ab-t-l flex-c-c fs-32 cl0 hov-cl10 trans-03" data-toggle="modal" data-target="#modal-video-01">
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
								<input class="s-full f1-m-6 cl6 plh9 p-l-20 p-r-55" type="text" name="email" placeholder="Email">

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
								<a href="#" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Fashion
								</a>

								<a href="#" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Lifestyle
								</a>

								<a href="#" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Denim
								</a>

								<a href="#" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Streetstyle
								</a>

								<a href="#" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Crafts
								</a>

								<a href="#" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									Magazine
								</a>

								<a href="#" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
									News
								</a>

								<a href="#" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
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
