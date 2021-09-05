@extends('layouts.admin')
@section('styles')
    <style type="text/css">
        .unstyled-button {
            border: none;
            padding: 0;
            background: none;
        }

        .error {
            color: #FF0000;
            padding-top: 2px;
        }

    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Registro de Ventas
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro Ventas</h4>
                        </div>
                        {!! Form::open(['route' => 'sales.store', 'method' => 'POST', 'files' => true, 'id' => 'formulario', 'class' => 'form-sample']) !!}
                        @include('admin.sale._form')
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group pt-2">
                                    <button type="submit" id="guardar" class="btn btn-primary mr-2">Guardar</button>
                                    <a href="{{ route('sales.index') }}" class="btn btn-light">Cancelar</a>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('js/alerts.js') !!}
    {!! Html::script('js/avgrund.js') !!}
    {!! Html::script('js/sweetalert2.js') !!}
    <script>
        function createCliente(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            $("#cliente").on('click',function(e){
                e.preventDefault();
                $("#cliente-registro").modal('show');
            });
            function getClientes(){
                $.post("{{ route('sales.search') }}",{getClients:'getClients'},(response)=>{
                    $.each(response, function (key, cliente){
                        let template='';
                        cliente.forEach(element => {
                            template+=`
                                <option value="${element.id}">${element.name}  -  ${element.cedula}</option>
                            `;
                        });
                    $('#client_id').html(template);
                    });
                });
            }
            function guardar(name,cedula,ruc,address,phone,email) {
                const request = $.ajax({
                        url: "{{ route('client.store') }}",
                        type: 'POST',
                        data:{
                            name:name,
                            cedula:cedula,
                            ruc:ruc,
                            address:address,
                            phone:phone,
                            email:email,
                        }
                    });
                    request.done(function(response) {
                        if(response.code == 200){
                            toastr.success(response.message);
                            setTimeout(function(){
                                $("#cliente-registro").modal('hide');
                                getClientes();
                            },1500);
                        }else{
                            toastr.error(response.message);
                            console.error(response.message);
                        }
                    });
                    request.fail(function(xhr, status, error){
                        $.each(xhr.responseJSON.errors, function (key, item)
                        {
                            $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                            setInterval(function(){
                                $("#errors").hide()
                            },7000)
                        });
                    });
            }
            $("#guardar-client").on("click",function(e){
                e.preventDefault();
                let cedula = $("#cedula").val().trim();
                let name = $("#name").val();
                let ruc = $("#ruc").val();
                let address = $("#address").val();
                let phone = $("#phone").val();
                let email = $("#email").val();
                guardar(name,cedula,ruc,address,phone,email);
            });
        }
        $(document).ready(function() {
            createCliente();
            var cont = -1;
            total = 0;
            subtotal = [];

            $(".select2").select2();
            $("#agregar").click(function(e) {
                e.preventDefault();
                agregar();
            });

            $("#guardar").hide();
            $("#product_id").change(mostrarDetalleProducto);
            function mostrarDetalleProducto() {
                datosProduct = document.getElementById("product_id").value.split('_');
                $("#stock").val(datosProduct[1]);
                $("#price").val(datosProduct[2]);
            }
            function agregar() {
                datosProduct = document.getElementById("product_id").value.split('_');

                let product_id = datosProduct[0];
                let producto = $("#product_id option:selected").text();
                let cantidad = $("#cantidad").val();
                let precio = $("#price").val();
                let stock = $("#stock").val();
                let impuesto = $("#impuesto").val();
                let descuento = $("#descuento").val();

                if (product_id != "" && cantidad != "" && cantidad > 0 && precio != "") {

                    if (parseInt(stock) >= parseInt(cantidad)) {
                        subtotal[cont] = (cantidad * precio) - (cantidad * precio * descuento / 100);
                        total = total + subtotal[cont];

                        let fila = '<tr class="selected" id="fila' + cont +
                            '"><td><button type="button" class="elimar-art btn btn-danger btn-sm"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="product_id[]" value="' +
                            product_id + '">' + producto +
                            '</td> <td> <input type="hidden" id="price[]" name="price[]" value="' + parseFloat(
                                precio).toFixed(2) +
                            '"> <input class="form-control" type="text" id="price[]" value="' + parseFloat(precio)
                            .toFixed(2) +
                            '" disabled> </td> </td>   <td> <input type="hidden" id="descuento[]" name="descuento[]" value="' +
                            parseFloat(descuento).toFixed(2) +
                            '"> <input class="form-control" type="text" id="descuento[]" value="' + parseFloat(descuento)
                            .toFixed(2) +
                            '" disabled> </td> </td>   <td> <input type="hidden" name="cantidad[]" value="' +
                            cantidad + '"> <input class="form-control" type="number" value="' + cantidad +
                            '" disabled> </td> <td align="right">$' + parseFloat(subtotal[cont]).toFixed(2) + " </td></tr>";

                        cont++;
                        limpiar();
                        totales();
                        evaluar();
                        $("#detalles").append(fila);

                    } else {
                        Swal.fire({
                            type: "error",
                            icon: "error",
                            text: "La cantidad a vender supera el Stock del Producto"
                        });
                    }
                } else {
                    Swal.fire({
                        type: "error",
                        icon: "error",
                        text: "Rellene todos los campos del detalle de la Compra",
                    });
                }
            }
            function limpiar() {
                let cantidad = $("#cantidad").val("");
                let precio = $("#price").val("");
                let descuento = $("#descuento").val("0");
            }
            function totales() {
                $("#total").html("$ " + total.toFixed(2));
                let impuesto = $("#impuesto").val();
                let total_impuesto = (total * impuesto) / 100;
                let total_pagar = total + total_impuesto;
                $("#total_impuesto").html("$ " + total_impuesto.toFixed(2));
                $("#total_pagar_html").html("$ " + total_pagar.toFixed(2));
                $("#total_pagar").val(total_pagar.toFixed(2));
            }
            function evaluar() {
                if (total > 0) {
                    $("#guardar").show();
                } else {
                    $("#guardar").hide();
                }
            }
            $(document).on("click", ".elimar-art", (e) => {
                let elememto = $(this)[0].activeElement.parentElement.parentElement;

                total = total - subtotal[elememto];
                total_impuesto = (total * impuesto) / 100;
                total_pagar_html = total + total_impuesto;

                $("#total").html("$" + total);
                $("#total_impuesto").html("$" + total_impuesto);
                $("#total_pagar_html").html("$" + total_pagar_html);
                $("#total_pagar").val(total_pagar_html.toFixed(2));

                elememto.remove();

                evaluar();

                /*$("#fila" + index).remove();
                evaluar();*/
            });
        });
    </script>
@endsection