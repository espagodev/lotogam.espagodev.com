@extends('layouts.auth.default')
    @section('content')
        <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="form-group">
                    <div class="position-relative has-icon-left">
                        <label for="exampleInputUsername" class="sr-only">Username</label>
                            <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" value="{{ old('email') }}" required autofocus>
                            <div class="form-control-position">
                            <i class="icon-user"></i>
                        </div>
                    </div>
				</div>
				<div class="form-group">
                    <div class="position-relative has-icon-left">
                        <label for="exampleInputPassword" class="sr-only">Password</label>
                        <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>
                        <div class="form-control-position">
                            <i class="icon-lock"></i>
                        </div>
                    </div>
				</div>
				<div class="form-row mr-0 ml-0">
                    <div class="form-group col-6">
                        <div class="icheck-material-primary">
                        <input type="checkbox" id="user-checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/>

                        <label for="user-checkbox">Recordarme</label>
                        </div>
                    </div>
				</div>
				<button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Ingresar</button>
        </form>
    @endsection
