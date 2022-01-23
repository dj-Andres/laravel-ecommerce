<meta name="_token" content="{!! csrf_token() !!}"/>
<fieldset>
    <div id="errors"></div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('name', 'Nombre',['class'=>'col-sm-3 col-form-label required']) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', null, ['class' => 'form-control letters', 'placeholder' => 'Ingrese el Nombre del Cliente', 'id' => 'name']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('cedula', 'Cedula',['class'=>'col-sm-3 col-form-label required']) !!}
                <div class="col-sm-9">
                    {!! Form::text('cedula', null, ['class' => 'form-control numbers', 'placeholder' => 'Ingrese la Cedula', 'id' => 'cedula']) !!}
                    <p id="aviso" class="text-danger font-weight-bold mt-1"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('ruc', 'Numero Ruc',['class'=>'col-sm-3 col-form-label required']) !!}
                <div class="col-sm-9">
                    {!! Form::text('ruc', null, ['class' => 'form-control numbers', 'placeholder' => 'Ingrese el RUC', 'id' => 'ruc']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('email', 'Email',['class' => 'col-sm-3 col-form-label required']) !!}
                <div class="col-sm-9">
                    {!! Form::email('email', null, ['class'=>'form-control','id' => 'email','placeholder'=>'Ingresar el Email']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('direccion', 'Dirección',['class' => 'col-sm-3 col-form-label required']) !!}
                <div class="col-sm-9">
                    {!! Form::text('address', null, ['class'=>'form-control','id' => 'address','placeholder'=>'Ingresar su Dirección']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                {!! Form::label('Telefono', 'Telefono/Celular',['class' => 'col-sm-3 col-form-label required']) !!}
                <div class="col-sm-9">
                    {!! Form::text('phone', null, ['class'=>'form-control numbers','id' => 'phone','placeholder'=>'Ingresar su Telefono']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                {!! Form::label('pdf', 'Hoja de Vida',['class' => 'col-sm-3 col-form-label required']) !!}
                <div class="col-sm-9">
                    <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group pt-2">
                <button type="submit" class="btn btn-primary mr-2" id="guardar" @if (isset($client)) data-id="{{ $client->id }}" @endif><i class="fas fa-save"></i> Guardar</button>
                <a href="{{ route('client.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </div>
    </div>
</fieldset>
