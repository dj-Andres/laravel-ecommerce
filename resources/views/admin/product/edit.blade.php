@extends('layouts.admin')
@section('styles')
    <style type="text/css">
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
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Producto</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Producto</h4>
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                </div>
                              </div>
                        </div>

                        {!! Form::model($product, ['route'=>['product.update',$product->id],'method'=>'PUT']) !!}
                            @include('admin.product._form')
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group pt-2">
                                        <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                                        <a href="{{ route('product.index') }}" class="btn btn-light">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/dropify.js') !!}
    {!! Html::script('js/sweetalert2.js') !!}
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
@endsection
