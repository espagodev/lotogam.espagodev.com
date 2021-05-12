
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header d-flex align-items-left">
                    <div class="d-flex justify-content-left col">
                        <div class="h4 m-0 text-left">Ajustes Comunes</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf {{method_field('PUT')}}
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Color del Tema:</strong>
                                            <select class="form-control " name="emp_theme_color" id="emp_theme_color">
                                                <option value="">Seleccione</option>
                                                    @foreach($themeColors as $key => $themeColor)
                                                    <option value="{{ $key }}" >{{ $themeColor }}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">

                                        <strong>Entradas de página predeterminadas de la tabla de datos:</strong>
                                            <select class="form-control " name="emp_ajustes_comunes[datos_pagina_predeterminado]" id="datos_pagina_predeterminado" >
                                                    @foreach($registrosPorPagina as $key => $registrosPagina)
                                                    <option value="{{ $key }}"  @if($key == $emp_ajustes_comunes->datos_pagina_predeterminado) selected @endif >{{ $registrosPagina }}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                                </div>

                            </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


