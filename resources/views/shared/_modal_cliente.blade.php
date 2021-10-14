<x-modal name="{{ $id }}" title="{{ $title }}">
    {!! Form::open(['route' => 'client.store', 'method' => 'POST', 'id' => 'formulario-cliente']) !!}
        <meta name="_token" content="{!! csrf_token() !!}" />
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
</x-modal>
