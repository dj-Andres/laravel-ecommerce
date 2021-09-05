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
                Compras
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Compras</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Compras
                                @can('purchases.create')
                                    <a href="{{ route('purchases.create') }}" class="btn btn-primary">Crear Nueva</a>
                                @endcan
                            </h4>
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Proveedor</th>
                                        <th>Fecha de Compra</th>
                                        @can('purchase.change_status')
                                            <th>Estado</th>
                                        @endcan
                                        <th>Impuesto</th>
                                        <th>Total</th>
                                        <th style="width: 5px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                        <tr>
                                            <th scope="row">{{ $purchase->compra_id }}</th>
                                            <td>{{ $purchase->proveedor }}</td>
                                            <td>{{ $purchase->purchase_date }}</td>
                                            @if ($purchase->status === 'VALID')
                                                @can('purchase.change_status')
                                                    <td style="width: 50px;">
                                                        <a class="jsgrid-button btn btn-success" href="{{ route('purchase.change_status', $purchase->compra_id) }}"> Valida<i class="fas fa-check"></i></a>
                                                    </td>
                                                @endcan
                                            @else
                                                @can('purchase.change_status')
                                                    <td style="width: 50px;">
                                                        <a class="jsgrid-button btn btn-danger" href="{{ route('purchase.change_status', $purchase->compra_id) }}"> Cancelada <i class="fas fa-times"></i></a>
                                                    </td>
                                                @endcan
                                            @endif
                                            <td>{{ $purchase->impuesto }}</td>
                                            <td>{{ number_format($purchase->total,2) }}</td>
                                            <td style="width: 100px;">
                                            @can('purchases.destroy','purchases.pdf','purchases.show')
                                                {!! Form::open(['route' => ['purchases.destroy', $purchase], 'method' => 'DELETE']) !!}
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{ route('purchases.show', $purchase->compra_id) }}" title="Ver Detalle">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{ route('purchases.pdf', $purchase->compra_id) }}" title="Reporte PDF">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <button class="jsgrid-button jsgrid-delete-button unstyled-button" type="submit" title="Anular Compra"><i class="far fa-trash-alt"></i></button>
                                                {!! Form::close() !!}
                                            @endcan
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
