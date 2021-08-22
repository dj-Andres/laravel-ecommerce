<meta name="_token" content="{!! csrf_token() !!}" />
<fieldset>
    <div class="row">
        <div id="errors"></div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group">
                <label for="name">Nombre</label>
                {!! Form::label('name', 'nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la Categoria','id' =>'name']) !!}
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
</fieldset>
