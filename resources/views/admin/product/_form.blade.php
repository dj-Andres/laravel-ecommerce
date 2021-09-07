<fieldset>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre del Proveedor', 'id' => 'name']) !!}
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('sell_price', 'Precio de Compra') !!}
                {!! Form::text('sell_price', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Precio Compra', 'id' => 'shell_price']) !!}
                @error('sell_price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="category_id">Categoría</label>
                <select class="form-control select2" name="category_id" id="category_id" style="width:100%">
                    <option value="" disabled selected>Seleccionar...</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="provider_id">Proveedor</label>
                <select class="form-control select2" name="provider_id" id="provider_id" style="width:100%">
                    <option value="" disabled selected>Seleccionar...</option>
                    @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endforeach
                    @error('provider_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="image">Logo</label>
            <input type="file" name="image" id="picture" class="dropify" />
            @error('image')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>
</fieldset>