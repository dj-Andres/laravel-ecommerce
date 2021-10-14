@extends('layouts.admin')
@section('styles')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Registro de Roles
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <x-card title="Registro Roles">
                {!! Form::open(['route' => 'roles.store','method' => 'POST','id' => 'formulario']) !!}
                    @include('admin.role._form')
                {!! Form::close() !!}
            </x-card>
        </div>
    </div>
@endsection
@section('scripts')
{!! Html::script('admin/js/data-table.js') !!}
{!! Html::script('admin/js/sweetalert2.js') !!}
<script>
    $(document).ready(function(){
        $.ajaxSetup({headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}});
        const createRole = (datos) => {
            $.ajax({
                url: "{{route('roles.store')}}",
                type: 'POST',
                data:datos
            }).done(function(response){
                if(response.code == 200){
                    toastr.success(response.message);
                    setTimeout(function() {
                        window.location.href = "{{ route('roles.index') }}";
                    },1500)
                }else{
                    toastr.error(response.message);
                    console.error(response.message);
                }
            }).fail(function(xhr, status, error){
                $.each(xhr.responseJSON.errors, function (key, item)
                {
                    $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                    setInterval(function(){
                        $("#errors").hide()
                    },1500)
                });
            });
        }
        $("#formulario").submit((e)=>{
            e.preventDefault();
            let datos = $("#formulario").serialize();
            const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});
            swalWithBootstrapButtons.fire({
                title : 'Está seguro de crear un nuevo registro',
                'icon':'question',
                showCancelButton: true,
                confirmButtonText: 'Si, Guardar!',
                cancelButtonText: 'No, Cancelar!',
                reverseButtons: true
            }).then((result)=>{
                if (result.value) {createRole(datos);}
            });
        });
    });
</script>
@endsection
