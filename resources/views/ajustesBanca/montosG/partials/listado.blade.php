 @foreach($montoGlobalBancas as $montoGlobal)

    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-body">
                <div class="row">

                      @if(isset($montoGlobal->monto_global_banca->monto_global))
                    <div class="col-lg-12">
                        <div class="h4 m-0">Monto Global {{ $montoGlobal->mod_nombre  }}:
                            <a href="#" data-toggle="modal"  data-target="#actualizar" data-whatever="Actualizar Monto Global {{ $montoGlobal->mod_nombre }}" data-botton="Modificar" data-modalidad="{{ $montoGlobal->id }}" data-valor="{{ $montoGlobal->monto_global_banca->monto_global->mtg_valor }}">
                                <span class="badge badge-success"> {{ $montoGlobal->monto_global_banca->monto_global->mtg_valor }}</span>
                            </a>
                        </div>
                    </div>

                        @else
                    <div class="col-lg-12">
                        <a href="#" data-toggle="modal"  data-target="#nuevo" data-whatever="Nuevo Monto Global {{ $montoGlobal->mod_nombre }}" data-botton="Guardar" data-modalidad="{{ $montoGlobal->id }}" class="btn btn-oval btn-success">Nuevo Monto Global {{ $montoGlobal->mod_nombre }}</a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
