<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Ingrese el Nombre del Proveedor','id' => 'name']) !!}
    @error('name')
        <p class="text-danger">{{$message}}</p>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('email', 'Correo Electronico') !!}
    {!! Form::email('email', null, ['class' => 'form-control','placeholder' => 'Ingrese su Correo Electronico' ]) !!}
    @error('email')
        <p class="text-danger">{{$message}}</p>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('ruc_number', 'RUC') !!}
    {!! Form::number('ruc_number', null, ['class' => 'form-control','placeholder' => 'Ingrese su RUC' ]) !!}
    @error('ruc_number')
        <p class="text-danger">{{$message}}</p>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('address', 'Dirección') !!}
    {!! Form::text('address', null, ['class' => 'form-control','placeholder' => 'Ingrese su Dirección' ]) !!}
    @error('address')
        <p class="text-danger">{{$message}}</p>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('phone', 'Telefono') !!}
    {!! Form::text('phone', null, ['class' => 'form-control','placeholder' => 'Ingrese su Telefono' ]) !!}
    @error('phone')
        <p class="text-danger">{{$message}}</p>
    @enderror
</div>

