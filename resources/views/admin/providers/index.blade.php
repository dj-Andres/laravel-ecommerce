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
                Proveedores
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">
                                @can('providers.create')
                                    <a href="{{route('providers.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Proveedor</a>
                                @endcan
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Numero Ruc</th>
                                        <th>Dirección</th>
                                        <th>Telefono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($providers as $provider)
                                    <tr id="{{ $provider->id }}">
                                        <th scope="row">{{$provider->id}}</th>
                                        <td>
                                            <a href="{{route('providers.show',$provider)}}">{{$provider->name}}</a>
                                        </td>
                                        <td>{{$provider->email}}</td>
                                        <td>{{$provider->ruc_number}}</td>
                                        <td>{{$provider->address}}</td>
                                        <td>{{$provider->phone}}</td>
                                        <td style="width: 50px;">
                                        @can('providers.destroy','providers.edit')
                                            <form action="{{ route('providers.destroy',$provider->id) }}" method="POST" id="formulario">
                                                <meta name="_token" content="{!! csrf_token() !!}"/>
                                                <a class="jsgrid-button jsgrid-edit-button" href="{{route('providers.edit', $provider)}}" title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <button class="jsgrid-button jsgrid-delete-button unstyled-button" type="submit" data-id="{{ $provider->id }}" data-name="{{ $provider->name }}" title="Eliminar" id="eliminar">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
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
{!! Html::script('js/data-table.js') !!}
{!! Html::script('js/sweetalert2.js') !!}
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        }
    });
    $("body").on("click","#eliminar",function(e){
        e.preventDefault();
        let id = $(this).data("id");
        let name = $(this).data("name");
        let url = e.target

        const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});

        swalWithBootstrapButtons.fire({
                title : 'Está seguro de eliminar al proveedor:' +name,
                'icon':'question',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'No, Cancelar!',
                reverseButtons: true
            }).then((result)=>{
                if (result.value) {
                    $.ajax({
                        url: "{{route('providers.destroy',$provider->id)}}",
                        type: 'POST',
                        data: {
                            id: id,
                            _method:'DELETE'
                        },
                        success: function (response){
                            toastr.success(response.message);
                            $('#'+id).remove();
                        }
                    });
                }else if(result.dismiss === Swal.DismissReason.cancel){
                    swalWithBootstrapButtons.fire(
                        'Cancelar',
                        'El Proveedor :'+name+' no se elimino',
                        'error'
                    );
                }
            });
      return false;
    });
});
</script>
@endsection
