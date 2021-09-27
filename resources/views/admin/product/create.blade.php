@extends('layouts.admin')
@section('styles')
    <style type="text/css"></style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Registro de Productos
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Productos</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro Producto</h4>
                        </div>
                        {!! Form::open(['route' => 'product.store', 'method' => 'POST', 'files' => true, 'id' => 'formulario', 'class' => 'form-sample']) !!}
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
            $("#categoria").on('click',function(e){
                e.preventDefault();
                $("#categoria-registro").modal('show');
            });
            function getCategories(){
                $.post("{{ route('categories.search') }}",{getCategories:'getCategories'},(response)=>{
                    $.each(response, function (key, categoria){
                        let template='';
                        categoria.forEach(element => {
                            template+=`
                                <option value="${element.id}">${element.name}</option>
                            `;
                        });
                        $('#category_id').html(template);
                    });
                });
            }
            function createCategory(name,description){
                $.ajax({
                    url: "{{route('categories.store')}}",
                    type: 'POST',
                    data:{
                        name:name,
                        description:description
                    },
                    success: function (response){
                        if(response.code == 200){
                            toastr.success(response.message);
                            setTimeout(function(){
                                $("#categoria-registro").modal('hide');
                                getCategories();
                            },1500);
                        }else{
                            toastr.error(response.message);
                            console.error(response.message);
                        }
                    },
                    fail:function(xhr, status, error){
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
            $("#guardar-categoria").on('click',function(e){
                e.preventDefault();
                let name = $("#name-categoria").val(),description=$("#description").val();
                createCategory(name,description);
            });
            const createProduct = (datos) => {
                $.ajax({
                    url: "{{route('product.store')}}",
                    type: 'POST',
                    data:datos,
                    processData:false,
                    cache:false,
                    contentType: false
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
            $("#formulario").submit((e)=>{
                e.preventDefault();
                let name = $("#name").val(), sell_price = $("#sell_price").val(), category_id = $("#category_id").val(), provider_id = $("#provider_id").val(),code = $("#code").val();
                let picture = $("#picture").prop('files')[0];
                let formData = new FormData();

                formData.append('image',picture);
                formData.append('name',name);
                formData.append('sell_price',sell_price);
                formData.append('category_id',category_id);
                formData.append('provider_id',provider_id);
                formData.append('code',code);

                const swalWithBootstrapButtons = Swal.mixin({customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger mr-1'},buttonsStyling: false});
                swalWithBootstrapButtons.fire({
                    title : 'Está seguro de crear un nuevo registro',
                    'icon':'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Guardar!',
                    cancelButtonText: 'No, Cancelar!',
                    reverseButtons: true
                }).then((result)=>{
                    if (result.value) {createProduct(formData);}
                });
            });
        });
    </script>
@endsection
@include('components._modal_categoria')