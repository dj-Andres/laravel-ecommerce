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
                Usuario
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Usuario</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Usuario 
                                <a href="{{route('users.create')}}" class="btn btn-primary">Crear Nuevo</a>
                            </h4>
                            {{--  <i class="fas fa-ellipsis-v"></i>  --}}
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                  {{--  <button class="dropdown-item" type="button">Another action</button>
                                  <button class="dropdown-item" type="button">Something else here</button>  --}}
                                </div>
                              </div>
                        </div>
    
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Correo Electronico</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{$user->id}}</th>
                                        <td>
                                            <a href="{{route('users.show',$user)}}">{{$user->name}}</a>
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td style="width: 50px;">
                                            {!! Form::open(['route'=>['users.destroy',$user], 'method'=>'DELETE']) !!}
    
                                            <a class="jsgrid-button jsgrid-edit-button" href="{{route('users.edit', $user)}}" title="Editar">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            
                                            <button class="jsgrid-button jsgrid-delete-button unstyled-button" type="submit" title="Eliminar">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
    
                                            {!! Form::close() !!}
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
