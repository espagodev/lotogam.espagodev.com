 <div class="card no-print">
    <div class="card-body">
    <div class="row">
        <div class="col-md-4 col-xs-12">
             @if(((request()->session()->get('user.TipoUsuario') == 2) && (count((array)$bancas) > 1)) || (request()->session()->get('user.useCuadreCaja') == 1))
                 <select class="form-control" name="bancas_id" id="bancas_id" >
                    <option value="">Seleccione</option>
                    @foreach($bancas as  $banca)
                    <option value="{{ $banca->id }}"  >{{ $banca->ban_nombre}}</option>
                    @endforeach
                </select>
            @endif

            </div>
    		<div class="col-md-8 col-xs-12">
    			<div class="btn-group btn-group-toggle pull-right" data-toggle="buttons">
    				<label class="btn btn-info active">
        				<input type="radio" name="date-filter"
        				data-start="{{ date('Y-m-d') }}"
        				data-end="{{ date('Y-m-d') }}"
        				checked>Hoy
      				</label>
      				<label class="btn btn-info">
        				<input type="radio" name="date-filter"
        				data-start="{{ $date_filters['this_week']['start']}}"
        				data-end="{{ $date_filters['this_week']['end']}}"
        				>Esta Semana
      				</label>
      				<label class="btn btn-info">
        				<input type="radio" name="date-filter"
        				data-start="{{ $date_filters['this_month']['start']}}"
        				data-end="{{ $date_filters['this_month']['end']}}"
        				>Este Mes
      				</label>
      				{{-- <label class="btn btn-info">
        				<input type="radio" name="date-filter"
        				data-start="{{ $date_filters['this_fy']['start']}}"
        				data-end="{{ $date_filters['this_fy']['end']}}"
        				> Año Fiscal
      				</label> --}}
                </div>
    		</div>
    	</div>
    	<br>
      <div class="row mt-3">
    <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-scooter">
       <div class="card-body">
          <div class="media align-items-center">
            <div class="w-icon"><i class="fa fa-ticket text-white"></i></div>
            <div class="media-body ml-3 border-left-xs border-white-2">
              <h4 class="mb-0 ml-3 text-white total_tickets"></h4>
              <p class="mb-0 ml-3 extra-small-font text-white">Total Tickets</p>
            </div>
          </div>
        </div>
      </div>
     </div>

     <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-bloody">
       <div class="card-body">
          <div class="media align-items-center">
            <div class="w-icon"><i class="fa fa-money text-white"></i></div>
            <div class="media-body ml-3 border-left-xs border-white-2">
              <h4 class="mb-0 ml-3 text-white total_venta"></h4>
              <p class="mb-0 ml-3 extra-small-font text-white">Total Ventas</p>
            </div>
          </div>
        </div>
      </div>
     </div>

     <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-quepal">
       <div class="card-body">
          <div class="media align-items-center">
            <div class="w-icon"><i class="fa fa-money text-white"></i></div>
            <div class="media-body ml-3 border-left-xs border-white-2">
              <h4 class="mb-0 ml-3 text-white total_comision"></h4>
              <p class="mb-0 ml-3 extra-small-font text-white">Total Comisiones</p>
            </div>
          </div>
        </div>
      </div>
     </div>

     <div class="col-12 col-lg-6 col-xl-3">
      <div class="card gradient-blooker">
       <div class="card-body">
          <div class="media align-items-center">
            <div class="w-icon"><i class="fa fa-money text-white"></i></div>
            <div class="media-body ml-3 border-left-xs border-white-2">
              <h4 class="mb-0 ml-3 text-white  total_premios"></h4>
              <p class="mb-0 ml-3 extra-small-font text-white">Total Premios</p>
            </div>
          </div>
        </div>
      </div>
     </div>
   </div><!--End Row-->
    </div>
 </div>

 <div class="row no-print">

        <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 col-xs-12">
            <div class="card">
                <div class="card-body">

                <div class="card-title">Reporte de venta mes Actual
				    <div class="card-action">
					 <a href="#" type="button" class="print-invoice" data-href="{{action('HomeController@getVentasMesPrint')}}">
					  <i class="fa fa-print"></i>
                     </a>
                    </div>
				</div>
            <div class="table-responsive">
               <table class="table table-sm">
                <thead>
                  <tr>
                   <th scope="col">Loteria</th>
                    <th class="text-center" scope="col">Venta</th>
                    <th class="text-center" scope="col">Promocion</th>
                    <th class="text-center" scope="col">Comision</th>
                    <th class="text-center" scope="col">Premios</th>
                    <th class="text-center" scope="col">Promocion</th>
                    <th class="text-center" scope="col">Ganancia</th>
                  </tr>
                </thead>
                <tbody class="detalle-ventas">
                </tbody>
              </table>
            </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xs-12">
            <div class="card">
                <div class="card-body">
                     <div class="card-title">Resultados
				    <div class="card-action">
					 <a type="button" class="resultados_print" data-href="{{action('ResultadosController@getResultadosFechaPrint')}}">
					  <i class="fa fa-print"></i>
                     </a>
                    </div>
				</div>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>Loteria</th>
                                    <th>Resultados</th>
                                </tr>
                                </thead>
                                <tbody class="resultado_fecha">
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tickets Premiados</h5>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Ticket</th>
                                <th>Fecha</th>
                                <th>Loteria</th>
                            </tr>
                            </thead>
                            <tbody class="tickets-premiados">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

 </div>


