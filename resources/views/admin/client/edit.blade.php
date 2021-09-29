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
                Clientes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Cliente</h4>
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title">Actualizar Cliente</h4>
                                        </div>
                                        {!! Form::model($client, ['route'=>['client.update',$client->id],'method'=>'PUT','class'=> 'cmxform','id' => 'formulario-edit']) !!}
                                            @include('admin.client._form')
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
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
        function editar(id,name,email,ruc,address,phone,cedula){
            $.ajax({
                url: "{{route('client.update',$client->id)}}",
                type: 'POST',
                data:{
                    id:id,
                    name,
                    cedula,
                    email,
                    ruc,
                    address,
                    phone,
                    _method:'PUT'
                },
                success:function(response){
                    if(response.code == 200){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.href="{{route('client.index')}}"
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
            let id = $(this).data("id");
            let name = $('#name').val(),email=$('#email').val(),ruc=$('#ruc').val(),address=$('#address').val(),phone=$('#phone').val(),cedula=$('#cedula').val();

            const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});
            swalWithBootstrapButtons.fire({
                title : 'Está seguro de actualizar el registro',
                'icon':'question',
                showCancelButton: true,
                confirmButtonText: 'Si, Guardar!',
                cancelButtonText: 'No, Cancelar!',
                reverseButtons: true
            }).then((result)=>{
                if (result.value) {
                    editar(id,name,email,ruc,address,phone,cedula);
                }
            });
        });
    });
</script>
@endsection