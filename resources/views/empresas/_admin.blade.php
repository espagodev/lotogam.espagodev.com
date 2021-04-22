 <div class="card-header">Datos Usuario Administrador</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Nombre Administrador:</strong>
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text" value="{{ old('name') }}"required >
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Nick:</strong>
                                        <input id="use_nickname" type="text" class="form-control" name="use_nickname"  value="{{ old('use_nickname') }}" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Correo Administrador:</strong>
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" type="text" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Contraseña:</strong>
                                        <input id="password" type="password" class="form-control" name="password" autocomplete="off" required >
                                </div>
                            </div>

                        </div>
                    </div>
