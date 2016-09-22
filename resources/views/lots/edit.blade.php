@extends('layout')

@section('css')
    {!!Html::style('/assets/css/dropzone.css')!!}
    {!!Html::style('/assets/plugins/materialize-colorpicker/dist/css/materialize-colorpicker.min.css')!!}
    {!!Html::style('/assets/plugins/materialize-colorpicker/prism/themes/prism.css')!!}
@endsection

@section('content')
    edit
@endsection

@section('js')
    {!!Html::script('/assets/plugins/pickadate/lib/translations/ro_RO.js')!!}
    {!!Html::script('/assets/js/dropzone.js')!!}
    {!!Html::script('/assets/plugins/materialize-colorpicker/prism/prism.js')!!}
    {!!Html::script('/assets/plugins/materialize-colorpicker/dist/js/materialize-colorpicker.min.js')!!}
@endsection

@section('scripts')
    @include('html.partials.js')
@endsection