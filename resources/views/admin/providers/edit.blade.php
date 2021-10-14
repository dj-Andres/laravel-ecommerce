@extends('layouts.admin')
@section('styles')
    <style type="text/css">
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Actualizar Proveedores
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <x-card title="Actualizar Proveedor">
                {!! Form::model($provider, ['route' => ['providers.update', $provider->id], 'method' => 'PUT']) !!}
                @include('admin.providers._form')
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

            function editar(id, name, email, ruc_number, address, phone) {
                $.ajax({
                    url: "{{ route('providers.update', $provider->id) }}",
                    type: 'POST',
                    data: {
                        id: id,
                        name,
                        email,
                        ruc_number,
                        address,
                        phone,
                        _method: 'PUT'
                    },
                    success: function(response) {
                        if (response.code == 200) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                window.location.href = "{{ route('providers.index') }}"
                            }, 2500);
                        } else {
                            toastr.error(response.message);
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        $.each(xhr.responseJSON.errors, function(key, item) {
                            $("#errors").append("<li class='alert alert-danger'>" + item +
                                "</li>")
                            setInterval(function() {
                                $("#errors").hide()
                            }, 7000)
                        });
                    }
                });
            }
            $("#guardar").on("click", function(e) {
                e.preventDefault();
                let id = $(this).data("id");
                let name = $('#name').val(),
                    email = $('#email').val(),
                    ruc_number = $('#ruc_number').val(),
                    address = $('#address').val(),
                    phone = $('#phone').val(),
                    formulario = $('#formulario').serialize();
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger mr-1'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: 'Está seguro de actualizar el registro',
                    'icon': 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Guardar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        editar(id, name, email, ruc_number, address, phone);
                    }
                });
            });
        });
    </script>
@endsection
