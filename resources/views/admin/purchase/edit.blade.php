@extends('layouts.admin')
@section('styles')
    <style type="text/css">
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Editar Compras
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Panel administrador</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Compras</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Editar Compras</h4>
                        </div>
                        {!! Form::model($purchase, ['route'=>['purchases.update',$purchase],'method'=>'PUT','id' => "formulario"]) !!}
                            <fieldset>
                                <div class="row">
                                    <div id="errors"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('provider', 'Proveedor',['class' => 'required']) !!}
                                            <select name="provider_id" id="provider_id" class="form-control select2"style="width:100%">
                                                @foreach ($providers as $provider)
                                                    <option value="{{$provider->id}}">{{$provider->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('provider_id')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('product', 'Producto',['class' => 'required']) !!}
                                            <select name="product_id" id="product_id" class="form-control select2 " style="width:100%" required>
                                                @foreach ($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('Cantidad', 'Cantidad',['class' => 'required']) !!}
                                            {!! Form::text('cantidad', null, ['class' => 'form-control numbers', 'placeholder' => 'Ingrese la Cantidad', 'id' => 'cantidad']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('precio', 'Precio Compra',['class' => 'required']) !!}
                                            {!! Form::text('price', null, ['class' => 'form-control decimals', 'placeholder' => 'Ingrese el Precio Compra', 'id' => 'price']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('impuesto', 'Impuesto',['class' => 'required']) !!}
                                            {!! Form::text('impuesto', null, ['class' => 'form-control decimals', 'placeholder' => 'Ingrese el Impuesto', 'id' => 'impuesto']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" id="agregar" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Agregar producto</button>
                                </div>
                                <div class="form-group">
                                    <h4 class="card-title">Detalles de compra</h4>
                                    <div class="table-responsive col-md-12">
                                        <table id="detalles" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Eliminar</th>
                                                    <th>Producto</th>
                                                    <th>Precio $</th>
                                                    <th>Cantidad</th>
                                                    <th>SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($purchaseDetails as $detail)
                                                    <tr class="selected" id="fila{{$detail->product_id}}">
                                                        <td><button type="button" class="elimar-art btn btn-danger btn-sm"><i class="fa fa-times"></i></button></td>
                                                        <td><input type="hidden" name="product_id[]" value="{{$detail->product_id}}">{{ $detail->product->name }}</td>
                                                        <td><input type="hidden" id="price[]" name="price[]" value="{{ $detail->price }}"> <input class="form-control" type="text" id="price[]" value="{{ $detail->price }}" disabled> </td> </td>
                                                        <td><input type="hidden" name="cantidad[]" value="{{ $detail->cantidad }}"> <input class="form-control" type="number" value="{{ $detail->cantidad }}" disabled> </td>
                                                        <td align="right">$ {{ $subtotal}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="4">
                                                        <p align="right">TOTAL:</p>
                                                    </th>
                                                    <th>
                                                        <p align="right"><span id="total">$ {{ $purchase->total }}</span> </p>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4">
                                                        <p align="right">TOTAL IMPUESTO (12%):</p>
                                                    </th>
                                                    <th>
                                                        <p align="right"><span id="total_impuesto">$ {{ $purchase->total * $purchase->impuesto /100}}</span></p>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4">
                                                        <p align="right">TOTAL PAGAR:</p>
                                                    </th>
                                                    <th>
                                                        <p align="right">
                                                            <span align="right" id="total_pagar_html">$ {{ $purchase->total }}</span>
                                                            <input type="hidden" name="total" id="total_pagar">
                                                        </p>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group pt-2">
                                            <button type="submit" id="guardar" class="btn btn-primary mr-2">Guardar</button>
                                            <a href="{{ route('purchases.index') }}" class="btn btn-light">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            var cont = 0;
            total = 0;
            subtotal = [];
            $("#agregar").click(function (e) {
                e.preventDefault();
                agregar();
            });

            function agregar(){
                let product_id = $("#product_id").val();
                let producto = $("#product_id option:selected").text();
                let cantidad = $("#cantidad").val();
                let precio = $("#price").val();
                let impuesto = $("#impuesto").val();

                if(product_id != "" && cantidad != "" && cantidad > 0 && precio != ""){
                    subtotal [cont] = cantidad * precio;
                    total = total + subtotal [cont];

                    let  fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="elimar-art btn btn-danger btn-sm"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="product_id[]" value="'+product_id+'">'+producto+'</td> <td> <input type="hidden" id="price[]" name="price[]" value="' + precio + '"> <input class="form-control" type="text" id="price[]" value="' + precio + '" disabled> </td> </td> <td> <input type="hidden" name="cantidad[]" value="' + cantidad + '"> <input class="form-control" type="number" value="' + cantidad + '" disabled> </td> <td align="right">s/' + subtotal[cont] + ' </td></tr>';
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
            });
        });
    </script>
@endsection