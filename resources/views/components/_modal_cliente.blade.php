<div class="modal fade" id="cliente-registro" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Clientes <i class="mr-3 fas fa-users"></i></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! Form::open(['route' => 'client.store', 'method' => 'POST', 'id' => 'formulario-cliente']) !!}
                <meta name="_token" content="{!! csrf_token() !!}"/>
                <div id="errors"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input id="name" class="form-control" type="text" name="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cedula</label>
                            <input id="cedula" class="form-control" type="text" name="cedula">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>N° Ruc</label>
                            <input id="ruc" class="form-control" type="text" name="ruc">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Dirección</label>
                            <input id="address" class="form-control" type="text" name="address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telefono</label>
                            <input id="phone" class="form-control" type="text" name="phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input id="email" class="form-control" type="email" name="email">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="guardar-client">Guardar</button>
            {!! Form::close() !!}
          </div>
        </div>
    </div>
</div>