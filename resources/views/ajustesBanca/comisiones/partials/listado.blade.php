{{-- @dump($comisionesBancas) --}}

 @foreach($comisionesBancas as $comisionesBanca)
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="card card-default">
            <div class="card-body">
                <div class="row">
                      @if(isset($comisionesBanca->comisiones_banca->comision->com_valor))
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="h4 m-0">Comisión {{ $comisionesBanca->mod_nombre }}:
                            <a href="#" data-toggle="modal"  data-target="#actualizar" data-whatever="Actualizar Comisión {{ $comisionesBanca->mod_nombre }}" data-botton="Modificar" data-modalidad="{{ $comisionesBanca->id }}" data-valor="{{ $comisionesBanca->comisiones_banca->comision->com_valor }}">
                                <span class="badge badge-success"> {{ $comisionesBanca->comisiones_banca->comision->com_valor }} %</span>
                            </a>
                        </div>
                    </div>
                        @else
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="#" data-toggle="modal"  data-target="#nuevo" data-whatever="Nueva Comisión {{ $comisionesBanca->mod_nombre }}" data-botton="Guardar" data-modalidad="{{ $comisionesBanca->id }}" class="btn btn-oval btn-success">Nueva Comision {{ $comisionesBanca->mod_nombre }}</a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
@endforeach


