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

    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Registro de Productos
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Productos</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro Producto</h4>
                        </div>

                        {!! Form::open(['route' => 'product.store', 'method' => 'POST', 'files' => true, 'id' => 'formulario','class' => 'form-sample']) !!}

                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group row">
                                        {!! Form::label('name', 'Nombre') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre del Proveedor', 'id' => 'name']) !!}
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group">
                                        {!! Form::label('sell_price', 'Precio de Compra') !!}
                                        {!! Form::text('sell_price', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el PV', 'id' => 'shell_price']) !!}
                                        @error('sell_price')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6-col-lg-12">
                                    <div class="form-group">
                                        <label for="category_id">Categoría</label>
                                        <select class="form-control" name="category_id" id="category_id">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="provider_id">Proveedor</label>
                                        <select class="form-control" name="provider_id" id="provider_id">
                                            @foreach ($providers as $provider)
                                                <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                            @endforeach
                                            @error('provider_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6-col-lg-12">
                                    <div class="custom-file">
                                        <input type="file" name="image" id="image" class="custom-file-input" lang="es">
                                        <label for="image" class="custom-file-label">Seleccionar Archivo</label>
                                    </div>
                                    @error('image')
                                        <p class="text-danger">
                                            {{$message}}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group pt-2">
                                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                                        <a href="{{ route('product.index') }}" class="btn btn-light">Cancelar</a>
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
