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
                Detalle de Compra N° {{ $purchase->id }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Compras</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle de Compra N° {{ $purchase->id }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group row">
                                    <h4 class="text-primary">Proveedor:  {{ $purchase->provider->name }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group">
                                    <h4 class="card-title">Detalles de compra</h4>
                                    <div class="table-responsive col-md-12">
                                        <table id="detalles" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Precio $</th>
                                                    <th>Cantidad</th>
                                                    <th>SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3">
                                                        <p align="right">SubTotal</p>
                                                    </th>
                                                    <th>
                                                        <p align="right"><span id="total_impuesto">$ {{ number_format($subtotal,2) }}</span></p>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">
                                                        <p align="right">TOTAL:</p>
                                                    </th>
                                                    <th>
                                                        <p align="right">
                                                            <span align="right" id="total_pagar_html">$ {{ number_format($purchase->total,2) }}</span>
                                                        </p>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach ($purchaseDetails as $detail)
                                                    <tr>
                                                        <th>{{ $detail->product->name }}</th>
                                                        <th>{{ $detail->price }}</th>
                                                        <th>{{ $detail->cantidad }}</th>
                                                        <th>{{ number_format($detail->cantidad*$detail->price,2) }}</th>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{ route('purchases.index') }}" class="btn btn-primary float-right">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

