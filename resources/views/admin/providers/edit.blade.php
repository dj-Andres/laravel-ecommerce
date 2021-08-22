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
              Actualizar  Proveedores
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Actualizar  Proveedores</h4>
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                </div>
                              </div>
                        </div>

                        {!! Form::model($provider, ['route'=>['providers.update',$provider],'method'=>'PUT']) !!}
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Nombre',['class'=>'col-sm-3 col-form-label']) !!}
                                        {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Nombre del Proveedor','id' => 'name']) !!}
                                        @error('name')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email',['class'=>'col-sm-3 col-form-label']) !!}
                                        {!! Form::email('email', null, ['class' => 'form-control','placeholder' => 'Correo Electronico' ]) !!}
                                        @error('email')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('ruc_number', 'N° RUC',['class'=>'col-sm-3 col-form-label']) !!}
                                        {!! Form::text('ruc_number', null, ['class' => 'form-control','placeholder' => 'Numero RUC' ]) !!}
                                        @error('ruc_number')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('address', 'Dirección',['class'=>'col-sm-3 col-form-label']) !!}
                                        {!! Form::text('address', null, ['class' => 'form-control','placeholder' => 'Dirección' ]) !!}
                                        @error('address')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('phone', 'Telefono',['class'=>'col-sm-3 col-form-label']) !!}
                                        {!! Form::text('phone', null, ['class' => 'form-control','placeholder' => 'Telefono' ]) !!}
                                        @error('phone')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                            <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                            <a href="{{ route('providers.index')}}" class="btn btn-light">Cancelar</a>
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
