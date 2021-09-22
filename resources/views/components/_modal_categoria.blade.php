<div class="modal fade" id="categoria-registro" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Categorias <i class="mr-3 fas fa-tag"></i></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! Form::open(['route' => 'client.store', 'method' => 'POST', 'id' => 'formulario-categoria']) !!}
                <meta name="_token" content="{!! csrf_token() !!}"/>
                <div id="errors"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            {!! Form::label('name', 'Nombre',['class' => 'required']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control letters', 'placeholder' => 'Nombre de la Categoria','id' =>'name-categoria']) !!}
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="guardar-categoria">Guardar</button>
            {!! Form::close() !!}
          </div>
        </div>
    </div>
</div>