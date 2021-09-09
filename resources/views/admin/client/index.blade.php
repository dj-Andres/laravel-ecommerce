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
        @if (Session::has('message'))
        <div class="alert alert-success text-center">
            <span><i class="fas fa-check m-1"></i>{{ Session::get('message') }}</span>
        </div>
        @endif
        <div class="page-header">
            <h3 class="page-title">
                Clientes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">clientes</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">
                                @can('client.create')
                                    <a href="{{route('client.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Cliente</a>
                                @endcan
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Cedula</th>
                                        <th>Dirección</th>
                                        <th>Telefono</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <th scope="row">{{$client->id}}</th>
                                        <td>
                                            <a href="{{route('client.show',$client)}}">{{$client->name}}</a>
                                        </td>
                                        <td>{{$client->cedula}}</td>
                                        <td>{{$client->address}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td>{{$client->email}}</td>
                                        <td style="width: 50px;">
                                            {!! Form::open(['route'=>['client.destroy',$client], 'method'=>'DELETE','id' => 'delete']) !!}
                                            @can('client.edit','client.destroy')
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{route('client.edit', $client)}}" title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <button class="jsgrid-button jsgrid-edit-button unstyled-button" title="Eliminar" id="delete">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            @endcan
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