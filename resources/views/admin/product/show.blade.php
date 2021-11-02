@extends('layouts.admin')
@section('styles')
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
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Información de Producto</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong><i class="far fa-money-bill-alt mr-1"></i> Precio de Compra</strong>
                                <div class="form-group">
                                    <p class="text-muted">
                                        {{ $product->sell_price }}
                                    </p>
                                </div>
                                <strong><i class="far fa-money-bill-alt mr-1"></i> Descripción</strong>
                                <div class="form-group">
                                    <p class="text-muted">
                                        {{ $product->long_description }}
                                    </p>
                                </div>
                                <strong><i class="far fa-money-bill-alt mr-1"></i> Proveedor</strong>
                                <div class="form-group">
                                    <p class="text-muted">
                                        {{ $product->proveedor }}
                                    </p>
                                </div>
                                <strong><i class="far fa-money-bill-alt mr-1"></i> Sub Categoria</strong>
                                <div class="form-group">
                                    <p class="text-muted">
                                        {{ $product->sub_category }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong><i class="fas fa-barcode mr-1"></i> Código de barras</strong>
                                <p class="text-muted">
                                    {!! DNS1D::getBarcodeHTML($product->code, 'EAN13'); !!}
                                    {{ $product->code }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('admin.product.partial._galery')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <a href="{{ route('product.index') }}" class="btn btn-primary float-right">
                        Regresar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
