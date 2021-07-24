<div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Actualizar datos de empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::model($business, ['route' => ['business.update', $business], 'method' => 'PUT', 'files' => true]) !!}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $business->name }}" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{ $business->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" name="address" id="address" value="{{ $business->address }}" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="ruc">Numero de RUC</label>
                        <input type="text" class="form-control" name="ruc" id="ruc" value="{{ $business->ruc }}" aria-describedby="helpId">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title d-flex">Logo</h5>
                        <input type="file" name="logo" id="picture" class="dropify" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
