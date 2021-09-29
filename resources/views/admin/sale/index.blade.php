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
                            <h4 class="card-title">
                                @can('sales.create')
                                    <a href="{{ route('sales.create') }}" class="btn btn-primary"> <i class="fas fa-plus"> Nueva Venta</i></a>
                                @endcan
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Cliente</th>
                                        <th>Fecha de Venta</th>
                                        @can('sale.change_status')
                                            <th>Estado</th>
                                        @endcan
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
                                            @can('sale.change_status')
                                                <td style="width: 50px;">
                                                    <a class="jsgrid-button btn btn-success" href="{{ route('sale.change_status', $sale) }}"> Valida<i class="fas fa-check"></i></a>
                                                </td>
                                            @endcan
                                            @else
                                            @can('sale.change_status')
                                                <td>
                                                    <a class="jsgrid-button btn btn-danger" href="{{ route('sale.change_status', $sale) }}"> Cancelada <i class="fas fa-times"></i></a>
                                                </td>
                                            @endcan
                                            @endif
                                            <td>{{ $sale->impuesto }}</td>
                                            <td>{{ $sale->total }}</td>
                                            <td style="width: 100px;">
                                                @can('sales.destroy','sales.show','sales.pdf','sales.print')
                                                    {!! Form::open(['route' => ['sales.destroy', $sale], 'method' => 'DELETE']) !!}
                                                        <div class="dropdown">
                                                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="{{ route('sales.show', $sale->id) }}" title="Ver Detalle"><i class="fas fa-eye"></i> Detalle</a>
                                                                <a class="dropdown-item" href="{{ route('sales.pdf', $sale->id) }}" title="Reporte PDF"><i class="fas fa-file-pdf"></i> Reporte PDF</a>
                                                                <a class="dropdown-item" href="{{ route('sales.print',$sale->id) }}" id="print" @if (isset($sale)) data-id="{{ $sale->id }}" @endif title="Imprimir"><i class="fas fa-print"></i> Imprimir Factura</a>
                                                                <a class="dropdown-item">
                                                                    <button class="jsgrid-button jsgrid-delete-button unstyled-button" type="submit" title="Anular Venta"><i class="far fa-trash-alt"></i> Anular Venta</button>
                                                                </a>
                                                            </div>
                                                        </div>
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
    {!! Html::script('admin/js/data-table.js') !!}
    {!! Html::script('admin/js/sweetalert2.js') !!}
    <script>
        $(document).ready(function(){
            function vista(response){
                const datos = response.data;
                let template = '', cabecera = datos.sale, detalle = datos.saleDetails;
                let id = '', cedula = '', address = '' , cliente = '',email = '',sale_date = '';

                cliente+=`${cabecera.nombre}`;
                id+=`${cabecera.id}`;
                address+=`${cabecera.address}`;
                email+=`${cabecera.email}`;
                sale_date+=`${cabecera.sale_date}`;
                cedula+=`${cabecera.cedula}`;

                $("#codigo").html(id);
                $("#cliente").html(cliente);
                $("#cedula").html(cedula);
                $("#email").html(email);
                $("#sale_date").html(sale_date);
                $("#address").html(address);
                /*detalle.forEach(elementos =>{

                });*/
            }
            $(document).on('click','#print',function(e){
                e.preventDefault();
                let id = $(this).data("id");
                $.ajax({
                    url: "{{route('sales.print',$sale->id)}}",
                    type: 'GET',
                    data: { id: id}
                }).done(function(response){
                    if(response.code == 200){
                        vista(response);
                        let WindowObject = window.open('admin.sale.print');
                        WindowObject.print();
                        WindowObject.focus();
                        WindowObject.print();
                        WindowObject.close();

                    }else{
                        toastr.error(response.message);
                        console.error(response.message);
                    }
                });
            });
        });
    </script>
@endsection
