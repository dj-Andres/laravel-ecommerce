<fieldset>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('provider', 'Proveedor') !!}
                <select name="provider_id" id="provider_id" class="form-control select2" style="width:100%">
                    <option value="">Seleccionar...</option>
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
                {!! Form::label('product', 'Producto') !!}
                <select name="product_id" id="product_id" class="form-control select2 " style="width:100%" required>
                    <option value="">Seleccionar...</option>
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
                {!! Form::label('Cantidad', 'cantidad') !!}
                {!! Form::number('cantidad', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Cantidad', 'id' => 'cantidad']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('precio', 'Precio Compra') !!}
                {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Precio Compra', 'id' => 'price']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('impuesto', 'Impuesto') !!}
                {!! Form::number('impuesto', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Impuesto', 'id' => 'impuesto']) !!}
                @error('provider_id')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="button" id="agregar" class="btn btn-primary float-right">Agregar producto</button>
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
</fieldset>


