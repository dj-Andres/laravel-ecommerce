@extends('layouts.admin')
@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }
        .error{
            color: #FF0000;
            padding-top: 2px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Registro de Proveedores
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{route('providers.index')}}">Proveedores</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro Proveedor</h4>
                        </div>
                        
                        {!! Form::open(['route' => 'providers.store','method' => 'POST','id' => 'formulario']) !!}
                            @include('admin.providers._form')
                            <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                            <a href="{{ route('providers.index')}}" class="btn btn-light">Cancelar</a>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/jquery.validate.min.js') !!}
  <script>
      $(document).ready(function(){
        $("#formulario").validate({
            error:function(label){
                $(this).addClass('error');
            },
            rules:{
                name:{ required: true, minlength: 2, maxlength:250},
                email:{required:true,email:true,maxlength:200}
            },
            messages:{
                name :{required:'El campo es requerido',minlength:'Debe tener minimo 2 caracteres',maxlength:'El numero maximo de caracteres es de 250'},
                email:{required:'El campo es requerido',email:'El formato no es valido',maxlength:'El numero maximo de caracteres es 200'}
            }
        });
      });
  </script>
@endsection
