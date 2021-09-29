@extends('layouts.admin')
@section('styles')
    <style type="text/css">
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Registro de Proveedores
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{route('providers.index')}}">Proveedores</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro Proveedor</h4>
                        </div>
                        {!! Form::open(['route' => 'providers.store','method' => 'POST','id' => 'formulario']) !!}
                            @include('admin.providers._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{!! Html::script('admin/js/sweetalert2.js') !!}
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
        function guardar(datos){
            $.ajax({
                url: "{{route('providers.store')}}",
                type: 'POST',
                data:datos,
                dataType: 'json',
                success:function(response){
                    if(response.code == 200){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.href="{{route('providers.index')}}"
                        },2500);
                    }else{
                        toastr.error(response.message);
                        console.error(response.message);
                    }
                },
                error:function(xhr, status, error){
                    $.each(xhr.responseJSON.errors, function (key, item)
                    {
                        $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                        setInterval(function(){
                            $("#errors").hide()
                        },7000)
                    });
                }
            });
        }
        $("#guardar").on("click",function(e){
            e.preventDefault();
            let formulario = $('#formulario').serialize();
            const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});
            swalWithBootstrapButtons.fire({
                title : 'Está seguro de crear un nuevo registro',
                'icon':'question',
                showCancelButton: true,
                confirmButtonText: 'Si, Guardar!',
                cancelButtonText: 'No, Cancelar!',
                reverseButtons: true
            }).then((result)=>{
                if (result.value) {
                    guardar(formulario);
                }
            });
        });
    });
</script>
@endsection
