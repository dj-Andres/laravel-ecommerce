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
                Configuración de Impresora
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Configuración de Impresora</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Información de la Configuración de Impresora</h4>
                        </div>
                        <div class="form-group">
                            <strong><i class="fas fa-file-signature mr-1"></i> Nombre </strong>
                            <p class="text-muted">
                                {{$printer->name}}
                            </p>
                            <hr>
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
{!! Html::script('js/dropify.js') !!}
@endsection

@include('admin.printer._modal')

