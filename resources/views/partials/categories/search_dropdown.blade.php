<div class="input-field select_categories">
    <select>
        <option value="" disabled selected>Toate categoriile</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>