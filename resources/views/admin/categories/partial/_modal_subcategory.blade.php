<div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog" aria-labelledby="subcategoryModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subcategoryModal">Agregar Subcategoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'subcategories.store', 'method' => 'POST', 'id' => 'formularioSubcategory']) !!}
                <meta name="_token" content="{!! csrf_token() !!}" />
                <div class="modal-body">
                    <div id="errors"></div>
                    <input type="text"name="category_id" value={{ $category_id }}  id="category_id">
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
                    <button type="submit" class="btn btn-success" @if(isset($category_id)) data-category="{{ $category_id }}" @endif>Guardar</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>