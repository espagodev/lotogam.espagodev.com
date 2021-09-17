@extends('layouts.app')
@section('title','Listado Numeros')
    @section('content')
    @if((request()->session()->get('user.TipoUsuario') == 2) || (request()->session()->get('user.useCuadreCaja') == 1))
        @include('reportes.partials.opcionesAdmin')
        @elseif((request()->session()->get('user.TipoUsuario') == 3))
            @include('reportes.partials.opcionesBanca')
        @endif
    <div class="row">
            <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <table class="table no-border table-sm"  id="reporte_modalidades">
                                <thead>
                                    <tr>
                                        <th>Quinielas Vendidas:</th>
                                        <td>
                                            <span class="quinielas_vendidas">

                                            </span>
                                        </td>
                                    </tr>
                                     <tr>
                                        <th><a href="#" data-modalidad="1" class="detalle-modalidades">Total Quinielas:</a></th>
                                        <td>
                                            <span class="total_quinielas">

                                            </span>
                                        </td>
                                    </tr>
                                     <tr>
                                        <th>Pale Vendidos:</th>
                                        <td>
                                            <span class="pale_vendido">

                                            </span>
                                        </td>
                                    </tr>
                                     <tr>
                                        <th><a href="#" data-modalidad="2" class="detalle-modalidades">Total Pales:</a></th>
                                        <td>
                                            <span class="total_pales">

                                            </span>
                                        </td>
                                    </tr>
                                     <tr>
                                        <th>Tripletas Vendidas:</th>
                                        <td>
                                            <span class="tripletas_vendidas">

                                            </span>
                                        </td>
                                    </tr>
                                     <tr>
                                        <th><a href="#" data-modalidad="3" class="detalle-modalidades">Total Tripletas:</a></th>
                                        <td>
                                            <span class="total_tripletas">

                                            </span>
                                        </td>
                                    </tr>
                                     <tr>
                                        <th>SuperPale Vendidos:</th>
                                        <td>
                                            <span class="superpale_vendido">

                                            </span>
                                        </td>
                                    </tr>
                                     <tr>
                                        <th><a href="#" data-modalidad="4" class="detalle-modalidades">Total SuperPales:</a></th>
                                        <td>
                                            <span class="total_superpales">

                                            </span>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
            </div>
             <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped  fixed_header">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Loteria</th>                                         
                                            <th class="text-left">Numero</th>
                                            <th class="text-left">Apuesta</th>
                                            <th class="text-left">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody class="detalle">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
    @endsection
@section('scripts')
    <script src="{{ asset('js/reporte_modalidades.js?v=' . $asset_v) }}"></script>

@endsection
