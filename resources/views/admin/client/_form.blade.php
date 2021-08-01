<meta name="_token" content="{!! csrf_token() !!}"/>
<fieldset>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('name', 'Nombre',['class'=>'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre del Cliente', 'id' => 'name']) !!}
                    <div id="errors"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('cedula', 'Cedula',['class'=>'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Cedula', 'id' => 'cedula']) !!}
                    <div id="errors"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('ruc', 'Numero Ruc',['class'=>'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('ruc', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el RUC', 'id' => 'ruc']) !!}
                    <div id="errors"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('email', 'Email',['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::email('email', null, ['class'=>'form-control','id' => 'email','placeholder'=>'Ingresar el Email']) !!}
                    <div id="errors"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('direccion', 'Dirección',['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('address', null, ['class'=>'form-control','id' => 'address','placeholder'=>'Ingresar su Dirección']) !!}
                    <div id="errors"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('Telefono', 'Telefono/Celular',['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('phone', null, ['class'=>'form-control','id' => 'phone','placeholder'=>'Ingresar su Telefono']) !!}
                    <div id="errors"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group pt-2">
                <button type="submit" class="btn btn-primary mr-2 editar" id="guardar">Guardar</button>
                <a href="{{ route('client.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </div>
    </div>
</fieldset>