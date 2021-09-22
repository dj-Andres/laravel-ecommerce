<meta name="_token" content="{!! csrf_token() !!}" />
<fieldset>
    <div id="errors"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                {!! Form::label('name', 'Nombre',['class' => 'required']) !!}
                {!! Form::text('name', null, ['class' => 'form-control letters', 'placeholder' => 'Nombre de la Categoria','id' =>'name']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                {!! Form::label('descripcion', 'Descripción') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3','id' => 'description']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" id="guardar" class="btn btn-primary mr-2" @if (isset($category)) data-id="{{ $category->id }}"@endif>Guardar</button>
            <a href="{{ route('categories.index') }}" class="btn btn-light">Cancelar</a>
        </div>
    </div>
</fieldset>
