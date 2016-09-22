// Ajax image upload for field type.

var uploadImageModel = {
    dev: 1,
    wrap_class: "preview_uploaded_box",
    size:{w: 200, h: 200}, // default size of preview image
    cropCoords: {},
    route: null,
    setCropCoords: function(e){
        uploadImageModel.cropCoords = {
            x: e.x,
            y: e.y,
            x2: e.x2,
            y2: e.y2,
            w: e.w,
            h: e.h
        }
    },
    getCropCoords: function(){
        return uploadImageModel.cropCoords;
    },
    setUploadRoute: function(route){
        if(uploadImageModel.route == null) {
            uploadImageModel.route = route;
        }
    }
};

var jcrop_api;

function ajaxUploadImage(btn) {
    (function ($) {
        var wrap = $(btn).parent();
        var input = wrap.find('input[type=file]');
        var out = wrap.find('div.output');

        uploadImageModel.setUploadRoute($(btn).data('save-action'));

        input.click();

        input.on('change', function () {
            var $this = $(this);
            input = this;
            var reader = new FileReader();

            if(input.files && input.files[0])
            {
                var $name = $this[0].files[0].name;

                reader.onload = function (e) {
                    var image = e.target.result;
                    var SEPARATOR = '<br>';

                    out.html(
                        '<div class="' + uploadImageModel.wrap_class + '" style="width:'+ uploadImageModel.size.w +'px;height:290px">'
                            + '<img src="' + image + '" width="' + uploadImageModel.size.w + '" height="' + uploadImageModel.size.h + '" style="float:left;border: 1px dashed #6bb3fa">'
                            + '<div class="btn-group-horizontal" style="margin-top: 10px">'
                                + '<a href="#" title="Crop" class="btn btn-flat btn-default" onclick="t_cropUploadedImage(this);return false;"><i class="fa fa-crop"></i></a>'
                                + '<a href="#" title="Delete" class="btn btn-flat btn-default" onclick="t_removeUploadedImage(this);return false;"><i class="fa fa-remove"></i></a>'
                                + '<a href="#" title="Save" class="btn btn-flat btn-default" onclick="t_uploadedImage(this);return false;"><i class="fa fa-save"></i></a>'
                                + SEPARATOR
                            + '</div>'
                            + SEPARATOR
                            + '<span style="float:left;width:100%">' + $name + '</span>'
                        + '</div>'
                    );
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    }(jQuery));
}

function t_removeUploadedImage(btn){
    if(confirm("Are you sure ?")){
        (function ($) {
            var $btn = $(btn);
            var block = $btn.parents(".preview_uploaded_box");

            //send ajax and remove image from table.

            block.remove();

            if(jcrop_api != undefined) {
                jcrop_api.destroy();
                jcrop_api = undefined;
            }
        }(jQuery));
    }
}

/**
 * On save button.
 *
 * @param btn
 */
function t_uploadedImage(btn){
    (function ($) {
        var $btn = $(btn);
        var block = $btn.parents(".preview_uploaded_box");

        //send ajax and remove image from table.
    }(jQuery));
}

function t_cropUploadedImage(btn, parent_class) {
    var $btn = $(btn);
    var crop_area =
        $btn.parents("." + uploadImageModel.wrap_class)
            .find('img');

    if(jcrop_api == undefined) { // is not created object
        crop_area.Jcrop({
            bgColor: 'white',
            bgOpacity: .4,
            onChange: function (event) {
                uploadImageModel.setCropCoords(event);
            },
            onSelect: function (event) {
                uploadImageModel.setCropCoords(event);
            },
            onRelease: function () {
                screenLog(uploadImageModel.getCropCoords());
                this.destroy();
                jcrop_api = undefined;
                // save cropped image instead of original
            }
        }, function () {
            jcrop_api = this;
        });
    } else {
        jcrop_api.release();
    }
}

function t_cropUploadGetSourceImage(){

}

function screenLog(msg){
    if(uploadImageModel.dev == 1)
    {
        return console.log(msg);
    }
}