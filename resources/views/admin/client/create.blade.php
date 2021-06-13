@extends('layouts.admin')
@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }

        .error {
            color: #FF0000;
            padding-top: 2px;
        }
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;
        }
        .image-wrapper img{
            border-radius: 7px;
            border: 2px solid blueviolet;
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Registro de Clientes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('client.index') }}">Clientes</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro cliento</h4>
                        </div>

                        {!! Form::open(['route' => 'client.store', 'method' => 'POST','id' => 'formulario','class' => 'form-sample']) !!}

                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Nombre') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre del Cliente', 'id' => 'name']) !!}
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('cedula', 'Cedula') !!}
                                        {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Cedula', 'id' => 'cedula']) !!}
                                        @error('cedula')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6-col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('ruc', 'Numero Ruc') !!}
                                        {!! Form::text('ruc', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el RUC', 'id' => 'rucs']) !!}
                                            
                                        @error('ruc')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email') !!}
                                        {!! Form::email('email', null, ['class'=>'form-control','id' => 'email','placeholder'=>'Ingresar el Email']) !!}
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6-col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('direccion', 'Dirección') !!}
                                        {!! Form::text('address', null, ['class'=>'form-control','id' => 'addres','placeholder'=>'Ingresar su Dirección']) !!}
                                        @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            ,<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('Telefono', 'Telefono/Celular') !!}
                                        {!! Form::text('phone', null, ['class'=>'form-control','id' => 'phone','placeholder'=>'Ingresar su Telefono']) !!}
                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group pt-2">
                                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                                        <a href="{{ route('client.index') }}" class="btn btn-light">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/jquery.validate.min.js') !!}
@endsection
