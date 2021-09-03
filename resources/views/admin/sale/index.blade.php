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
                Ventas
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ventas</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Ventas
                                <a href="{{ route('sales.create') }}" class="btn btn-primary">Crear Nueva</a>
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
                                        <th>Cliente</th>
                                        <th>Fecha de Venta</th>
                                        <th>Estado</th>
                                        <th>Impuesto</th>
                                        <th>Total</th>
                                        <th style="width: 5px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <th scope="row">{{ $sale->id }}</th>
                                            <td>{{ $sale->name }}</td>
                                            <td>{{ $sale->sale_date }}</td>
                                            @if ($sale->status === 'VALID')
                                                <td style="width: 50px;">
                                                    <a class="jsgrid-button btn btn-success" href="{{ route('sale.change_status', $sale) }}"> Valida<i class="fas fa-check"></i></a>
                                                </td>
                                            @else
                                                <td>
                                                    <a class="jsgrid-button btn btn-danger" href="{{ route('sale.change_status', $sale) }}"> Cancelada <i class="fas fa-times"></i></a>
                                                </td>
                                            @endif
                                            <td>{{ $sale->impuesto }}</td>
                                            <td>{{ $sale->total }}</td>
                                            <td style="width: 100px;">
                                                {!! Form::open(['route' => ['sales.destroy', $sale], 'method' => 'DELETE']) !!}
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{ route('sales.show', $sale->id) }}" title="Ver Detalle"><i class="fas fa-eye"></i></a>
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{ route('sales.pdf', $sale->id) }}" title="Reporte PDF"><i class="fas fa-file-pdf"></i></a>
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{ route('sales.print',$sale->id) }}" id="print" title="Imprimir"><i class="fas fa-print"></i></a>
                                                <button class="jsgrid-button jsgrid-delete-button unstyled-button" type="submit" title="Anular Compra"><i class="far fa-trash-alt"></i></button>
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
