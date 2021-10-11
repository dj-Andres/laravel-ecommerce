<meta name="_token" content="{!! csrf_token() !!}" />
<div id="errors_prod"></div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            {!! Form::label('name', 'Nombre', ['class' => 'required']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control letters', 'placeholder' => 'Ingrese el Poroducto', 'id' => 'name']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('sell_price', 'Precio de Compra', ['class' => 'required']) !!}
                            {!! Form::text('sell_price', null, ['class' => 'form-control numbers', 'placeholder' => 'Ingrese el Precio Compra', 'id' => 'sell_price']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('short_description', 'Extracto', ['class' => 'required']) !!}
                            {!! Form::textarea('short_description', null, ['class' => 'form-control', 'rows' => '3' ,'id' => 'short_description']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('long_description', 'Descripción', ['class' => 'required']) !!}
                            {!! Form::textarea('long_description', null, ['class' => 'form-control', 'rows' => '10','id' => 'long_description']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('codigo', 'Codigo Barras', ['class' => 'required']) !!}
                            {!! Form::text('code', null, ['class' => 'form-control numbers', 'id' => 'code']) !!}
                            <small id="helpId" class="text-muted">Campo opcional</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="provider_id" class="required">Proveedor</label>
                            <select class="form-control select2" name="provider_id" id="provider_id" style="width:100%">
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="category" class="required">Categoría</label>
                            <div class="input-group">
                                <select class="form-control select2"  id="category_id"
                                    style="width:80%">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-success" id="categoria" type="button"
                                        title="Agregar Categoria"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subcategory_id" class="required">SubCategorias</label>
                            <select class="form-control select2" name="subcategory_id" id="subcategory_id"
                                style="width:100%">
                                @if (isset($product))
                                    <option disabled selected> - - -Seleccionar una Categoria - - -</option>
                                @else
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tags" class="required">Tags</label>
                            <select class="form-control select2" name="tags[]" multiple id="tags"
                                style="width:100%">
                                @if (isset($product))
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"@if ($product->tags->pluck('id')->contains($tag->id)) selected @endif>{{ $tag->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>
                </div>
                @if (isset($product))
                    @include('admin.product.partial._file_input')
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (isset($product))
                    @include('admin.product.partial._galery')
                @else
                    @include('admin.product.partial._dropify')
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="form-group pt-2">
            <button type="submit" class="btn btn-primary mr-2" @if (isset($product)) data-id="{{ $product->id }}"@endif>Guardar</button>
            <a href="{{ route('product.index') }}" class="btn btn-light">Cancelar</a>
        </div>
    </div>
</div>
