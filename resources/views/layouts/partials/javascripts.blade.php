 <script type="text/javascript">

    base_path = "{{url('/')}}";
</script>
 <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

  <!--accounting js-->
    <script src="{{ asset('assets/plugins/accounting.min.js?v=' . $asset_v) }}"></script>

  <!-- simplebar js -->
  <script src="{{ asset('assets/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- sidebar-menu js -->
  <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

  <!-- Custom scripts -->
  <script src="{{ asset('assets/js/app-script.js') }}"></script>

    <!-- loto scripts -->
  <script src="{{ asset('js/loto.js') }}"></script>

<script src="{{ asset('assets/plugins/lobibox-master/js/lobibox.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('assets/plugins/lobibox-master/js/notifications.js?v=' . $asset_v) }}"></script>
  {{-- <script src="{{ asset('assets/plugins/notifications/js/notification-custom-script.js?v=' . $asset_v) }}"></script> --}}


   <!--Bootstrap Switch Buttons-->
    <script src="{{ asset('assets/plugins/bootstrap-switch/bootstrap-switch.min.js?v=' . $asset_v) }}"></script>
      <!--Form Validatin Script-->
    <script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/js/messages_es.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment-timezone-with-data.min.js?v=' . $asset_v) }}"></script>

    {{-- <script src="{{ asset('assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js?v=' . $asset_v) }}"></script> --}}
    <script src="{{ asset('assets/plugins/jquery-timepicker/jquery.timepicker.js?v=' . $asset_v) }}"></script>
     <!--Bootstrap Datepicker Js-->
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js?v=' . $asset_v) }}"></script>
 <!--daterangepicker Js-->
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js?v=' . $asset_v) }}"></script>
      <!-- validar Campos -->
  <script src="{{ asset('js/validate/validate.js') }}"></script>

    <!--Data Tables js-->
  <script src="{{ asset('assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js?v=' . $asset_v) }}"></script>
  {{-- <script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datatable/js/jszip.min.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datatable/js/pdfmake.min.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datatable/js/vfs_fonts.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.html5.min.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.print.min.js?v=' . $asset_v) }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js?v=' . $asset_v) }}"></script> --}}

      <!--Select Plugins Js-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js?v=' . $asset_v) }}"></script>

      <!--Pace Plugins Js-->
    <script src="{{ asset('assets/plugins/pace/pace.js?v=' . $asset_v) }}"></script>


      <!--Sweet Alerts -->
  <script src="{{ asset('assets/plugins/alerts-boxes/js/sweetalert.min.js?v=' . $asset_v) }}"></script>



     {{-- <!--Multi Select Js-->
    <script src="{{ asset('assets/plugins/jquery-multi-select/jquery.multi-select.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('assets/plugins/jquery-multi-select/jquery.quicksearch.js?v=' . $asset_v) }}"></script> --}}

    <script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>

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

 @yield('scripts')
