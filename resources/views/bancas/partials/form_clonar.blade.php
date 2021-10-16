
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <strong>Codigo Banca:</strong>
                            <input class="form-control{{ $errors->has('ban_cod') ? ' is-invalid' : '' }}" name="ban_cod" id="ban_cod" type="text" value="{{ old('ban_cod') }}" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div class="form-group">
                            <strong>Nombre Banca:</strong>
                            <input class="form-control{{ $errors->has('ban_nombre') ? ' is-invalid' : '' }}" name="ban_nombre" id="ban_nombre" type="text" value="{{ old('ban_nombre') }}" required>
                        </div>
                    </div>
                    <p>Este Proceso Puede Tardar algunos Minutos</p>
                </div>
