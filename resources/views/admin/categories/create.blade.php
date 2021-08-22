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
                Registro de Categorias
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro Categorías</h4>
                        </div>

                        {!! Form::open(['route' => 'categories.store', 'method' => 'POST', 'id' => 'formulario']) !!}
                        @include('admin.categories._form')
                        <button type="submit" id="guardar" class="btn btn-primary mr-2">Guardar</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-light">Cancelar</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/data-table.js') !!}
    <script>
        $(document).ready(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });

            function guardar(name, description) {
                const request = $.ajax({
                    url: "{{ route('categories.store') }}",
                    type: 'POST',
                    data: {
                        name: name,
                        description: description
                    }
                });
                request.done(function(response) {
                    if (response.code == 200) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = "{{ route('categories.index') }}";
                        }, 3000)
                    } else {
                        toastr.error(response.message);
                        console.error(response.message);
                    }
                });
                request.fail(function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(key, item) {
                        $("#errors").append("<li class='alert alert-danger'>" + item + "</li>")
                        setInterval(function() {
                            $("#errors").hide()
                        }, 7000)
                    });
                });
            }
            $("#formulario").submit((e) => {
                let name = $("#name").val();
                let description = $("#description").val();
                guardar(name, description);
                e.preventDefault();
            });
        });
    </script>
@endsection
