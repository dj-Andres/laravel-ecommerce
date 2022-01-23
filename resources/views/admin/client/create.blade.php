@extends('layouts.admin')
@section('styles')
    <style type="text/css">
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Registro de Clientes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('client.index') }}">Clientes</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro Cliente</h4>
                        </div>
                        {!! Form::open(['route' => 'client.store', 'method' => 'POST', 'files' => true,'id' => 'formulario', 'class' => 'form-sample']) !!}
                            @include('admin.client._form')
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            function guardar(datos){
                $.ajax({
                    url: "{{ route('client.store') }}",
                    type: 'POST',
                    data:datos,
                    processData:false,
                    cache:false,
                    contentType: false
                }).done(function(response){
                    if(response.code == 200){
                        toastr.success(response.message);
                        setTimeout(function(){
                            window.location.href="{{route('client.index')}}"
                        },3000);
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
                        },7000)
                    });
                });
            };
            $("#formulario").submit((e)=>{
                e.preventDefault();
                let cedula = $("#cedula").val().trim();
                let name = $("#name").val();
                let ruc = $("#ruc").val();
                let email = $("#email").val();
                let address = $("#address").val();
                let phone = $("#phone").val();
                let pdf = $("#pdf").prop('files')[0];

                let formData = new FormData();

                formData.append('pdf',pdf);
                formData.append('cedula',cedula);
                formData.append('name',name);
                formData.append('ruc',ruc);
                formData.append('email',email);
                formData.append('address',address);
                formData.append('phone',phone);
                let total = 0; let longitud = cedula.length;  let longcheck = longitud - 1;

                if (cedula !== "" && longitud === 10) {
                    for (i = 0; i < longcheck; i++) {
                        if (i % 2 === 0) {
                        let aux = cedula.charAt(i) * 2;
                        if (aux > 9) aux -= 9;
                            total += aux;
                        } else {
                            total += parseInt(cedula.charAt(i));
                        }
                    }
                    total = total % 10 ? 10 - (total % 10) : 0;
                    if (cedula.charAt(longitud - 1) == total){
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
                                guardar(formData);
                            }
                        });
                    }else{
                        $("#aviso").show();
                        $("#aviso").text("Cedula invalida");
                    }
                }
            });
        });
    </script>
@endsection
