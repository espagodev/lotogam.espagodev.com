 <script type="text/javascript">

    base_path = "{{url('/')}}";
</script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js?v=$asset_v"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js?v=$asset_v"></script>
<![endif]-->
    <script src="{{ asset('js/vendor.js?v=' . $asset_v) }}"></script>

    <!-- loto scripts -->


    @php
    // @dump(Session::get("business[time_zone]"));
    $business_date_format = session('business.date_format');

    $datepicker_date_format = str_replace('d', 'dd', $business_date_format);
    $datepicker_date_format = str_replace('m', 'mm', $datepicker_date_format);
    $datepicker_date_format = str_replace('Y', 'yyyy', $datepicker_date_format);

    $moment_date_format = str_replace('d', 'DD', $business_date_format);
    $moment_date_format = str_replace('m', 'MM', $moment_date_format);
    $moment_date_format = str_replace('Y', 'YYYY', $moment_date_format);

    $business_time_format = session('business.time_zone');

    $moment_time_format = 'HH:mm';
    if($business_time_format == 12){
        $moment_time_format = 'hh:mm A';
    }

    $emp_ajustes_comunes = !empty(session('business.emp_ajustes_comunes')) ? session('business.emp_ajustes_comunes') : [];

    $datos_pagina_predeterminado = !empty($emp_ajustes_comunes['datos_pagina_predeterminado']) ? $emp_ajustes_comunes['datos_pagina_predeterminado'] : 25;

    @endphp
<script>

moment.tz.setDefault('{{ Session::get("business.time_zone") }}');

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });

    var datepicker_date_format = "{{$datepicker_date_format}}";
    var moment_date_format = "{{$moment_date_format}}";
    var moment_time_format = "{{$moment_time_format}}";

    var app_locale = "{{ config('app.locale') }}";

     var financial_year = {
        start: moment('{{ Session::get("financial_year.start") }}'),
        end: moment('{{ Session::get("financial_year.end") }}'),
    }

    var __datos_pagina_predeterminado = "{{$datos_pagina_predeterminado}}";
    </script>
     <script>
        $(".bt-switch input[type='checkbox']").bootstrapSwitch();
    </script>
<script src="{{ asset('js/functions.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/common.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/loto.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas2image@1.0.5/canvas2image.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script> --}}

    <script src="{{ asset('/assets/js/toastr.min.js?v=' . $asset_v) }}"></script>

    
    {!! Toastr::message() !!}
 @yield('scripts')
