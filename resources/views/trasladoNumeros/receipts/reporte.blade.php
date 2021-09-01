
         <div class="row">
            <div class="col-12">
                <h3>Listado de Numeros Para Traspaso</h3>
            </div>
        </div>

        <!-- Table row -->

            <table class="table table-sm table-condensed">
                <thead>
                <tr>
                    <th>Loteria</th>
                    <th>Modaldad</th>
                    <th>Numero</th>
                    <th>Contador</th>                   
                </tr>
                </thead>
                <tbody>
                    @foreach($receipt as $line)
                        <tr>
                            <td>{{ $line->lot_nombre }}</td>
                            <td>{{ $line->mod_nombre }}</td>
                            <td>{{ $line->cnj_numero }}</td>
                            <td>{{ $line->cnj_contador }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

