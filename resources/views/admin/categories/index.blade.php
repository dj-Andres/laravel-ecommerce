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
                Categorías
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categorías</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">
                                @can('categories.create')
                                    <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"> Nueva Categoria</i></a>
                                @endcan
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr id="{{ $category->id }}">
                                            <th scope="row">{{ $category->id }}</th>
                                            <td>
                                                {{ $category->name }}
                                            </td>
                                            <td>{{ $category->description }}</td>
                                            <td style="width: 50px;">
                                                @can('categories.edit','categories.destroy')
                                                {!! Form::open(['route' => ['categories.destroy', $category], 'method' => 'DELETE']) !!}
                                                    <meta name="_token" content="{!! csrf_token() !!}"/>
                                                    <a class="jsgrid-button jsgrid-edit-button" href="{{ route('categories.edit', $category) }}" title="Editar">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button class="jsgrid-button jsgrid-delete-button unstyled-button" id="delete" type="submit" title="Eliminar" @if(isset($category)) data-id="{{ $category->id }}" @endif @if(isset($category)) data-name="{{ $category->name }}" @endif>
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                {!! Form::close() !!}
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
    {!! Html::script('admin/js/data-table.js') !!}
    {!! Html::script('admin/js/sweetalert2.js') !!}
    <script>
        $(document).ready(function(){
            $.ajaxSetup({headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}});
        });
        $("body").on('click','#delete',function(e){
            e.preventDefault();
            let id = $(this).data("id");
            let name = $(this).data("name");
            const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});

            swalWithBootstrapButtons.fire({
                title : 'Está seguro de eliminar la categoria:' +name,
                'icon':'question',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'No, Cancelar!',
                reverseButtons: true
            }).then((result)=>{
                if(result.value){
                    $.ajax({
                        url: "{{route('categories.destroy',isset($category))}}",
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
                    swalWithBootstrapButtons.fire('Cancelar','La Categoria :'+name+' no se elimino','error');
                }
            });
            return false;
        });
    </script>
@endsection
