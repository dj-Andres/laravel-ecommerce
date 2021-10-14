<meta name="_token" content="{!! csrf_token() !!}" />
<fieldset>
    <div id="errors"></div>
    <div class="row">
        <input type="hidden" name="id" @if (isset($user)) value={{ $user->id }}@endif id="user_id">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre del Usuario','id' => 'name']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su dirección de email','id' => 'email']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('password', 'Contrasena') !!}
                {!! Form::password('password', ['class' => 'form-control','id' => 'password']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <h4>Listado de Roles</h4>
            <ul class="list-unstyled">
                @foreach ($rols as $role)
                    <div>
                        <label>
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1','id' => 'roles']) !!}
                            {{ $role->name }}
                            <em> {{ $role->guard_name }} </em>
                        </label>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
        <a href="{{ route('users.index') }}" class="btn btn-light">Cancelar</a>
    </div>
</fieldset>
