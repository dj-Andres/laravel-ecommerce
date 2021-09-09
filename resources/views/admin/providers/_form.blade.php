<meta name="_token" content="{!! csrf_token() !!}"/>
<fieldset>
    <div id="errors"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('name', 'Nombre',['class'=>'col-sm-3 col-form-label required']) !!}
                {!! Form::text('name', null, ['class' => 'form-control letters','placeholder' => 'Nombre del Proveedor','id' => 'name']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('email', 'Email',['class'=>'col-sm-3 col-form-label required']) !!}
                {!! Form::email('email', null, ['class' => 'form-control','placeholder' => 'Correo Electronico' ]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('ruc_number', 'N° RUC',['class'=>'col-sm-3 col-form-label required']) !!}
                {!! Form::text('ruc_number', null, ['class' => 'form-control numbers','placeholder' => 'Numero RUC' ]) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('address', 'Dirección',['class'=>'col-sm-3 col-form-label']) !!}
                {!! Form::text('address', null, ['class' => 'form-control','placeholder' => 'Dirección' ]) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('phone', 'Telefono',['class'=>'col-sm-3 col-form-label required']) !!}
                {!! Form::text('phone', null, ['class' => 'form-control numbers','placeholder' => 'Telefono' ]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary mr-2 editar" id="guardar"><i class="fas fa-save"></i> Guardar</button>
                <a href="{{ route('providers.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </div>
    </div>
</fieldset>

