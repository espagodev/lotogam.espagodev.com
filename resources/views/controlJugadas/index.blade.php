@extends('layouts.app')
@section('title','Control de Apuestas')
    @section('content')

     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Control de Apuestas</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
            </div>
        </div>
     </div>
       @include('reportes.partials.control_apuestas')
      <div class="row">
          <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            {{-- <div class="table-responsive"> --}}
                               <table class="table table-bordered table-striped table-sm"  id="control_apuestas">
                                    <thead>
                                        <tr>
                                            <th>Loteria</th>
                                            <th>Banca</th>
                                            <th>Modalidad</th>
                                            <th>Numero</th>
                                            <th>Contador</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                </table>
                            {{-- </div> --}}
                    </div>
                </div>
            </div>

    </div>
   @endsection
@section('scripts')
        <script src="{{ asset('js/reportes/control_apuestas.js?v=' . $asset_v) }}"></script>
 @endsection


