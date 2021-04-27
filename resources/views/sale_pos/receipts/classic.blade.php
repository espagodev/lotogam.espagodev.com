<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-6">
            </div>
             <div class="col-6">
              <h4 class="float-sm-right"><i class="fa fa-globe"></i>{{ $receipt->business_name }}</h4>
            </div>
        </div>
         <div class="row">
             <div class="col-lg-6">
              <h4 class="float-sm-right">Administrador:</h4>
            </div>
        </div>
        <hr>
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

        <hr>
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
            @foreach($receipt->lines as $line)
                <tr>
                    <td>{{ $line->nombre }}</td>
                    <td>{{ $line->venta }}</td>
                    <td>{{ $line->comision }}</td>
                    <td>{{ $line->ganado }}</td>
                    <td>{{ $line->ganancia }}</td>
                </tr>
            @endforeach
                </tr>
                </tbody>
            </table>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div>
</div>
