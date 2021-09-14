@extends('layouts.app')
@section('title', 'Listado Loterias Empresa')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa / Listado de Loterias</h4>
	   </div>
       <div class="col-sm-3">
        <div class="btn-group float-sm-right">
            <button type="button" class="btn btn-primary waves-effect waves-primary nuevo-modal" data-href="{{action('EmpresaSuperPaleController@getNuevoSuperPale') }}"><i class="fa fa-plus mr-1"></i> Nuevo SuperPale</button>
        </div>
    </div>
     </div>

        <div class="row">
             <div class="col-lg-3">
                 @include('ajustes._sidebar')
            </div>
            <div class="col-lg-9">

                <div class="card">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="loteriasSuper">
                                    <thead>
                                        <tr>
                                            <th scope="col">Loteria</th>
                                            <th scope="col">Abreviado</th>
                                            <th scope="col">estado</th>
                                            <th scope="col">opciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
      <div class="modal fade nuevo_modal" tabindex="-1" role="dialog"
      aria-labelledby="gridSystemModalLabel">
  </div>
                <div class="modal fade modificar_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel">
    </div>
   @endsection
      
    @section('scripts')
    <script src="{{ asset('js/ajustes/superpale/superpale.js?v=' . $asset_v) }}"></script>
     
    <script type="text/javascript">
      
         $(document).ready( function(){
        //Status table
         loteriasSuper = $('#loteriasSuper').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{action('EmpresaSuperPaleController@index')}}",
                columnDefs: [ {
                    "targets": 3,
                    "orderable": false,
                    "searchable": false
                } ],
                columns: [
                    { data: 'lot_nombre', name: 'lot_nombre' },
                    { data: 'lot_abreviado', name: 'lot_abreviado' },
                    { data: 'estado', name: 'estado' },
                    { data: 'action', name: 'action' },
                ]
            });
    });
   </script>
    @endsection
