<!DOCTYPE html>
<html lang="eS">

<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>@yield('title') - {{ config('app.name', 'LotoGam') }}</title>
  <!--favicon-->
  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
  <link href="{{ asset('css/theme.css') }}" rel="stylesheet"/>

</head>

<body>

<!-- Start wrapper-->
 <div id="wrapper">

	   <div class="card-authentication2 mx-auto my-5">
	    <div class="card-group">
	    	<div class="card mb-0">
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

  <script src="{{ asset('js/theme.js') }}"></script>
</body>

</html>
