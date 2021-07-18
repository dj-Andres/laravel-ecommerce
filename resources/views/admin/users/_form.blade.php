<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Ingrese el Nombre del Usuario']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control','placeholder' => 'Ingrese su dirección de email']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('password', 'Contrasena') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
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
                        {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                        {{ $role->name }}
                        <em> {{ $role->guard_name }} </em>
                    </label>
                </div>
            @endforeach
        </ul>
    </div>
</div>
