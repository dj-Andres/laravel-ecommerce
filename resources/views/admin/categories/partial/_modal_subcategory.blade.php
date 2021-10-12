<x-modal name="{{ $id }}"  title="{{ $title }}">
    {!! Form::open(['route' => 'subcategories.store', 'method' => 'POST', 'id' => 'formularioSubcategory']) !!}
        <meta name="_token" content="{!! csrf_token() !!}" />
        <div class="modal-body">
            <div id="errors"></div>
            <input type="hidden"name="category_id"  id="category_id">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        </div>
    {!! Form::close() !!}
</x-modal>