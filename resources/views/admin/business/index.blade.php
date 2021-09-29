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
                Empresa
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Empresa</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Información de la Empresa</h4>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <strong><i class="fas fa-file-signature mr-1"></i> Nombre </strong>
                                <p class="text-muted">
                                    {{ $business->name }}
                                </p>
                                <hr>
                                <strong><i class="fas fa-align-left mr-1"></i> Descripción</strong>
                                <p class="text-muted">
                                    {{ $business->description }}
                                </p>
                                <hr>
                                <strong><i class="fas fa-map-marked-alt mr-1"></i> Dirección</strong>
                                <p class="text-muted">
                                    {{ $business->address }}
                                </p>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong><i class="fas fa-exclamation-circle mr-1"></i> Logo</strong><br>
                                    </div>
                                    <div class="col-md-6">
                                        <img style="width:50px ; height:50px ;" src="{{asset('images/business/'.$business->logo)}}"
                                            class="rounded float-left" alt="logo">
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal-2">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
{!! Html::script('admin/js/dropify.js') !!}
@endsection

@include('admin.business._modal')
