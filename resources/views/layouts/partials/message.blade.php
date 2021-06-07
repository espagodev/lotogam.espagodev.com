 {{-- @if(!$pos_layout) --}}
            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger no-print">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success no-print">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        @foreach(session()->get('success') as $message)
                        <li>{{$message}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        {{-- @endif --}}

