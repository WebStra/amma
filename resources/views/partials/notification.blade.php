@if(session()->has('status'))
    <span class="hidden" data-color="red" data-notification>{{ session()->get('status') }}</span>
@endif