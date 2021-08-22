<meta name="_token" content="{!! csrf_token() !!}"/>
<fieldset>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('name', 'Nombre',['class'=>'col-sm-3 col-form-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Nombre del Proveedor','id' => 'name']) !!}
                @error('name')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('email', 'Email',['class'=>'col-sm-3 col-form-label']) !!}
                {!! Form::email('email', null, ['class' => 'form-control','placeholder' => 'Correo Electronico' ]) !!}
                @error('email')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('ruc_number', 'N° RUC',['class'=>'col-sm-3 col-form-label']) !!}
                {!! Form::text('ruc_number', null, ['class' => 'form-control','placeholder' => 'Numero RUC' ]) !!}
                @error('ruc_number')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('address', 'Dirección',['class'=>'col-sm-3 col-form-label']) !!}
                {!! Form::text('address', null, ['class' => 'form-control','placeholder' => 'Dirección' ]) !!}
                @error('address')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('phone', 'Telefono',['class'=>'col-sm-3 col-form-label']) !!}
                {!! Form::text('phone', null, ['class' => 'form-control','placeholder' => 'Telefono' ]) !!}
                @error('phone')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
    </div>
</fieldset>

