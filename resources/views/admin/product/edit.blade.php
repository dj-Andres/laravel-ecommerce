@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/vendors/lightgallery/css/lightgallery.css') }}">
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
        {!! Form::model($product, ['route'=>['product.update',$product->id],'method'=>'PUT','id' => "formulario", 'files' => 'true']) !!}
            @include('admin.product._form')
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
    {!! Html::script('admin/ckeditor/ckeditor.js') !!}
    {!! Html::script('admin/ckeditor/translations/es.js') !!}
    {!! Html::script('admin/js/dropify.js') !!}
    {!! Html::script('admin/vendors/lightgallery/js/lightgallery-all.min.js') !!}
    {!! Html::script('admin/js/light-gallery.js') !!}
    {!! Html::script('admin/js/sweetalert2.js') !!}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}});
            if ($("#fileuploader").length) {
                $("#fileuploader").uploadFile({
                    url: "/product/upload/{{$product->id}}",
                    fileName: "picture"
                });
            }
            ClassicEditor
                .create( document.querySelector( '#short_description' ),{
                    language: 'es'
                })
                .catch( error =>{
                    console.error(error);
                });
            ClassicEditor
                .create( document.querySelector( '#long_description' ),{
                    language: 'es'
                })
                .catch( error =>{
                    console.error(error);
                });
            $("#category_id").change(function(){
                $.ajax({
                    url: "{{route('product.search')}}",
                    type: 'POST',
                    data:{
                        category_id:$("#category_id").val(),
                        getSubCategory:'getSubCategory',
                    }
                }).done(function(response){
                    if(response.code == 200){
                        $("#subcategory_id").empty();
                        $("#subcategory_id").append("<option disabled selected>...Seleccionar una SubCategoria</option>")
                        let item = response.data;
                        $.each(item,function(key,element){
                            console.log(element);
                            $("#subcategory_id").append('<option value="'+element.id+'">'+element.name+'</option>');
                        });
                    }else{
                        toastr.error(response.message);
                        console.error(response.message);
                    }
                });
            });
            const updateProduct = (id,name,sell_price,subcategory_id,provider_id,code,short_description,long_description,tags) => {
                $.ajax({
                    url: "{{route('product.update',$product->id)}}",
                    type: 'POST',
                    data:{
                        id,
                        name,
                        sell_price,
                        subcategory_id,
                        provider_id,
                        code,
                        short_description,
                        long_description,
                        tags,
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
                let id = $(this).data("id")
                let name = $("#name").val();
                let sell_price = $("#sell_price").val();
                let subcategory_id = $("#subcategory_id").val();
                let provider_id = $("#provider_id").val();
                let code = $("#code").val();
                let short_description = $("#short_description").val();
                let long_description = $("#long_description").val();
                let tags = $("#tags").val();

                const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});
                swalWithBootstrapButtons.fire({
                    title : 'Está seguro de actualizar registro',
                    'icon':'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Guardar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result)=>{
                    if (result.value) { updateProduct(id,name,sell_price,subcategory_id,provider_id,code,short_description,long_description,tags);}
                });
            });
        });
    </script>
@endsection
