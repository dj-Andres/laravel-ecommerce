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
                        <a href="{{ route('client.index') }}" class="btn btn-secondary float-right">
                            Regresar
                        </a>
                        <button type="button" class="btn btn-primary float-right mr-1" data-toggle="modal"
                            data-target="#staticBackdrop">Nuevo Cliente</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@include('admin.client._modal')
