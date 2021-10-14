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
                    <li class="breadcrumb-item"><a href="{{ route('home')}}">Panel administrador</a></li>
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
                                        <img src="{{asset('images/productos/'.$product->image)}}" alt="{{ $product->name }}" class="img-lg  mb-3" />
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
                                            <strong><i class="far fa-money-bill-alt mr-1"></i> Precio de Compra</strong>
                                            <p class="text-muted">
                                                {{ $product->sell_price }}
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-barcode mr-1"></i> Código de barras</strong>
                                            <p class="text-muted">
                                                {!! DNS1D::getBarcodeHTML($product->code, 'EAN13'); !!}
                                                {{ $product->code }}
                                            </p>
                                            <hr>
                                            <strong>
                                                <i class="fas fa-thermometer-empty mr-1"></i>
                                                 Estado
                                            </strong>
                                            <p class="text-muted">
                                                @if ($product->status === 'ACTIVE')
                                                    <a href="{{route('change.status.product', $product)}}" class="btn btn-warning btn-block">Activo</a>
                                                @else
                                                    <a href="{{route('change.status.product', $product)}}" class="btn btn-danger btn-block">Inactivo</a>
                                                @endif
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-envelope mr-1"></i> Proveedor</strong>
                                            <p class="text-muted">
                                                <a class="bnt btn-link" href="{{route('providers.show',$product->provider_id)}}">
                                                    {{ $product->proveedor }}
                                                </a>
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-map-marked-alt mr-1"></i> Categoria</strong>
                                            <p class="text-muted">
                                                {{ $product->categoria }}
                                            </p>
                                            <a href="{{route('product.create')}}" class="btn btn-success">Nuevo Producto</a>
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
