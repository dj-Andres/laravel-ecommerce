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
                Registro de Compras
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Compras</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Registro Compras</h4>
                        </div>

                        {!! Form::open(['route' => 'purchases.store', 'method' => 'POST', 'files' => true, 'id' => 'formulario', 'class' => 'form-sample']) !!}
                        @include('admin.purchase._form')
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group pt-2">
                                    <button type="submit" id="guardar" class="btn btn-primary mr-2">Guardar</button>
                                    <a href="{{ route('purchases.index') }}" class="btn btn-light">Cancelar</a>
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
        $(document).ready(function() {
            var cont = 0;
            total = 0;
            subtotal = [];

            $(".select2").select2();

            $("#agregar").click(function (e) {
                e.preventDefault();
                agregar();
            }); 
            
    
            $("#guardar").hide();

            function agregar(){
                let product_id = $("#product_id").val();
                let producto = $("#product_id option:selected").text();
                let cantidad = $("#cantidad").val();
                let precio = $("#price").val();
                let impuesto = $("#impuesto").val();
                //let compra_id = $("#compra_id").val();

                if(product_id != "" && cantidad != "" && cantidad > 0 && precio != ""){
                    subtotal [cont] = cantidad * precio;
                    total = total + subtotal [cont];

                    let  fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="elimar-art btn btn-danger btn-sm"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="product_id[]" value="'+product_id+'">'+producto+'</td> <td> <input type="hidden" id="price[]" name="price[]" value="' + precio + '"> <input class="form-control" type="text" id="price[]" value="' + precio + '" disabled> </td> </td> <td> <input type="hidden" name="cantidad[]" value="' + cantidad + '"> <input class="form-control" type="number" value="' + cantidad + '" disabled> </td> <td align="right">s/' + subtotal[cont] + ' </td></tr>';
                    /*<tr class="selected" id="fila'+cont+'"><td><button type="button" class="elimar-art btn btn-danger btn-sm"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="product_id[]" value="'+product_id+'">'+producto+'</td> <td> <input type="text" id="price[]" name="price[]" value="' + precio + '" class="form-control" disabled>  </td>  <td> <input type="text" name="cantidad[]" value="' + cantidad + '" class="form-control" disabled> </td> <td align="right">s/' + subtotal[cont] + ' </td></tr>*/
                    cont++;
                    limpiar();
                    totales();
                    evaluar();
                    $('#detalles').append(fila);
                }else{
                    Swal.fire({
                        type: 'error',
                        icon:'error',
                        text: 'Rellene todos los campos del detalle de la compras',
                    });
                }
            }

            function limpiar(){
                let cantidad = $("#cantidad").val("");
                let precio = $("#price").val("");
            }
            function totales() {
                $("#total").html("PEN " + total.toFixed(2));
                let impuesto = $("#impuesto").val();
                let total_impuesto = total * impuesto / 100;
                let total_pagar = total + total_impuesto;
                $("#total_impuesto").html("PEN " + total_impuesto.toFixed(2));
                $("#total_pagar_html").html("PEN " + total_pagar.toFixed(2));
                $("#total_pagar").val(total_pagar.toFixed(2));
            }
            function evaluar() {
                if (total > 0) {
                    $("#guardar").show();
                } else {
                    $("#guardar").hide();
                }
            }
                $(document).on('click', '.elimar-art', (e) => {
                    let elememto = $(this)[0].activeElement.parentElement.parentElement;
        
                     total = total - subtotal[elememto];
                     total_impuesto = total * impuesto / 100;
                     total_pagar_html = total + total_impuesto;

                    $("#total").html("PEN" + total);
                    $("#total_impuesto").html("PEN" + total_impuesto);
                    $("#total_pagar_html").html("PEN" + total_pagar_html);
                    $("#total_pagar").val(total_pagar_html.toFixed(2));

                    elememto.remove();

                    evaluar();
                    
                    /*$("#fila" + index).remove();
                    evaluar();*/
                });
            
        });
    </script>
@endsection
