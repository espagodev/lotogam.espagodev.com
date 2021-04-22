<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/bulona/demo/authentication-signin2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Feb 2020 14:47:54 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Bulona - Bootstrap Admin Dashboard Template</title>
  <!--favicon-->
  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>

</head>

<body>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

	   <div class="card-authentication2 mx-auto my-5">
	    <div class="card-group">
	    	<div class="card mb-0">
	    	   <div class="bg-signin2"></div>
	    		<div class="card-img-overlay rounded-left my-5">
                 <h2 class="text-white"></h2>
                 <h1 class="text-white"></h1>
                 <p class="card-text text-white pt-3"></p>
             </div>
	    	</div>

	    	<div class="card mb-0 ">
	    		<div class="card-body">
	    			<div class="card-content p-3">
	    				<div class="text-center">
					 		<img src="{{ asset('assets/images/logo-icon.png') }}" alt="logo icon">
					 	</div>
                     <div class="card-title text-uppercase text-center py-3">Ingresar</div>
                       @yield('content')
                    </div>
				</div>
	    	</div>
	     </div>
	    </div>

     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->



	</div><!--wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

  <!-- sidebar-menu js -->
  <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

  <!-- Custom scripts -->
  <script src="{{ asset('assets/js/app-script.js') }}"></script>

</body>

<!-- Mirrored from codervent.com/bulona/demo/authentication-signin2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Feb 2020 14:47:54 GMT -->
</html>
