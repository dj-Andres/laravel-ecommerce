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
                @foreach ($permissions as $id => $permission)
                    <div>
                        <label>
                            {!! Form::checkbox('permisions[]', $id, null, ['class' => 'mr-1']) !!}
                            {{ $permission }}
                        </label>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
</div>