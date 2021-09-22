@extends('layouts.admin')
@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Editar Role
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Role</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Editar Rol</h4>
                        </div>
                        {!! Form::model($role, ['route'=>['roles.update',$role->id],'method'=>'PUT']) !!}
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
                                                <label class="mr-2 form-check">
                                                    <input class="form-check-input position-static" type="checkbox" name="permisions[]"
                                                    value="{{ $id }}"  @if ($role->permissions->contains($id)) checked @endif>
                                                    {{ $permission }}
                                                </label>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                            <a href="{{ route('roles.index')}}" class="btn btn-light">Cancelar</a>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{!! Html::script('js/data-table.js') !!}
@endsection
