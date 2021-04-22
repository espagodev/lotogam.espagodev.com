@extends('layouts.app')
@section('title', 'Sistema POS')
    @section('content')
    <section class="content no-print">
    <div class="row">
        <div class="col-md-7 col-sm-12">
            {{-- @dump($ticket) --}}
              <div class="card">
                    <div class="card-body">
                        <!-- CAMPOS DEL FORMULARIO -->
                        <form method="POST" id="add_pos_sell_form" action="{{ route('pos.store') }}">
                             <input type="hidden"  id="bancas_id" name="bancas_id" value="{{ request()->session()->get('user.banca') }}">
                            <input type="hidden"  id="users_id" name="users_id" value="{{ request()->session()->get('user.id') }}">
                            <div class="row">
                                @if($parametros->ban_venta_futuro == 1)
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                         <input type="text" id="tic_fecha_sorteo"  class="form-control" name="tic_fecha_sorteo" value="" data-date-format="dd/mm/yyyy">
                                    </div>
                                </div>
                                @endif
                                @if($parametros->ban_promocion == 1)
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <div class="icheck-material-info">
                                                <input type="checkbox" id="tic_promocion"  value="1" name="tic_promocion" />
                                                <label for="tic_promocion">Ticket Promocion</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                     <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ $symbol }}</span>
                                        </div>
                                        <input type="text" id="tid_valor" name="tid_valor" class="form-control" placeholder="Monto de Apuesta">
                                    </div>

                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="tid_apuesta" id="tid_apuesta" class="form-control" placeholder="Numero">
                                    </div>
                                </div>
                            </div>
                            <!-- DATOS LA TABLA -->
                            <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pos_product_div">
                                        <input type="hidden" id="product_row_count" value="0">
                                        <table class="table table-condensed  table-responsive" id="pos_table">
                                            <thead>
                                                <tr>
                                                    <th class="tex-center col-3 col-sm-3 col-md-3 col-lg-1 col-xl-1">
                                                    Modalidad
                                                    </th>
                                                    <th class="text-center col-3 col-sm-3 col-md-3 col-lg-1 col-xl-1">
                                                    Monto
                                                    </th>
                                                    <th class="text-center col-3 col-sm-3 col-md-3 col-lg-1 col-xl-1">
                                                    Apuesta
                                                    </th>
                                                    <th class="text-center col-3 col-sm-3 col-md-3 col-lg-1 col-xl-1"><i class="fa fa-close" aria-hidden="true"></i></th>
                                                </tr>
                                            </thead>
                                                <tbody></tbody>
                                        </table>
                                    </div>
                            </div>
                            @include('sale_pos.partials.pos_details')
                         </form>
                    </div>
              </div>
        </div>
          <div class="col-md-5 col-sm-12">
              <div class="card">
                    <div class="card-body">
                        @include('sale_pos.partials.lista_loterias')
                    </div>
              </div>

        </div>
    </div>
    </section>
    <!-- Esto se imprimirá-->
<section class="invoice print_section" id="receipt_section">
</section>

<div class="modal fade view_register" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade anular_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
@endsection
@include('sale_pos.partials.tickets_modal')

@section('scripts')
	<script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/ticket/ticket.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        var token = '{{ csrf_token() }}';
        // $('#tic_fecha_sorteo').datepicker('setDate', new Date());
         $('#tic_fecha_sorteo').datepicker({

        autoclose: true,
        todayHighlight: true,
        startDate: '0d',
        endDate: '+8d',
        language: "es"
      });
    </script>
@endsection
