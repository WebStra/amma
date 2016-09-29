<div class="col l12 m12 s12">
 <?php $fields = [ 'description', 'name', 'email', 'phone' ]; ?>
    @foreach($fields as $field)
        @include('partials.errors.settings-error', ['field' => $field])
    @endforeach
    <div class="file-field input-field">
        <div class="wrapp_img left settings_avatar_image">
            <?php $default_avatar = '/assets/images/no-avatar2.png'; ?>
            <img src="{{ isset($item) ? $item->present()->cover(null, $default_avatar) : $default_avatar}}" height="78" width="78" id="preview_image">
            <label for="photo">
                <i class="material-icons">assignment_ind</i>
            </label>
            <input type="file" id="photo" name="image" class="avatar" value="{{ Auth::user()->present()->cover()}}">
        </div>
        <p class="left settings_avatar_format">* PNG, JPG minim 76x76px, proportie 1:1</p>
    </div>
</div>
<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">Denumirea</span>
        <input type="text" required name="name" placeholder="Ex: Bucuria"
               value="{{ isset($item) ? $item->name : old('name') }}">
    </div>
</div>
<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">EMAIL</span>
        <input type="email" required name="email" placeholder=""
               value="{{ isset($item) ? $item->email : old('email') }}">
    </div>
</div>
<div class="col l6 m6 s12">
    <div class="input-field vendor_edit_phone">
        <span class="label">TELEFON</span>
        <input type="tel" required name="phone" placeholder="XXXXXXXX"
               value="{{ isset($item) ? $item->phone : old('phone') }}" length="8">
               <span class="country_code">+373</span>
    </div>
</div>
<div class="col l6 m6 s12">
    <div class="input-field">
        <span class="label">DESCRIPTION</span>
        <textarea class="vendor_edit materialize-textarea" name="description">{{ isset($item) ? $item->description : old('description') }}</textarea>
    </div>
</div>

