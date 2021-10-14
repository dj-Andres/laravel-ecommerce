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
                Editar Role
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Role</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <x-card title="Editar Rol">
                {!! Form::model($role, ['route'=>['roles.update',$role->id],'method'=>'PUT']) !!}
                    @include('admin.role._form')
                {!! Form::close() !!}
            </x-card>
        </div>
    </div>
@endsection
@section('scripts')
{!! Html::script('admin/js/data-table.js') !!}
@endsection
