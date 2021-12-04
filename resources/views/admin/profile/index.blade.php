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
                Perfil
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">
                                <a href="{{route('profile.create')}}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Nuevo Perfil
                                </a>
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Cedula</th>
                                        <th>Dirección</th>
                                        <th>Telefono</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($profile as $profile)
                                    <tr id="{{ $profile->id}}">
                                        <th scope="row">{{$profile->id}}</th>
                                        <td>
                                            <a href="{{route('profile.show',$profile)}}">{{$profile->first_name}} {{$profile->last_name}}</a>
                                        </td>
                                        <td>{{$profile->cedula}}</td>
                                        <td>{{$profile->address}}</td>
                                        <td>{{$profile->phone}}</td>
                                        <td>{{$profile->email}}</td>
                                        <td style="width: 50px;">
                                            {!! Form::open(['route'=>['profile.destroy',$profile], 'method'=>'DELETE','id' => 'delete']) !!}
                                            <meta name="_token" content="{!! csrf_token() !!}"/>
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{route('profile.edit', $profile)}}" title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <button class="jsgrid-button jsgrid-edit-button unstyled-button" title="Eliminar" id="delete-profile" @if(isset($profile)) data-id="{{ $profile->id }}" @endif @if(isset($client)) data-name="{{ $$profile->name }}" @endif>
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('admin/js/data-table.js') !!}
    {!! Html::script('admin/js/sweetalert2.js') !!}
    <!--<script>
        $(document).ready(function(){
            $.ajaxSetup({headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}});
            $("body").on("click","#delete-client",function(e){
                e.preventDefault();
                let id = $(this).data("id");
                let name = $(this).data("name");
                let url = e.target
                const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});

                swalWithBootstrapButtons.fire({
                    title : 'Está seguro de eliminar al cliente:' +name,
                    'icon':'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Eliminar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result)=>{
                    if (result.value) {
                        $.ajax({
                            url: "",
                            type: 'POST',
                            data: {
                                id: id,
                                _method:'DELETE'
                            },
                            success: function (response){
                                toastr.success(response.message);
                                $('#'+id).remove();
                            },
                            error:function(response){
                                toastr.error(response.message);
                                console.log(response);
                            }
                        });
                    }else if(result.dismiss === Swal.DismissReason.cancel){
                        swalWithBootstrapButtons.fire(
                            'Cancelar',
                            'El Cliente :'+name+' no se elimino',
                            'error'
                        );
                    }
                });
                return false;
            });
        });
    </script>-->
@endsection