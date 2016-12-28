<div class="input-field select_categories">
    <select name="category">
        <option value="" disabled selected>{!! $meta->getMeta('search_bar_categories') !!}</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                    {{ (isset($_GET['category'])) ? ($_GET['category'] == $category->id) ? 'selected': '' : '' }}
            >{{ $category->name }}</option>
        @endforeach
    </select>
</div>