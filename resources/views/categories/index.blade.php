@extends('layout')

<?php $categoryable_products = $category->categoryables()->elementType(\App\Product::class)->get(); ?>

@section('js')
    {!!Html::script('/assets/plugins/jquery_query/jquery.query-object.js')!!}
@endsection

@section('content')
    <section class="history_buy">
        <div class="container">
            <div class="row">
                @include('categories.partials.filters')

                <div class="col l9 m7 s12">
                    @include('categories.partials.sub_categories')

                    @include('categories.partials.sort_form')

                    <div class="filter-result">
                        @include('categories.partials.filter_result')
                    </div><!--filter result block-->
                </div><!--right bl ock-->
            </div>
        </div>
    </section>
@endsection