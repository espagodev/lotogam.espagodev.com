@extends('layouts.app')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Modificar Empresa</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                 <a href="{{ route('empresas.index') }}"  class="btn btn-danger waves-effect waves-danger"><i class="fa fa-undo"></i> Regresar</a>
            </div>
        </div>
     </div>
      <form action="{{ route('empresas.update',$empresa->id) }}" enctype="multipart/form-data" method="post">
                    @csrf {{method_field('PUT')}}
            @include('empresas.partials._formEditar')
      </form>
   @endsection

@section('scripts')

@endsection
