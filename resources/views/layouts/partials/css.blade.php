



  <link href="{{ asset('css/vendor.css') }}" rel="stylesheet"/>

  <link href="{{ asset('css/loto.css') }}" rel="stylesheet"/>

  <link href="{{ asset('css/ticket.css')}}" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('/assets/css/toastr.css') }}">

@yield('styles')

<!-- app css -->


@if(isset($pos_layout) && $pos_layout)
	<style type="text/css">
		.content{
			padding-bottom: 0px !important;
		}
	</style>
@endif
