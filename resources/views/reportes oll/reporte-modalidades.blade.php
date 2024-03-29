@extends('layouts.app')
@section('title','Listado Numeros')
    @section('content')
   @include('reportes.partials.modalidades')
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
                             <table class="table table-sm table-striped  fixed_header">
                                <thead>
                                    <tr>
                                        <th class="text-center">Loteria</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Numero</th>
                                        <th class="text-center">Apuesta</th>
                                    </tr>
                                </thead>
                                 <tbody class="detalle">
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
    </div>
    @endsection
@section('scripts')
    <script src="{{ asset('js/reporte_modalidades.js?v=' . $asset_v) }}"></script>

@endsection
