@extends('layouts.admin')
@section('styles')

@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ $category->name }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categoria</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Información de la Categoria: {{ $category->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @foreach ($subcateries as $subcategory)
                                <span class="badge badge-primary">{{ $subcategory->name }}</span>
                            @endforeach
                        </div>
                        <div class="col-md-12 mt-2">
                            <textarea class="form-control" rows="5">{{ $category->description }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{ route('categories.index') }}" class="btn btn-info float-right">
                            Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
