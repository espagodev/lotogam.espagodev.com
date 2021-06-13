
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

            <table class="table table-sm table-condensed">
                <thead>
                <tr>
                    <th>Loteria</th>
                    <th>Venta</th>
                    <th>Venta Promo</th>
                    <th>Comision</th>
                    <th>Premios</th>
                    <th>Premios Promo</th>
                    <th>Ganancia</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($receipt->lines as $line)
                        <tr>
                            <td>{{ $line->nombre }}</td>
                            <td>{{ $line->venta }}</td>
                            <td>{{ $line->ventaPromo }}</td>
                            <td>{{ $line->comision }}</td>
                            <td>{{ $line->ganado }}</td>
                            <td>{{ $line->premioPromo }}</td>
                            <td>{{ $line->ganancia }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><h5>Total</h5></td>
                        <td><h5>{{ $receipt->totales->TotalVenta }}</h5></td>
                        <td><h5>{{ $receipt->totales->TotalVentaPromo }}</h5></td>
                        <td><h5>{{ $receipt->totales->TotalComision }}</h5></td>
                        <td><h5>{{ $receipt->totales->TotalPremios }}</h5></td>
                        <td><h5>{{ $receipt->totales->TotalPremiosPromo }}</h5></td>
                        <td><h5>{{ $receipt->totales->TotalGanancia }}</h5></td>
                    </tr>
                </tbody>
            </table>

