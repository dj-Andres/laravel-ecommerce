<meta name="_token" content="{!! csrf_token() !!}"/>
<fieldset>
    <div id="errors_prod"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                {!! Form::label('name', 'Nombre',['class' => 'required']) !!}
                {!! Form::text('name', null, ['class' => 'form-control letters', 'placeholder' => 'Ingrese el Poroducto', 'id' => 'name']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('sell_price', 'Precio de Compra',['class' => 'required']) !!}
                {!! Form::text('sell_price', null, ['class' => 'form-control numbers', 'placeholder' => 'Ingrese el Precio Compra', 'id' => 'sell_price']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="category_id"  class="required">Categoría</label>
                <div class="input-group">
                    <select class="form-control select2" name="category_id" id="category_id" style="width:90%">
                        <option value="" disabled selected>Seleccionar...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-success" id="categoria" type="button" title="Agregar Categoria"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="provider_id" class="required">Proveedor</label>
                <select class="form-control select2" name="provider_id" id="provider_id" style="width:100%">
                    <option value="" disabled selected>Seleccionar...</option>
                    @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="image" class="required">Imagen del Producto</label>
            <input type="file" name="image" id="picture" class="dropify" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-12">
            <div class="form-group pt-2">
                <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                <a href="{{ route('product.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </div>
    </div>
</fieldset>
