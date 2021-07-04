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
                Detalle de Venta N° {{ $sale->id }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle de Venta N° {{ $sale->id }}</li>
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
                                    <h4 class="text-primary">Cliente:  {{ $sale->client->name }}</h4>
                                </div>
                                <div class="form-group row">
                                    <h4 class="text-primary">Vendedor:  {{ $sale->user->name }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group">
                                    <h4 class="card-title">Detalles de Venta</h4>
                                    <div class="table-responsive col-md-12">
                                        <table id="detalles" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Precio Venta</th>
                                                    <th>Descuento</th>
                                                    <th>Cantidad</th>
                                                    <th>SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4">
                                                        <p align="right">Subtotal</p>
                                                    </th>
                                                    <th>
                                                        <p align="right"><span id="subtotal">$ {{ number_format($subtotal,2) }}</span></p>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4">
                                                        <p align="right">Total Impuesto {{$sale->impuesto}}%</p>
                                                    </th>
                                                    <th>
                                                        <p align="right"><span id="total_impuesto">$ {{ number_format($subtotal * 12/100,2) }}</span></p>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4">
                                                        <p align="right">TOTAL:</p>
                                                    </th>
                                                    <th>
                                                        <p align="right">
                                                            <span align="right" id="total_pagar_html">$ {{ number_format($sale->total,2) }}</span>
                                                        </p>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach ($saleDetails as $detail)
                                                    <tr>
                                                        <th>{{ $detail->product->name }}</th>
                                                        <th>{{ $detail->price }}</th>
                                                        <th>{{ $detail->descuento }}</th>
                                                        <th>{{ $detail->cantidad }}</th>
                                                        <th>{{ number_format($detail->cantidad*$detail->price - $detail->cantidad*$detail->price*$detail->descuento/100,2) }}</th>
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
                        <a href="{{ route('sales.index') }}" class="btn btn-primary float-right">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

