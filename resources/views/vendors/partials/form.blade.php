<div class="col l12 m12 s12">
    <div class="file-field input-field">
        <div class="wrapp_img left">
            <img src="/assets/images/no-avatar2.png" height="78" width="78">
        </div>
        <div class="left">
            <div class="btn_ btn_base input_file xsmall">
                <span>Logo</span>
                <input type="file" name="image" class="avatar" value="{{ old('image') }}">
            </div>
        </div>
        <p class="left">* PNG, JPG minim 76x76px, proportie 1:1</p>
    </div>
</div>
<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">Denumirea</span>
        <input type="text" required name="name" placeholder="Ex: Bucuria" value="{{ old('name') }}">
        @include('partials.errors.error-field', ['field' => 'name'])
    </div>
</div>

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">EMAIL</span>
        <input type="email" required name="email" placeholder="" value="{{ old('email') }}">
        @include('partials.errors.error-field', ['field' => 'email'])
    </div>
</div>

<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">TELEFON</span>
        <input type="tel" required name="phone" placeholder="Ex: 070 323 677" value="{{ old('phone') }}">
        @include('partials.errors.error-field', ['field' => 'phone'])
    </div>
</div>
<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">DESCRIPTION</span>
        <textarea name="description" placeholder=""></textarea>
        @include('partials.errors.error-field', ['field' => 'description'])
    </div>
</div>