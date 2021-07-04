<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="form-group row">
            {!! Form::label('cliente', 'Cliente') !!}            
            <select name="client_id" id="client_id" class="form-control select2" style="width:100%">
                @foreach ($clients as $client)
                    <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="form-group">
            {!! Form::label('impuesto', 'Impuesto') !!}
            {!! Form::number('impuesto', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Impuesto', 'id' => 'impuesto']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="form-group row">
            {!! Form::label('product', 'Producto') !!}            
            <select name="product_id" id="product_id" class="form-control select2 " style="width:100%">
                <option value="" disabled selected>Seleccionar un producto</option>
                @foreach ($products as $product)
                    <option value="{{$product->id}}_{{$product->stock}}_{{$product->sell_price}}">{{$product->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="form-group row">
            {!! Form::label('stock', 'Stock de Producto') !!}            
            <input type="text" name="stock" id="stock" disabled value="" class="form-control">            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="form-group">
            {!! Form::label('precio', 'Precio de Venta') !!}
            {!! Form::number('price', null, ['class' => 'form-control','id' => 'price','disabled' => 'true']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="form-group">
            {!! Form::label('cantidad', 'cantidad') !!}
            {!! Form::number('cantidad', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la cantidad', 'id' => 'cantidad']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="form-group">
            {!! Form::label('descuento', 'Descuento') !!}
            {!! Form::text('descuento', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Descuento', 'id' => 'descuento']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    <button type="button" id="agregar" class="btn btn-primary float-right">Agregar producto</button>
</div>
<div class="form-group">
    <h4 class="card-title">Detalles de Venta</h4>
    <div class="table-responsive col-md-12">
        <table id="detalles" class="table table-striped">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Producto</th>
                    <th>Precio Venta</th>
                    <th>Descuento</th>
                    <th>Cantidad</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL:</p>
                    </th>
                    <th>
                        <p align="right"><span id="total">$ 0.00</span> </p>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL IMPUESTO (12%):</p>
                    </th>
                    <th>
                        <p align="right"><span id="total_impuesto">$ 0.00</span></p>
                    </th>
                </tr>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL PAGAR:</p>
                    </th>
                    <th>
                        <p align="right">
                            <span align="right" id="total_pagar_html">$ 0.00</span>
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