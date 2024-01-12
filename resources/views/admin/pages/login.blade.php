<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
	<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Login :: w3layouts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- bootstrap-css -->
	<link rel="stylesheet" href="{{asset('assetadmin/css/bootstrap.min.css')}}">
	<!-- //bootstrap-css -->
	<!-- Custom CSS -->
	<link href="{{asset('assetadmin/css/style.css')}}" rel='stylesheet' type='text/css' />
	<link href="{{asset('assetadmin/css/style-responsive.css')}}" rel="stylesheet" />
	<!-- font CSS -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<!-- font-awesome icons -->
	<link rel="stylesheet" href="{{asset('assetadmin/css/font.css')}}" type="text/css" />
	<link href="{{asset('assetadmin/css/font-awesome.css')}}" rel="stylesheet">
	<!-- //font-awesome icons -->
	<script src="{{asset('assetadmin/js/jquery2.0.3.min.js')}}"></script>
</head>
<style>
    /* Thêm transition cho hiệu ứng */
    @keyframes gloww {
        0% {
            box-shadow: 0 0 10px rgba(0, 100, 0, 0.3);
        }

        50% {
            box-shadow: 0 0 20px 10px rgba(0, 100, 0, 0.5);
        }

        100% {
            box-shadow: 0 0 10px rgba(0, 100, 0, 0.3);
        }
    }

    .alertsuccess {
        position: absolute;
        padding: 20px;
        background-color: #98FB98;
        color: black;
        margin-left: 50%;
        transform: translateX(-50%);
        top: 20px;
        width: auto;
        height: 53px;
        line-height: 13px;
        text-align: center;
        border-radius: 10px;
        animation: gloww 1s ease-in-out;
        /* Add animation property here */
        display: {{ session('message') ? 'block' : 'none' }};
    }
</style>

<script>
        // Wait for the DOM to be fully loaded
        document.addEventListener("DOMContentLoaded", function () {
            // Set a timeout to hide the message after 2000 milliseconds (2 seconds)
            setTimeout(function () {
                var flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.style.display = 'none';
                }
            }, 2000);
        });
    </script>
<body>
	<div id="flash-message" class="alertsuccess">
        {{ session('message') }}
    </div>
	<div style=" margin-top: 200px " class="log-w3">
		<div class="w3layouts-main">
			<h2>Sign In Now</h2>
			<div style="width: 1100px;">
			<!-- <?php
				$message = Session::get('message');
				if ($message) {
					echo '<span class="warning_mes">' . $message . '</span>';
					Session::put('message', null);
				}
			?> -->
			</div>
	
			<form action="{{ URL::to('admin/loginaction') }}" method="post" id="loginForm">
				{{ csrf_field() }}
				<input type="text" class="ggg" name="adminname" placeholder="E-MAIL" >
				@error('adminname')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror

				<input type="password" class="ggg" name="adminpass" placeholder="PASSWORD" >
				@error('adminpass')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror

				<span><input type="checkbox" id="rememberMe">Remember Me</span>
				<h6><a href="#">Forgot Password?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="login">
			</form>

			<p>Don't Have an Account ?<a href="registration.html">Create an account</a></p>
		</div>
	</div>
	<script src="{{asset('assetadmin/js/bootstrap.js')}}"></script>
	<script src="{{asset('assetadmin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
	<script src="{{asset('assetadmin/js/scripts.js')}}"></script>
	<script src="{{asset('assetadmin/js/jquery.slimscroll.js')}}"></script>
	<script src="{{asset('assetadmin/js/jquery.nicescroll.js')}}"></script>
	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
	<script src="{{asset('assetadmin/js/jquery.scrollTo.js')}}"></script>
</body>

</html>