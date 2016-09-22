<div class="upload-image-canvas">
    <div class="output"></div>
    <input type="file" data-name="{{ $name }}"
           class="ajax_image_upload hidden">
    <a href="#upload_image" onclick="ajaxUploadImage(this);return false;"
       class="btn btn-flat btn-linkedin" data-save-action="{{ route('admin_model_create_save', ['page' => 'asd']) }}">
        <i class="fa fa-upload"></i>&nbsp;Upload
    </a>
</div>