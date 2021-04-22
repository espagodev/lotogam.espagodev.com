{{-- @dump($loterias) --}}
<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-body">

            <div class="row py-3 justify-content-center">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                 <tr>
                                    <th>Nombre Loteria</th>
                                    <th>Abreviado</th>
                                    <th>Horario</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($loterias as $key => $loteria)
                               @if($loteria->lot_superpale == '0')
                                    <tr>
                                        <td>{{ $loteria->lot_nombre}}</td>
                                        <td>{{ $loteria->lot_abreviado }}</td>


                                        <td>
                                            <a href="#" class="btn btn-outline-info" rel="tooltip" title="Horario de la Loteria" >
                                                        <i class="fa fa-clock-o"></i>
                                                        </a>
                                        </td>
                                        <td  class="card-body bt-switch">
                                            <input type="checkbox" data-id="{{$loteria->loterias_id}}" {{ $loteria->lob_estado ? 'checked' : '' }} data-size="small" data-on-color="success" data-off-color="default" data-on-text="<i class='fa fa-check-circle-o'></i>" data-off-text="<i class='fa  fa-ban'></i>" >
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            </div>
        </div>
    </div>
</div>
