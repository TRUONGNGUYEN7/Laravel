<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
     <title>Đăng Ký</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <meta name="keywords" content="SignUp" />
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
     <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>
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
     display: {
               {
               session('message') ? 'block': 'none'
          }
     }

     ;
}
</style>

<script>
// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function() {
     // Set a timeout to hide the message after 2000 milliseconds (2 seconds)
     setTimeout(function() {
          var flashMessage = document.getElementById('flash-message');
          if (flashMessage) {
               flashMessage.style.display = 'none';
          }
     }, 2000);
});
</script>

<body style="background: #b0b5bbb2;">
     <div id="flash-message" class="alertsuccess" style="display: {{ session('message') ? 'block' : 'none' }}">
          {{ session('message') ?? '' }}
     </div>

     <div style=" margin-top: 200px ; margin-bottom: 400px" class="log-w3">
          <div style="background: rgba(35, 93, 183, 0.82);" class="w3layouts-main">
               <h2 style="color: white">Sign Up Now</h2>

               <form action="{{ route('user.signup_action') }}" method="POST" id="loginForm">
                    {{ csrf_field() }}

                    <input type="text" class="ggg" name="TenUS" id="TenUS" placeholder="Nhập tên đăng nhập" value="{{ old('TenUS') }}">
                    @error('TenUS')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="password" class="ggg" name="MatKhauUS" id="MatKhauUS" placeholder="Nhập mật khẩu">
                    @error('MatKhauUS')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <input type="email" class="ggg" name="EmailUS" id="EmailUS" placeholder="Nhập địa chỉ email" value="{{ old('EmailUS') }}">
                    @error('EmailUS')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <span><input type="checkbox" id="rememberMe" {{ old('rememberMe') ? 'checked' : '' }}> Remember
                         Me</span>
                    <h6><a href="#">Forgot Password?</a></h6>
                    <div class="clearfix"></div>
                    <input style="background: rgba(35, 37, 183, 0.82);" type="submit" value="Sign Up" name="login">
               </form>
               <p>You have an Account ?<a href="{{ route('user.signin') }}">Login now</a></p>

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