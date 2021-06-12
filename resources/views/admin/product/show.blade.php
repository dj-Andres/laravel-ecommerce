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
                {{ $product->name }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{route('product.index')}}">Producto</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="border-bottom text-center pb-4">
                                    <h3>{{ $product->name }}</h3>
                                    <div class="d-flex justify-content-between">
                                    </div>
                                </div>
                                <div class="border-bottom py-4">
                                    <div class="list-group">
                                        <img src="{{asset('images/productos'.$product->image)}}" alt="Producto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 pl-lg-5">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>Información de Producto</h4>
                                    </div>
                                </div>
                                <div class="profile-feed">
                                    <div class="d-flex align-items-start profile-feed-item">
                                        <div class="form-group col-md-6">
                                            <strong><i class="fab fa-product-hunt mr-1"></i> Precio de Compra</strong>
                                            <p class="text-muted">
                                                {{ $product->sell_price }}
                                            </p>
                                            <hr>
                                            <strong>
                                                <i class="fas fa-mobile mr-1"></i>
                                                 Estado
                                            </strong>
                                            <p class="text-muted">
                                                @if ($product->status === 'ACTIVE')
                                                    <p class="text-success">Activo</p>    
                                                @endif
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-envelope mr-1"></i> Porveedor</strong>
                                            <p class="text-muted">
                                                {{ $product->proveedor }}
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-map-marked-alt mr-1"></i> Categoria</strong>
                                            <p class="text-muted">
                                                {{ $product->categoria }}
                                            </p>
                                            <a href="{{route('product.create')}}">Nuevo Producto</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{ route('product.index') }}" class="btn btn-primary float-right">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    {!! Html::script('js/data-table.js') !!}
@endsection
