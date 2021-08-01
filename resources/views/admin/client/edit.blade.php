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
                Clientes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Cliente</h4>
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Actualizar Cliente</h4>
                                        </div>
                                        {!! Form::model($client, ['route'=>['client.update',$client->id],'method'=>'PUT','class'=> 'cmxform','id' => 'formulario-edit']) !!}
                                            @include('admin.client._form')
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/form-validation.js') !!}
    {!! Html::script('js/bt-maxLength.js') !!}
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
                    url: url,
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
                    if(response.code == 200){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.href="{{route('client.index')}}"
                        },3000);
                    }else{
                        toastr.error(response.message);
                        console.error(response.message);
                    }
                });
                request.fail(function(xhr, status, error){
                    $.each(xhr.responseJSON.errors, function (key, item) 
                    {
                        $("#errors").append("<p class='text-danger'>"+item+"</p>")
                    });
                });
            });
        });
    </script>
@endsection
