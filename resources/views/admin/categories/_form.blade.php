<div class="form-group">
    <label for="name">Nombre</label>
    {!! Form::label('name', 'nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Ingrese el Nombre de la Categoria']) !!}
    @error('name')
        <p class="text-danger">{{$message}}</p>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('descripcion', 'Descripción') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','rows' => '3']) !!}
    @error('description')
        <p class="text-danger">{{$message}}</p>
    @enderror
</div>