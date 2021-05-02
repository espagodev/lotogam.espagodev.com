<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-6">
            </div>
             <div class="col-6">
                <h4 class="float-sm-right">{{ $receipt->business_name }}</h4>
            </div>
        </div>
         <div class="row">
            <div class="col-12">
                <h3>Reporte de Ventas</h3>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-6">
                <h5>Banca:</h5>
            </div>
            <div class="col-6">
                <h5 class="float-sm-right">{{ $receipt->star_label }} {{ $receipt->star_date }}</h5>
            </div>
        </div>
        <div class="row">
             <div class="col-6">
            <h5 >Usuario: </h5>
            </div>
            <div class="col-6">
            <h5 class="float-sm-right">{{ $receipt->end_label }} {{ $receipt->end_date }}</h5>
            </div>
        </div>

        <!-- Table row -->
        <div class="row">
            <div class="col-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Loteria</th>
                    <th>Venta</th>
                    <th>Comision</th>
                    <th>Premios</th>
                    <th>Ganancia</th>
                </tr>
                </thead>
                <tbody>
                     @php
                        $TotalVenta = 0;
                        $TotalComision = 0;
                        $TotalPremios = 0;
                        $TotalGanancia = 0;
                    @endphp
                    @foreach($receipt->lines as $line)
                        @php

                            $ganancia =  $line->venta - $line->comision - $line->ganado;

                            $TotalVenta = $TotalVenta + $line->venta;
                            $TotalComision = $TotalComision + $line->comision;
                            $TotalPremios = $TotalPremios + $line->ganado;
                            $TotalGanancia = $TotalGanancia + $ganancia;

                        @endphp
                        <tr>
                            <td>{{ $line->nombre }}</td>
                            <td>{{ $line->venta }}</td>
                            <td>{{ $line->comision }}</td>
                            <td>{{ $line->ganado }}</td>
                            <td>{{ $line->ganancia }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><h5>Total</h5></td>
                        <td><h5></h5>{{ $TotalVenta }}</h5></td>
                        <td><h5>{{ $TotalComision }}</h5></td>
                        <td><h5>{{ $TotalPremios }}</h5></td>
                        <td><h5>{{ $TotalGanancia }}</h5></td>
                    </tr>
                </tbody>
            </table>
            <p>VALORES SIN TICKET DE PROMOCION</p>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div>
</div>
