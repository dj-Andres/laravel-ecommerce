<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
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
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Listado de Permisos</h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="order-listing">
                        <thead>
                            <tr>
                                <th>Permiso</th>
                                <th><i class="fas fa-plus"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($role))
                                @foreach ($permissions as $id => $permission)
                                    <tr>
                                        <td>{{ $permission }}</td>
                                        <td id="roles">
                                            <label>
                                                <input class="mr-1" type="checkbox" name="permisions[]" value="{{ $id }}"  @if ($role->permissions->contains($id)) checked @endif>
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach ($permissions as $id => $permission)
                                    <tr>
                                        <td>{{ $permission }}</td>
                                        <td id="roles">
                                            <label>
                                                {!! Form::checkbox('permisions[]', $id, null, ['class' => 'mr-1']) !!}
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
        <a href="{{ route('roles.index')}}" class="btn btn-light">Cancelar</a>
    </div>
</div>