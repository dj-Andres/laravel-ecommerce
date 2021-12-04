@extends('layouts.admin')
@section('styles')
    <style type="text/css">
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
            <x-card title="Registro Cliente">
                {!! Form::open(['route' => 'client.store', 'method' => 'POST', 'id' => 'formulario', 'class' => 'cmxform']) !!}
                    @include('admin.client._form')
                {!! Form::close() !!}
            </x-card>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('admin/js/sweetalert2.js') !!}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            function guardar(datos) {
                const request = $.ajax({
                    url: "{{ route('profile.store') }}",
                    type: 'POST',
                    data: datos
                });
                request.done(function(response) {
                    if (response.code == 200) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = "{{ route('profile.index') }}"
                        }, 3000);
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
            $("#guardar").on("click", function(e) {
                e.preventDefault();
                let cedula = $("#cedula").val().trim();
                let formulario = $('#formulario').serialize();
                let total = 0;
                let longitud = cedula.length;
                let longcheck = longitud - 1;

                if (cedula !== "" && longitud === 10) {
                    for (i = 0; i < longcheck; i++) {
                        if (i % 2 === 0) {
                            let aux = cedula.charAt(i) * 2;
                            if (aux > 9) aux -= 9;
                            total += aux;
                        } else {
                            total += parseInt(cedula.charAt(i));
                        }
                    }
                    total = total % 10 ? 10 - (total % 10) : 0;
                    if (cedula.charAt(longitud - 1) == total) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger mr-1'
                            },
                            buttonsStyling: false
                        });
                        swalWithBootstrapButtons.fire({
                            title: 'Está seguro de crear un nuevo registro',
                            'icon': 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Si, Guardar!',
                            cancelButtonText: 'No, Cancelar!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.value) {
                                guardar(formulario);
                            }
                        });
                    } else {
                        $("#aviso").show();
                        $("#aviso").text("Cedula invalida");
                    }
                }
            });
        });
    </script>
@endsection
