@extends('layouts.admin')
@section('styles')
    <style type="text/css">
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Productos
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Producto</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Producto</h4>
                        </div>
                        {!! Form::model($product, ['route'=>['product.update',$product->id],'method'=>'PUT','id' => "formulario"]) !!}
                            @include('admin.product._form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/dropify.js') !!}
    {!! Html::script('js/sweetalert2.js') !!}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}});
            const updateProduct = (id,name,sell_price,category_id,provider_id,code) => {
                $.ajax({
                    url: "{{route('product.update',$product->id)}}",
                    type: 'POST',
                    data:{
                        id,
                        name,
                        code,
                        sell_price,
                        category_id,
                        provider_id,
                        _method:'PUT'
                    }
                }).done(function(response){
                    if(response.code == 200){
                        toastr.success(response.message);
                        setTimeout(function() {
                             window.location.href = "{{ route('product.index') }}";
                        },1500)
                    }else{
                        toastr.error(response.message);
                        console.error(response.message);
                    }
                }).fail(function(xhr, status, error){
                    $.each(xhr.responseJSON.errors, function (key, item)
                    {
                        $("#errors_prod").append("<li class='alert alert-danger'>"+item+"</li>")
                        setInterval(function(){
                            $("#errors_prod").hide()
                        },7000)
                    });
                });
            }
            $("#formulario").submit((e) => {
                e.preventDefault();
                let id = $("#id").val();
                console.log(id);
                let name = $("#name").val();
                let sell_price = $("#sell_price").val();
                let category_id = $("#category_id").val();
                let provider_id = $("#provider_id").val();
                let code = $("#code").val();
                const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});
                swalWithBootstrapButtons.fire({
                    title : 'Está seguro de actualizar registro',
                    'icon':'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Guardar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result)=>{
                    if (result.value) { updateProduct(id,name,sell_price,category_id,provider_id,code);}
                });
            });
        });
    </script>
@endsection
