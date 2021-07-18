<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'nombre') !!}
            {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Ingrese el Nombre del Rol']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('descripcion', 'Descripción') !!}
            {!! Form::text('guard_name', null, ['class' => 'form-control','placeholder' => 'Ingrese la Descripcion']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <ul class="list-unstyled">
                <h4>Listado de Permisos</h4>
                @foreach ($permisions as $permision)
                    <div>
                        <label>
                            {!! Form::checkbox('permisions[]', $permision->id, null, ['class' => 'mr-1']) !!}
                            {{ $permision->name }} - <em>Entorno {{ $permision->guard_name }} </em>
                        </label>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
</div>