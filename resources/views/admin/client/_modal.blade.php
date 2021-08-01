<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Registro de Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'client.store', 'method' => 'POST','id' => 'formulario','class' => 'cmxform']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                {!! Form::label('name', 'Nombre',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre del Cliente', 'id' => 'name']) !!}
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                {!! Form::label('cedula', 'Cedula',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Cedula', 'id' => 'cedula']) !!}
                                    @error('cedula')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                {!! Form::label('ruc', 'Numero Ruc',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('ruc', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el RUC', 'id' => 'rucs']) !!}
                                    @error('ruc')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                {!! Form::label('email', 'Email',['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::email('email', null, ['class'=>'form-control','id' => 'email','placeholder'=>'Ingresar el Email']) !!}
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                {!! Form::label('direccion', 'Dirección',['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('address', null, ['class'=>'form-control','id' => 'addres','placeholder'=>'Ingresar su Dirección']) !!}
                                    @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                {!! Form::label('Telefono', 'Telefono',['class' => 'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('phone', null, ['class'=>'form-control','id' => 'phone','placeholder'=>'Ingresar su Telefono']) !!}
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    {!! Html::script('js/form-validation.js') !!}
    {!! Html::script('js/bt-maxLength.js') !!}
    <script>
        $('#staticBackdrop').on('shown.bs.modal', function () {
            $('#name').trigger('focus')
        });
    </script>
@endsection