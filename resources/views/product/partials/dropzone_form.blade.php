@section('css')
    {!!Html::style('/assets/css/dropzone.css')!!}
@endsection

<h1>gallery:</h1>
<div id="preview_container" class="dropzone preview-img-box">
    @if(count($images = $item->images()->ranked('asc')->get()))
        @foreach($images as $image)
            <div class="preview-img-block dz-preview dz-processing dz-image-preview dz-success dz-complete"
                 id="item-{{ $image->id }}">
                <div class="dz-image" style="border-radius: 0">
                    <img src="{{ $image->present()->image() }}" data-dz-thumbnail width="200">
                </div>
                <span class="remove-image">remove</span>
            </div>
        @endforeach
    @endif
</div>
<br>
<form action="{{ route('add_product_image', ['product' => $item]) }}" class="dropzone" id="dropzone_form">
    <div class="fallback"></div>
    <input type="file" multiple id="images" style="display: none">
</form>