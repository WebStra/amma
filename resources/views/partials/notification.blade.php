@if(session()->has('status'))
    <span class="hidden" data-color="{{session()->get('color')}}" data-notification>{{ session()->get('status') }}</span>
@endif