@section('css')
    {!!Html::style('/assets/css/dropzone.css')!!}
@endsection

<form action="{{ route('add_product_image', ['product' => $item->id]) }}" class="dropzone product_gallery_dropzone" id="dropzone_form">
    <div class="fallback"></div>
    <input type="file" multiple id="images" style="display: none">
</form>
<br>
<?php $images = $item->images()->ranked('asc')->get(); ?>
{{--{{ (! count($images))? 'hidden': '' }}--}}
<div id="preview_container" class="dropzone preview-img-box">
    @if(count($images))
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