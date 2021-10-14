@extends('layouts.admin')
@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ $role->name }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $role->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Información del Rol: {{ $role->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="text-title">Rol: {{ $role->name }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-title">Plataforma: {{ $role->guard_name }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @foreach ($permissions as $permission)
                                    <span class="badge badge-success mb-2">{{ $permission }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{ route('roles.index') }}" class="btn btn-primary float-right">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
