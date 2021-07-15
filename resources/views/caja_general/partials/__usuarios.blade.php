 <div class="form-group">
        <strong>Usuarios:</strong>
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
        </div>
        <select class="form-control " name="users_id" id="users_id">
            <option value="">Seleccione</option>
                {{-- @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}"  >{{ $usuario->name}}</option>
                @endforeach --}}
        </select>
    </div>
</div>
