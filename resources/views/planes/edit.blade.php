@extends('layouts.app')
@section('title', 'Modificar Plan')
    @section('content')
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Nuevo Plan</h4>

	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
                 <a href="{{ route('planes.index') }}"  class="btn btn-danger waves-effect waves-danger"><i class="fa fa-undo"></i> Regresar</a>

            </div>
        </div>
     </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                <form action="{{ route('planes.update', $plan->id) }}" method="post" id="store">
                    @csrf {{method_field('PUT')}}
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Codigo del Plan</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="pla_codigo" name="pla_codigo"  value="{{ old('pla_codigo', $plan->pla_codigo) }}" required>
                  </div>
                  <label  class="col-sm-2 col-form-label">Nombre Plan</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="pla_nombre" name="pla_nombre"  value="{{ old('pla_nombre', $plan->pla_nombre) }}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label"># de Bancas</label>
                  <div class="col-sm-2">
                    <input type="number" class="form-control" id="pla_banca" name="pla_banca"  value="{{ old('pla_banca', $plan->pla_banca) }}" required>
                  </div>
                  <label  class="col-sm-2 col-form-label">Valor del Plan</label>
                  <div class="col-sm-2">
                    <input type="number" class="form-control" id="pla_valor" name="pla_valor" value="{{ old('pla_valor', $plan->pla_valor) }}"  required>
                  </div>
                  <label  class="col-sm-2 col-form-label">Tiempo de Duracción(Meses)</label>
                  <div class="col-sm-2">
                    <input type="number" class="form-control" id="pla_tiempo_duracion" name="pla_tiempo_duracion"  value="{{ old('pla_tiempo_duracion', $plan->pla_tiempo_duracion) }}" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="input-17" class="col-sm-2 col-form-label">Descripción</label>
                  <div class="col-sm-10">
                      <textarea id="summernoteEditor" class="form-control" rows="4" id="input-17" name="pla_descripcion_1">{{ old('pla_descripcion_1', $plan->pla_descripcion_1) }}</textarea>

                  </div>
                </div>
                <div class="form-footer">
                      <a href="{{ route('planes.index') }}"  class="btn btn-danger waves-effect waves-danger"><i class="fa fa-undo"></i> Cancelar</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> MODIFICAR</button>
                </div>
              </form>
                    </div>
                </div>
            </div>
      </div><!--End Row-->
   @endsection
    @section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote-bs4.css') }}"/>
     @endsection
   @section('scripts')
  <script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
  <script>
   $('#summernoteEditor').summernote({
            height: 200,
            tabsize: 2
        });
  </script>
   @endsection
