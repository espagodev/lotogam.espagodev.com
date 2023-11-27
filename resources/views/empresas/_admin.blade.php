 <div class="card-header">Datos Usuario Administrador</div>
 <input type="hidden" name="id_admin" id="id_admin" value="{{ $admin->id }}">
 <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Nombre Administrador:</strong>
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text" value="{{ old('name', $admin->name) }}"required >
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Nick:</strong>
                                        <input id="use_nickname" type="text" class="form-control" name="use_nickname"  value="{{ old('use_nickname', $admin->use_nickname) }}" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Correo Administrador:</strong>
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" type="text" value="{{ old('email', $admin->email) }}" required>
                                </div>
                            </div>
                            

                        </div>
                        <div class="row">                            
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Contraseña:</strong>
                                        <input id="password" type="password" class="form-control" name="password" autocomplete="off" placeholder="Contraseña" >
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <strong>Confirme Contraseña:</strong>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirme la Contraseña">
                                </div>
                            </div>
                        </div>
                    </div>
