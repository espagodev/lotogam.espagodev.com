  <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
   <!-- notifications css -->


    <!--Switchery-->
  <link href="{{ asset('assets/plugins/switchery/css/switchery.min.css?v=' . $asset_v) }}" rel="stylesheet" />

  <link href="{{ asset('assets/plugins/bootstrap-switch/bootstrap-switch.min.css?v=' . $asset_v) }}" rel="stylesheet">

  <!-- Bootstrap core CSS-->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{ asset('assets/css/sidebar-menu.css') }}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>
  <!-- skins CSS-->
  <link href="{{ asset('assets/css/skins.css') }}" rel="stylesheet"/>

   {{-- <link  href="{{ asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.less?v=' . $asset_v) }}" rel="stylesheet"/> --}}
   <link  href="{{ asset('assets/plugins/jquery-timepicker/jquery.timepicker.css?v=' . $asset_v) }}" rel="stylesheet"/>
    <!-- skins CSS-->
  <link href="{{ asset('css/loto.css') }}" rel="stylesheet"/>

  <link href="{{ asset('css/ticket.css')}}" rel="stylesheet" />
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/lobibox-master/css/lobibox.css') }}">
  <!--Bootstrap Datepicker-->
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
   <!--daterangepicker-->
  <link href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css">

  <!--Select Plugins-->
  <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/>

   <!--Pace Plugins-->
  <link href="{{ asset('assets/plugins/pace/themes/blue/pace-theme-flash.css') }}" rel="stylesheet"/>

    <!--Data Tables -->
  <link href="{{ asset('assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">


@yield('styles')

<!-- app css -->


@if(isset($pos_layout) && $pos_layout)
	<style type="text/css">
		.content{
			padding-bottom: 0px !important;
		}
	</style>
@endif
