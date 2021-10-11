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
                            <h4 class="card-title">
                                @can('purchases.create')
                                    <a href="{{ route('purchases.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nueva Compra</a>
                                @endcan
                            </h4>
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
                                        <tr id="{{ $purchase->compra_id }}">
                                            <th scope="row">{{ $purchase->compra_id }}</th>
                                            <td>{{ $purchase->proveedor }}</td>
                                            <td>{{ $purchase->purchase_date }}</td>
                                            @if ($purchase->status === 'VALID')
                                                @can('purchase.change_status')
                                                    <td style="width: 50px;">
                                                        <a class="status jsgrid-button btn btn-success" href="{{ route('purchase.change_status', $purchase->compra_id) }}" @if(isset($purchase)) data-id="{{ $purchase->compra_id }}" @endif @if(isset($purchase)) data-status="{{ $purchase->status }}" @endif> Valida<i class="fas fa-check"></i></a>
                                                    </td>
                                                @endcan
                                            @else
                                                @can('purchase.change_status')
                                                    <td style="width: 50px;">
                                                        <a class="status jsgrid-button btn btn-danger" href="{{ route('purchase.change_status', $purchase->compra_id) }}" @if(isset($purchase)) data-id="{{ $purchase->compra_id }}" @endif @if(isset($purchase)) data-status="{{ $purchase->status }}" @endif> Cancelada <i class="fas fa-times"></i></a>
                                                    </td>
                                                @endcan
                                            @endif
                                            <td>{{ $purchase->impuesto }}</td>
                                            <td>{{ number_format($purchase->total,2) }}</td>
                                            <td style="width: 100px;">
                                            @can('purchases.destroy','purchases.pdf','purchases.show')
                                            {!! Form::open(['route' => ['purchases.destroy', $purchase->compra_id], 'method' => 'DELETE']) !!}
                                                <meta name="_token" content="{!! csrf_token() !!}"/>
                                                <div class="dropdown">
                                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="{{ route('purchases.edit', $purchase->compra_id) }}"><i class="far fa-edit"></i> Actualizar</a>
                                                        <a class="dropdown-item" href="{{ route('purchases.show', $purchase->compra_id) }}"><i class="fas fa-eye"></i> Detalle</a>
                                                        <a class="dropdown-item" href="{{ route('purchases.pdf', $purchase->compra_id) }}"><i class="fas fa-file-pdf"></i> Exportar PDF</a>
                                                        <a class="dropdown-item" href="#">
                                                            <button class="jsgrid-button jsgrid-delete-button unstyled-button" id="delete-compra" type="submit" title="Anular Compra" @if(isset($purchase)) data-id="{{ $purchase->compra_id }}" @endif><i class="far fa-trash-alt"></i> Anular Compra</button>
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
            $.ajaxSetup({headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}});
            $("body").on("click","#delete-compra",function(e){
                e.preventDefault();
                let id = $(this).data("id"),name = $(this).data("name");
                const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});
                swalWithBootstrapButtons.fire({
                    title : 'Está seguro de anular la Compra con Codigo:' +name,
                    'icon':'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Eliminar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result)=>{
                    if(result.value){
                        $.ajax({
                            url: "{{route('purchases.destroy',isset($purchase))}}",
                            type: 'POST',
                            data: {
                                id: id,
                                _method:'DELETE'
                            }
                        }).done(function(response){
                            if(response.code == 200){
                                toastr.success(response.message);
                                $('#'+id).remove();
                            }else{
                                toastr.error(response.message);
                                console.error(response.message);
                            }
                        });
                    }else if(result.dismiss === Swal.DismissReason.cancel){
                        swalWithBootstrapButtons.fire('Cancelar','La Compra con Codigo :'+id+' no se elimino','error');
                    }
                });
                return false;
            });
            $(document).on('click','.status',function(e){
                let id = $(this).data("id");
                let status = $(this).data("status");
                e.preventDefault();
                const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});
                swalWithBootstrapButtons.fire({
                    title : 'Está seguro de Cambiar el Estado de la Compra con el Codigo:' +id,
                    'icon':'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Eliminar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result)=>{
                    if(result.value){
                        $.ajax({
                            url: "{{route('purchase.change_status',isset($purchase))}}",
                            type: 'GET',
                            data: {
                                id: id,
                                status:status
                            }
                        }).done(function(response){
                            if(response.code == 200){
                                toastr.success(response.message);
                            }else{
                                toastr.error(response.message);
                                console.error(response.message);
                            }
                        });
                    }else if(result.dismiss === Swal.DismissReason.cancel){
                        swalWithBootstrapButtons.fire('Cancelar','La Compra con Codigo :'+id+' no se elimino','error');
                    }
                });
            });
        });
    </script>
@endsection
