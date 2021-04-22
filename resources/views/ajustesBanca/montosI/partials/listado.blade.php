{{-- @dump($montosIndividualBancas) --}}



 @foreach($montosIndividualBancas as $montosIndividual)

    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-body">
                <div class="row">
                {{-- @dump($montosIndividual->monto_individual_banca->monto_individual->mti_valor) --}}

                      @if(isset($montosIndividual->monto_individual_banca->monto_individual))

                       <div class="h4 m-0">Monto Individual {{ $montosIndividual->mod_nombre  }}:
                            <a href="#" data-toggle="modal"  data-target="#actualizar" data-whatever="Actualizar Monto Individual {{ $montosIndividual->mod_nombre }}" data-botton="Modificar" data-modalidad="{{ $montosIndividual->id }}" data-valor="{{ $montosIndividual->monto_individual_banca->monto_individual->mti_valor }}">
                                <span class="badge badge-success"> {{ $montosIndividual->monto_individual_banca->monto_individual->mti_valor }}</span>
                            </a>
                        </div>
                        @else
                    <div class="col-lg-12">
                        <a href="#" data-toggle="modal"  data-target="#nuevo" data-whatever="Nuevo Monto Individual {{ $montosIndividual->mod_nombre }}" data-botton="Guardar" data-modalidad="{{ $montosIndividual->id }}" class="btn btn-oval btn-success">Nuevo Monto Individual {{ $montosIndividual->mod_nombre }}</a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
