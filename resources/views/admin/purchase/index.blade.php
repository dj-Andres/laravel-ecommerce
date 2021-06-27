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
                    <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Panel administrador</a></li>
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
                                <a href="{{route('purchases.create')}}" class="btn btn-primary">Crear Nueva</a>
                            </h4>
                            {{--  <i class="fas fa-ellipsis-v"></i>  --}}
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                  {{--  <button class="dropdown-item" type="button">Another action</button>
                                  <button class="dropdown-item" type="button">Something else here</button>  --}}
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
                                        <th>Estado</th>
                                        <th>Impuesto</th>
                                        <th>Total</th>
                                        <th style="width: 5px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                    <tr>
                                        <th scope="row">{{$purchase->compra_id}}</th>
                                        <td>{{$purchase->proveedor}}</td>
                                        <td>{{$purchase->purchase_date}}</td>
                                        @if ($purchase->status === 'VALID')
                                            <td><span class="badge badge-success">VALIDA</span></td>
                                        @endif
                                        <td>{{$purchase->impuesto}}</td>
                                        <td>{{$purchase->total}}</td>
                                        <td style="width: 50px;">        
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{route('purchases.show', $purchase->compra_id)}}" title="Ver Detalle">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="jsgrid-button jsgrid-edit-button" title="Reporte PDF">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <a class="jsgrid-button jsgrid-edit-button" title="Imprimir">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            {{--{!! Form::open(['route'=>['purchases.destroy',$purchase], 'method'=>'DELETE']) !!}
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{route('purchases.edit', $purchase)}}" title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <button class="jsgrid-button jsgrid-delete-button unstyled-button" type="submit" title="Anular Compra">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            {!! Form::close() !!}--}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{--  <div class="card-footer text-muted">
                        {{$purchase->render()}}
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{!! Html::script('js/data-table.js') !!}
@endsection
