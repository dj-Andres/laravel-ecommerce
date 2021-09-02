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
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Producto
                                <a href="{{ route('product.create') }}" class="btn btn-primary">Crear Nuevo</a>
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
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        <th>Estado</th>
                                        <th>Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>
                                                <a href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
                                            </td>
                                            <td>{{ $product->stock }}</td>

                                            @if ($product->status == 'ACTIVE')
                                                <td>
                                                    <a class="jsgrid-button btn btn-success" href="{{ route('change.status.product', $product) }}"> Activo <i class="fas fa-check"></i></a>
                                                </td>
                                            @else
                                                <td>
                                                  <a class="jsgrid-button btn btn-danger" href="{{ route('change.status.product', $product) }}">Desactivado <i class="fas fa-times"></i></a>
                                                </td>
                                            @endif

                                            <td>{{ $product->categoria }}</td>
                                            <td style="width: 50px;">
                                                {!! Form::open(['route' => ['product.destroy', $product], 'method' => 'DELETE']) !!}
                                                <a class="jsgrid-button jsgrid-edit-button"
                                                    href="{{ route('product.edit', $product) }}" title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <button class="jsgrid-button jsgrid-delete-button unstyled-button"
                                                    type="submit" title="Eliminar">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
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
