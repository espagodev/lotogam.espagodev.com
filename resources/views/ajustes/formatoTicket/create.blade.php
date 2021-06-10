@extends('layouts.app')
@section('title', 'Crear nuevo diseño de Ticket')
    @section('content')
         <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Ajustes Empresa / ECrear nuevo diseño de Ticket</h4>
	   </div>
        <div class="col-sm-3">
            <div class="btn-group float-sm-right">
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
                            <h5 class="card-title">Crear nuevo diseño de Ticket</h5>
                                 <form action="{{ route('formatoTicket.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <strong>Nombre del diseño:</strong>
                                                                    <input class="form-control{{ $errors->has('tcon_nombre') ? ' is-invalid' : '' }}" name="tcon_nombre" id="tcon_nombre" type="text" value="{{ old('tcon_nombre') }}" >
                                                                </div>
                                                            </div>
                                                             <div class="col-xs-6 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <strong>Diseño:</strong>
                                                                        <select class="form-control" name="tcon_formato_browser" id="tcon_formato_browser">
                                                                            <option value="">Seleccione</option>
                                                                                @foreach($formatos as $key => $formato)
                                                                                <option value="{{ $key }}">{{ $formato }}</option>
                                                                                @endforeach
                                                                        </select>
                                                                     <span class="help-block">
                                                                        Utilizado para la impresión basada en navegador
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <strong>Logotipo de la Ticket:</strong>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="tcon_logo" name="tcon_logo">
                                                                        <label class="custom-file-label" for="tcon_logo">Seleccionar</label>
                                                                    </div>
                                                                    <span class="help-block">
                                                                        Max 1 MB, Solo formatos jpeg, gif o png
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_logo" name="tcon_show_logo"  value="1"/>
                                                                        <label for="tcon_show_logo">Mostrar el Logotipo en el Ticket</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                            <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <strong>Ticket no. Etiqueta:</strong>
                                                                    <input class="form-control{{ $errors->has('tcon_etiqueta_ticket') ? ' is-invalid' : '' }}" name="tcon_etiqueta_ticket" id="tcon_etiqueta_ticket" type="text" value="{{ old('tcon_etiqueta_ticket') }}" >
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <strong>Pin no. etiqueta:</strong>
                                                                    <input class="form-control{{ $errors->has('tcon_etiqueta_pin') ? ' is-invalid' : '' }}" name="tcon_etiqueta_pin" id="tcon_etiqueta_pin" type="text" value="{{ old('tcon_etiqueta_pin') }}" >

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <strong>Etiqueta Fecha Venta:</strong>
                                                                    <input class="form-control{{ $errors->has('tcon_date_label') ? ' is-invalid' : '' }}" name="tcon_date_label" id="tcon_date_label" type="text" value="{{ old('tcon_date_label') }}" >
                                                                </div>
                                                            </div>
                                                             <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <strong>Etiqueta Fecha Sorteo:</strong>
                                                                    <input class="form-control{{ $errors->has('tcon_sorteo_label') ? ' is-invalid' : '' }}" name="tcon_sorteo_label" id="tcon_sorteo_label" type="text" value="{{ old('tcon_sorteo_label') }}" >
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <strong>Formato de Fecha:</strong>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                                        </div>
                                                                        <select class="form-control" name="tcon_date_time_format" id="tcon_date_time_format">
                                                                            <option value="">Seleccione</option>
                                                                                @foreach($formatoFechas as $key => $formatoFecha)
                                                                                <option value="{{ $key }}">{{ $formatoFecha }}</option>
                                                                                @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Eslogan</strong>
                                                                    <input class="form-control{{ $errors->has('tcon_slogan') ? ' is-invalid' : '' }}" name="tcon_slogan" id="tcon_slogan" type="text" value="{{ old('tcon_slogan') }}" >
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                            </div>
                                            {{-- <h5 class="card-title">Campos para detalles del cliente:</h5> --}}

                                            <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_business_name" name="tcon_show_business_name" value="1"/>
                                                                        <label for="tcon_show_business_name">Mostrar Nombre Empresa</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_location_name" name="tcon_show_location_name" value="1"/>
                                                                        <label for="tcon_show_location_name">Mostar Nombre Banca</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_eslogan" name="tcon_show_eslogan" value="1"/>
                                                                        <label for="tcon_show_eslogan">Mostar Eslogan</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <div class="row">
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_sorteo" name="tcon_show_sorteo" value="1"/>
                                                                        <label for="tcon_show_sorteo">Mostrar Fecha Sorteo</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <h5 class="card-title">Campos que se mostrarán en la dirección de ubicación</h5>
                                            <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-3 col-md-3">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_city" name="tcon_show_city" value="1"/>
                                                                        <label for="tcon_show_city">Ciudad</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3 col-md-3">
                                                                <div class="form-group">
                                                                <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_state" name="tcon_show_state" value="1"/>
                                                                        <label for="tcon_show_state">Estado</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3 col-md-3">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_country" value="1"/>
                                                                        <label for="tcon_show_country">País</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3 col-md-3">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_zip_code" name="tcon_show_zip_code" value="1"/>
                                                                        <label for="tcon_show_zip_code">Código Postal</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                            </div>
                                            <h5 class="card-title">Campos para detalles de comunicación:</h5>
                                            <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_mobile_number" name="tcon_show_mobile_number" value="1"/>
                                                                        <label for="tcon_show_mobile_number">Numero de Teléfono Movil</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_alternate_number" name="tcon_show_alternate_number" value="1"/>
                                                                        <label for="tcon_show_alternate_number">Número Alternativo</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_email" name="tcon_show_email" value="1"/>
                                                                        <label for="tcon_show_email">Email</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                            </div>
                                            <h5 class="card-title">Mostrar Códigos</h5>
                                            <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_barcode" name="tcon_show_barcode" value="1"/>
                                                                        <label for="tcon_show_barcode">Mostrar código de Barras </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-4 col-md-4">
                                                                <div class="form-group">
                                                                <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_barcode_qr" name="tcon_show_barcode_qr" value="1"/>
                                                                        <label for="tcon_show_barcode_qr">Mostrar código de QR</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                            </div>
                                            <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Texto de Pie de Página</strong>
                                                                    <input class="form-control{{ $errors->has('tcon_ticket_mensaje') ? ' is-invalid' : '' }}" name="tcon_ticket_mensaje" id="tcon_ticket_mensaje" type="text" value="{{ old('tcon_ticket_mensaje') }}" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Nota Informativa.</strong>
                                                                    <textarea  class="form-control{{ $errors->has('tcon_nota_informativa') ? ' is-invalid' : '' }}" name="tcon_nota_informativa" id="tcon_nota_informativa" rows="10" cols="50"></textarea>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_is_default" name="tcon_is_default" value="1"/>
                                                                        <label for="tcon_is_default">Establecer por Defecto</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                             <div class="col-xs-12 col-sm-6 col-md-6">
                                                                <div class="form-group">
                                                                    <div class="icheck-material-info">
                                                                        <input type="checkbox" id="tcon_show_nota" name="tcon_show_nota" value="1"/>
                                                                        <label for="tcon_show_nota">Monstrar Nota Informativa.</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        <div class="form-footer">
                                            <a href="{{ route('formatoTicket.index') }}" class="btn  btn-danger">Cancelar y Volver</a>
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> CREAR</button>
                                                </div>
                                    </div>
                                </form>
                        </div>
                    </div>
            </div>
      </div><!--End Row-->
    @endsection
