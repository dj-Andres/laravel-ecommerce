<h4>Galeria de Imagenes</h4>
<div id="lightgallery" class="row lightGallery">
    @foreach ($product->images as $image)
        <a href="{{ $image->url }}" class="image-tile"><img src="{{ $image->url }}" alt="{{ $product->name }}"></a>
    @endforeach
</div>
