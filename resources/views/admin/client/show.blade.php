@extends('layouts.admin')
@section('styles')
    <style type="text/css">
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ $client->name }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('client.index') }}">Cliente</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $client->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="border-bottom text-center pb-4">
                                    <h3>{{ $client->name }}</h3>
                                    <div class="d-flex justify-content-between">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 pl-lg-5">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>Información de Cliente</h4>
                                    </div>
                                </div>
                                <div class="profile-feed">
                                    <div class="d-flex align-items-start profile-feed-item">
                                        <div class="form-group col-md-6">
                                            <strong><i class="fab fa-client-hunt mr-1"></i> Cedula de Identidad</strong>
                                            <p class="text-muted">
                                                {{ $client->cedula }}
                                            </p>
                                            <hr>
                                            <strong>
                                                <i class="fas fa-mobile mr-1"></i>
                                                Ruc
                                            </strong>
                                            <p class="text-muted">
                                            <p>{{ $client->ruc }}</p>
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-envelope mr-1"></i> Dirección</strong>
                                            <p class="text-muted">
                                                {{ $client->address }}
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-map-marked-alt mr-1"></i> Telefono</strong>
                                            <p class="text-muted">
                                                {{ $client->phone }}
                                            </p>
                                            <strong><i class="fas fa-map-marked-alt mr-1"></i> Email</strong>
                                            <p class="text-muted">
                                                {{ $client->email }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{ route('client.index') }}" class="btn btn-info float-right">
                            Regresar
                        </a>
                        <button class="btn btn-primary float-right mr-1" id="cliente" type="button" title="Agregar Cliente">Nuevo Cliente<i class="fas fa-user-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@include('components._modal_cliente')
@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            $("#cliente").on('click',function(e){
                e.preventDefault();
                $("#cliente-registro").modal('show');
            });
            function guardar(datos) {
                const request = $.ajax({
                        url: "{{ route('client.store') }}",
                        type: 'POST',
                        data:datos
                    });
                    request.done(function(response) {
                        if(response.code == 200){
                            toastr.success(response.message);
                            setTimeout(function(){
                                $("#cliente-registro").modal('hide');
                            },1500);
                        }else{
                            toastr.error(response.message);
                            console.error(response.message);
                        }
                    });
                    request.fail(function(xhr, status, error){
                        $.each(xhr.responseJSON.errors, function (key, item)
                        {
                            $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                            setInterval(function(){
                                $("#errors").hide()
                            },7000)
                        });
                    });
            }
            $("#guardar-client").on("click",function(e){
                e.preventDefault();
                let datos = $("#formulario-cliente").serialize();
                guardar(datos);
            });
        });
    </script>
@endsection
