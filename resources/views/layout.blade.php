<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" type="image/png" href="{{ asset('UserAssets/images/icons/favicon.png') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('UserAssets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('UserAssets/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('UserAssets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('UserAssets/vendor/animate/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('UserAssets/vendor/css-hamburgers/hamburgers.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('UserAssets/vendor/animsition/css/animsition.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('UserAssets/css/util.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('UserAssets/css/main.css') }}">

	<!-- </head><body class="animsition"> -->
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div style="background-color: #daecff;" class="container-menu-desktop">
			<div class="topbar">
				<div class="content-topbar container h-100">
					<div class="left-topbar">

						<a href="https://localhost/Laravel/public" class="left-topbar-item">
							Home
						</a>

						<a href="#" class="left-topbar-item">
							Contact
						</a>

						<a href="#" class="left-topbar-item">
							Sing up
						</a>

						<a href="#" class="left-topbar-item">
							Log in
						</a>
					</div>

					<div class="right-topbar">
						<a href="#">
							<span class="fab fa-facebook-f"></span>
						</a>

						<a href="#">
							<span class="fab fa-twitter"></span>
						</a>

						<a href="#">
							<span class="fab fa-pinterest-p"></span>
						</a>

						<a href="#">
							<span class="fab fa-vimeo-v"></span>
						</a>

						<a href="#">
							<span class="fab fa-youtube"></span>
						</a>
					</div>
				</div>
			</div>

			<!-- Header Mobile -->
			<div class="wrap-header-mobile">
				<!-- Logo moblie -->		
				<div class="logo-mobile">
					<a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
				</div>

				<!-- Button show menu -->
				<div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>

			<!-- Menu Mobile -->
			<div class="menu-mobile">
				<ul class="topbar-mobile">
					<li class="left-topbar">
						<span class="left-topbar-item flex-wr-s-c">
							<span>
								New York, NY
							</span>

							<img class="m-b-1 m-rl-8" src="images/icons/icon-night.png" alt="IMG">

							<span>
								HI 58° LO 56°
							</span>
						</span>
					</li>

					<li class="left-topbar">
						<a href="#" class="left-topbar-item">
							About
						</a>

						<a href="#" class="left-topbar-item">
							Contact
						</a>

						<a href="#" class="left-topbar-item">
							Sing up
						</a>

						<a href="#" class="left-topbar-item">
							Log in
						</a>
					</li>

					<li class="right-topbar">
						<a href="#">
							<span class="fab fa-facebook-f"></span>
						</a>

						<a href="#">
							<span class="fab fa-twitter"></span>
						</a>

						<a href="#">
							<span class="fab fa-pinterest-p"></span>
						</a>

						<a href="#">
							<span class="fab fa-vimeo-v"></span>
						</a>

						<a href="#">
							<span class="fab fa-youtube"></span>
						</a>
					</li>
				</ul>

				<ul class="main-menu-m">
					<li>
						<a href="index.html">Homee</a>
						<ul class="sub-menu-m">
							<li><a href="index.html">Homepage v11</a></li>
							<li><a href="home-02.html">Homepage v2</a></li>
							<li><a href="home-03.html">Homepage v3</a></li>
						</ul>

						<span class="arrow-main-menu-m">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</span>
					</li>

					<li>
						<a href="category-01.html">News</a>
					</li>

					<li>
						<a href="category-02.html">Entertainment </a>
					</li>

					<li>
						<a href="category-01.html">Business</a>
					</li>

					<li>
						<a href="category-02.html">Travel</a>
					</li>

					<li>
						<a href="category-01.html">Life Style</a>
					</li>

					<li>
						<a href="category-02.html">Video</a>
					</li>

					<li>
						<a href="#">Features</a>
						<ul class="sub-menu-m">
							<li><a href="category-01.html">Category Page v1</a></li>
							<li><a href="category-02.html">Category Page v2</a></li>
							<li><a href="blog-grid.html">Blog Grid Sidebar</a></li>
							<li><a href="blog-list-01.html">Blog List Sidebar v1</a></li>
							<li><a href="blog-list-02.html">Blog List Sidebar v2</a></li>
							<li><a href="blog-detail-01.html">Blog Detail Sidebar</a></li>
							<li><a href="blog-detail-02.html">Blog Detail No Sidebar</a></li>
							<li><a href="about.html">About Us</a></li>
							<li><a href="contact.html">Contact Us</a></li>
						</ul>

						<span class="arrow-main-menu-m">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
						</span>
					</li>
				</ul>
			</div>

			<!--  -->
			<div class="wrap-main-nav">
				<div class="main-nav">
					<!-- Menu desktop -->
					<nav class="menu-desktop">
						<ul class="main-menu">
							@foreach($menuCategory as $category)
								<li>
								<a href="{{URL::to('user/danhmuc/danhmuc/'.$category -> IDDM)}}">{{ $category->TenDanhMuc }}</a>								
								@if($category->chudes->isNotEmpty())
									<ul class="sub-menu">
										@foreach($category->chudes as $chude)
											<li><a href="{{URL::to('admin/baiviet/sua/'.$chude -> IDCD)}}">{{ $chude->TenChuDe }}</a></li>
										@endforeach
									</ul>
								@endif
								</li>
							@endforeach

						</ul>
					</nav>
				</div>
			</div>	
		</div>
	</header>
	@yield('contentuser')
	@include('user.page.footer')
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fas fa-angle-up"></span>
		</span>
	</div>

	<!-- Modal Video 01-->
	<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document" data-dismiss="modal">
			<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

			<div class="wrap-video-mo-01">
				<div class="video-mo-01">
					<iframe src="https://www.youtube.com/embed/wJnBTPUQS5A?rel=0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
<!--===============================================================================================-->	
<script src="{{ asset('UserAssets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('UserAssets/vendor/animsition/js/animsition.min.js') }}"></script>
<script src="{{ asset('UserAssets/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('UserAssets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('UserAssets/js/main.js') }}"></script>

</body>
</html>