@inject('request', 'Illuminate\Http\Request')

@if($request->segment(1) == 'pos' && ($request->segment(2) == 'create' || $request->segment(3) == 'edit'))
    @php
        $pos_layout = true;
    @endphp
@else
    @php
        $pos_layout = false;
    @endphp
@endif

<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>@yield('title') -  {{ Session::get('user.surname') }}</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--favicon-->
  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
  <!-- simplebar CSS-->

            @include('layouts.partials.css')

        @yield('css')
</head>

<body>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming no-print"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
<div id="wrapper">
     <script type="text/javascript">
                if(localStorage.getItem("upos_sidebar_collapse") == 'true'){
                    var body = document.getElementsByTagName("body")[0];
                    body.className += " sidebar-collapse";
                }
            </script>
    <!--Start sidebar-wrapper-->
        @if(!$pos_layout)
            @include('layouts.partials.menu')
            @include('layouts.partials.sidebar')
        @else
            @include('layouts.partials.header-pos')
        @endif


    <div class="@if(!$pos_layout) content-wrapper @endif">
     <!-- Agregar campo relacionado con la moneda-->
                <input type="hidden" id="__code" value="{{session('currency')['code']}}">
                <input type="hidden" id="__symbol" value="{{session('currency')['symbol']}}">
                <input type="hidden" id="__thousand" value="{{session('currency')['thousand_separator']}}">
                <input type="hidden" id="__decimal" value="{{session('currency')['decimal_separator']}}">
                <input type="hidden" id="__symbol_placement" value="{{session('business.currency_symbol_placement')}}">
                <input type="hidden" id="__precision" value="{{config('constants.currency_precision', 2)}}">
                <input type="hidden" id="__quantity_precision" value="{{config('constants.quantity_precision', 2)}}">
                <!-- Fin del campo relacionado con la moneda-->
        <div class="@if(!$pos_layout) container-fluid no-print @endif ">
             @include('layouts.partials.message')
            @yield('content')

        {{-- <div class='scrolltop no-print'>
                    <div class='scroll icon'><i class="fas fa-angle-up"></i></div>
                </div> --}}
            <div class="overlay toggle-menu no-print"></div>
            </div>
                @if(!$pos_layout)
                @include('layouts.partials.footer')
            @else
                @include('layouts.partials.footer_pos')
            @endif
   </div><!--End content-wrapper-->

     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top no-print"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

      <!-- Esto se imprimirá -->

</div><!--End wrapper-->

<section class="invoice print_section" id="receipt_section">
        </section>


    @include('layouts.partials.javascripts')
  <!-- Bootstrap core JavaScript-->

    </body>
</html>
