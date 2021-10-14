@extends('layouts.admin')
@section('styles')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Editar Usuarios
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <x-card title="Editar Usuario">
                {!! Form::model($user, ['route'=>['users.update',$user->id],'method'=>'PUT','id' => 'formulario']) !!}
                    @include('admin.users._form')
                {!! Form::close() !!}
            </x-card>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('admin/js/sweetalert2.js') !!}
<script>
    $(document).ready(function(){
        $.ajaxSetup({headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}});
        const editUser = (id,name,email,password) => {
            $.ajax({
                url: "{{ route('users.update', $user->id) }}",
                type: 'POST',
                data: {
                    id,
                    name,
                    email,
                    password,
                    _method: 'PUT'
                },
                success: function(response) {
                    if (response.code == 200) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = "{{ route('users.index') }}"
                        }, 2500);
                    } else {
                        toastr.error(response.message);
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(key, item) {
                        $("#errors").append("<li class='alert alert-danger'>" + item + "</li>");
                        setInterval(function() {
                            $("#errors").hide()
                        }, 7000)
                    });
                }
            });
        }
        $("#formulario").submit((e) => {
                e.preventDefault();
                let id = $("#user_id").val();
                let name = $("#name").val();
                let email = $("#email").val();
                let password = $("#password").val();
                let roles = $("#roles").val();

                const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});
                swalWithBootstrapButtons.fire({
                    title : 'Está actualizar el registro',
                    'icon':'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Guardar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result)=>{
                    if (result.value) {
                        console.log(id,name,email,password,roles);
                    }
                });
            });
    });
</script>
@endsection
