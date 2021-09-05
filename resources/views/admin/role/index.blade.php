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
                Roles
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Roles
                                @can('roles.create')
                                    <a href="{{route('roles.create')}}" class="btn btn-primary">Crear Nuevo</a>
                                @endcan
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Rol</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rols as $rol)
                                    <tr>
                                        <th scope="row">{{$rol->id}}</th>
                                        <td>
                                            <a href="{{route('roles.show',$rol)}}">{{$rol->name}}</a>
                                        </td>
                                        <td>
                                            {{ $rol->guard_name }}
                                        </td>
                                        <td style="width: 50px;">
                                            @can('roles.destroy','roles.edit')
                                                {!! Form::open(['route'=>['roles.destroy',$rol], 'method'=>'DELETE']) !!}
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{route('roles.edit', $rol)}}" title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <button class="jsgrid-button jsgrid-delete-button unstyled-button" type="submit" title="Eliminar">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{!! Html::script('js/data-table.js') !!}
@endsection
