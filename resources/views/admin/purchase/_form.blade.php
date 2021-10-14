<fieldset>
    <div class="row">
        <div id="errors"></div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('provider', 'Proveedor',['class' => 'required']) !!}
                <select name="provider_id" id="provider_id" class="form-control select2" style="width:100%">
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
    @if (isset($purchase))
        @include('admin.purchase.partial._table_edit')
    @else
        @include('admin.purchase.partial._table_create')
    @endif
    <div class="row">
        <div class="col-md-6 col-lg-12">
            <div class="form-group pt-2">
                <button type="submit" id="guardar" class="btn btn-primary mr-2">Guardar</button>
                <a href="{{ route('purchases.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </div>
    </div>
</fieldset>


