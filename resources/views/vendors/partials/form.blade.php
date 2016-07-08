<div class="col l12 m12 s12">
    <div class="file-field input-field">
        <div class="wrapp_img left">
            <img src="{{ isset($item) ? $item->present()->cover('/assets/images/no-avatar2.png') : '/assets/images/no-avatar2.png' }}"
                 height="78" width="78" id="preview_image">
        </div>
        <div class="left">
            <div class="btn_ btn_base input_file xsmall">
                <span>Logo</span>
                <input type="file" name="image" class="avatar"
                       value="{{ isset($item) ? $item->present()->cover() : old('image') }}">
            </div>
        </div>
        <p class="left">* PNG, JPG minim 76x76px, proportie 1:1</p>
    </div>
</div>
<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">Denumirea</span>
        <input type="text" required name="name" placeholder="Ex: Bucuria"
               value="{{ isset($item) ? $item->name : old('name') }}">
        @include('partials.errors.error-field', ['field' => 'name'])
    </div>
</div>

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">EMAIL</span>
        <input type="email" required name="email" placeholder=""
               value="{{ isset($item) ? $item->email : old('email') }}">
        @include('partials.errors.error-field', ['field' => 'email'])
    </div>
</div>

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">TELEFON</span>
        <input type="tel" required name="phone" placeholder="Ex: 070 323 677"
               value="{{ isset($item) ? $item->phone : old('phone') }}">
        @include('partials.errors.error-field', ['field' => 'phone'])
    </div>
</div>
<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">DESCRIPTION</span>
        <textarea name="description" placeholder="">{{ isset($item) ? $item->description : old('description') }}</textarea>
        @include('partials.errors.error-field', ['field' => 'description'])
    </div>
</div>

@section('js')
    <script>
        $("input[name=image]").change(function() // Preview Image.
        {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview_image').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection