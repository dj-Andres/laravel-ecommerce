@extends('layouts.admin')
@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }

        .error {
            color: #FF0000;
            padding-top: 2px;
        }

        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            border-radius: 7px;
            border: 2px solid blueviolet;
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Registro de Clientes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('client.index') }}">Clientes</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro Cliente</h4>
                        </div>
                        {!! Form::open(['route' => 'client.store', 'method' => 'POST', 'id' => 'formulario', 'class' => 'cmxform']) !!}
                        @include('admin.client._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/form-validation.js') !!}
    {!! Html::script('js/bt-maxLength.js') !!}
    {!! Html::script('js/toastr.min.js') !!}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            $("#guardar").on("click",function(e){
                e.preventDefault();
                let name = $("#name").val();
                let cedula = $("#cedula").val();
                let ruc = $("#ruc").val();
                let address = $("#address").val();
                let phone = $("#phone").val();
                let email = $("#email").val();

                const request = $.ajax({
                    url: "{{ route('client.store') }}",
                    type: 'POST',
                    data:{
                        name:name,
                        cedula:cedula,
                        ruc:ruc,
                        address:address,
                        phone:phone,
                        email:email,
                    }                
                });
                request.done(function(response) {
                    toastr.success(response.message);
                    setTimeout(function(){
                        window.location.href="{{route('client.index')}}"
                    },3000);
                });
            });
        });
    </script>
@endsection
