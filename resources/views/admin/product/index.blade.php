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
                Productos
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Productos</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">
                                @can('product.create')
                                    <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Producto</a>
                                @endcan
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        @can('change.status.product')
                                            <th>Estado</th>
                                        @endcan
                                        <th>Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr id="{{ $product->id }}">
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>
                                                <a href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
                                            </td>
                                            <td>{{ $product->stock }}</td>
                                            @if ($product->status == 'ACTIVE')
                                                @can('change.status.product')
                                                    <td>
                                                        <a class="status jsgrid-button btn btn-success" href="{{ route('change.status.product', $product) }}" @if(isset($product)) data-id="{{ $product->id }}" @endif> Activo <i class="fas fa-check"></i></a>
                                                    </td>
                                                @endcan
                                            @else
                                                @can('change.status.product')
                                                    <td>
                                                        <a class="status jsgrid-button btn btn-danger" href="{{ route('change.status.product', $product) }}" @if(isset($product)) data-id="{{ $product->id }}" @endif>Desactivado <i class="fas fa-times"></i></a>
                                                    </td>
                                                @endcan
                                            @endif
                                            <td>{{ $product->categoria }}</td>
                                            <td style="width: 50px;">
                                                @can('product.destroy','product.edit')
                                                    {!! Form::open(['route' => ['product.destroy', $product], 'method' => 'DELETE']) !!}
                                                    <meta name="_token" content="{!! csrf_token() !!}"/>
                                                    <a class="jsgrid-button jsgrid-edit-button" href="{{ route('product.edit', $product) }}" title="Editar"><i class="far fa-edit"></i></a>
                                                    <button class="jsgrid-button jsgrid-delete-button unstyled-button" id="delete" type="submit" title="Eliminar" @if(isset($product)) data-id="{{ $product->id }}" @endif @if(isset($product)) data-name="{{ $product->name }}" @endif>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
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
    {!! Html::script('js/sweetalert2.js') !!}
    <script>
        $.ajaxSetup({headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}});
        $("body").on("click","#delete",function(e){
           e.preventDefault();
           let id = $(this).data("id"),name = $(this).data("name");
           const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});
           swalWithBootstrapButtons.fire({
                title : 'Está seguro de anular el Producto:' +name,
                'icon':'question',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'No, Cancelar!',
                reverseButtons: true
            }).then((result)=>{
                if(result.value){
                    $.ajax({
                        url: "{{route('product.destroy',$product)}}",
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
                    swalWithBootstrapButtons.fire('Cancelar','El Poroducto :'+name+' no se elimino','error');
                }
            });
            return false;
        });
    </script>
@endsection
