<?php
use App\Repositories\TranslateRepository;


Breadcrumbs::register('home', function ($breadcrumbs, $key = 'breadcrumbs_home') {
    $repository = new TranslateRepository();
    $breadcrumbs->push($repository->getKey($key)->value, route('home'));
});


Breadcrumbs::register('expire_soon_products', function ($breadcrumbs, $key = 'breadcrumbs_offerts') {
    $repository = new TranslateRepository();
    $breadcrumbs->parent('home');
    $breadcrumbs->push($repository->getKey($key)->value, route('expire_soon_products'));
});

Breadcrumbs::register('view_blog', function ($breadcrumbs, $key = 'breadcrumbs_blog') {
    $repository = new TranslateRepository();
    $breadcrumbs->parent('home');
    $breadcrumbs->push($repository->getKey($key)->value, route('view_blog'));
});

Breadcrumbs::register('view_post', function ($breadcrumbs, $post) {
    $repository = new TranslateRepository();
    $breadcrumbs->parent('view_blog');
    $breadcrumbs->push($post->title, route('view_post', $post->id));
});

Breadcrumbs::register('contacts', function ($breadcrumbs, $key = 'breadcrumbs_contacts') {
    $repository = new TranslateRepository();
    $breadcrumbs->parent('home');
    $breadcrumbs->push($repository->getKey($key)->value, route('contacts'));
});

Breadcrumbs::register('frontend_vendors', function ($breadcrumbs, $key = 'breadcrumbs_vendors') {
    $repository = new TranslateRepository();
    $breadcrumbs->parent('home');
    $breadcrumbs->push($repository->getKey($key)->value, route('vendors'));
});

Breadcrumbs::register('view_vendor_frontend', function ($breadcrumbs, $vendor) {
    $repository = new TranslateRepository();
    $breadcrumbs->parent('view_blog');
    $breadcrumbs->push($vendor->name, route('view_vendor', $vendor->id));
});

Breadcrumbs::register('support', function ($breadcrumbs, $key = 'breadcrumbs_support') {
    $repository = new TranslateRepository();
    $breadcrumbs->parent('home');
    $breadcrumbs->push($repository->getKey($key)->value, route('support'));
});

Breadcrumbs::register('show_page', function ($breadcrumbs, $static_page) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($static_page->title, route('show_page', $static_page->id));
});

Breadcrumbs::register('view_category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($category->present()->renderName(), route('view_category', [ $category->slug ]));
});

Breadcrumbs::register('view_sub_category', function ($breadcrumbs, $category, $subcategory) {
    $breadcrumbs->parent('view_category', $category);
    $breadcrumbs->push($subcategory->present()->renderName(), route('view_sub_category', [ $category->slug, $subcategory->slug ]));
});

Breadcrumbs::register('view_lot', function ($breadcrumbs, $lot) {

    if($lot->vendor)
        $breadcrumbs->parent('view_lot', $lot->vendor);

    $breadcrumbs->push($lot->name, route('view_lot', $lot->id));
});

Breadcrumbs::register('view_product', function ($breadcrumbs, $product) {
    if($product->lots)
        $breadcrumbs->parent('view_lot', $product->lot);

    $breadcrumbs->push($product->name, route('view_product', $product->id));
});

Breadcrumbs::register('my_vendors', function ($breadcrumbs) {
    //todo: dashoboard.
    $breadcrumbs->push('My Vendors', route('my_vendors'));
});

Breadcrumbs::register('create_vendor', function ($breadcrumbs) {
    //todo: dashoboard.
    $breadcrumbs->push('Vendor Create', route('create_vendor'));
});

Breadcrumbs::register('view_single_prod_spec', function ($breadcrumbs,$involve) {
    //todo: dashoboard.
    $breadcrumbs->push('Produs Comandat', route('view_single_prod_spec',['involve'=>$involve]));
});

Breadcrumbs::register('vendors', function ($breadcrumbs, $key = 'breadcrumbs_vendors') {
    $repository = new TranslateRepository();
    $breadcrumbs->push($repository->getKey($key)->value, route('vendors'));
});

Breadcrumbs::register('add_lot', function ($breadcrumbs, $vendor) {
    //todo: dashoboard.
    $breadcrumbs->parent('view_vendor', $vendor);
    $breadcrumbs->push('Create lot', route('add_lot', $vendor->slug));
});

Breadcrumbs::register('settings', function ($breadcrumbs, $key = 'breadcrumbs_settings') {
    $repository = new TranslateRepository();

    $breadcrumbs->push($repository->getKey($key)->value, route('settings'));
});

Breadcrumbs::register('user_password', function ($breadcrumbs, $key = 'breadcrumbs_user_password') {
    $repository = new TranslateRepository();

    $breadcrumbs->push($repository->getKey($key)->value, route('user_password'));
});

Breadcrumbs::register('my_involved', function ($breadcrumbs) {
    //todo: dashoboard.
    $breadcrumbs->push('My Involved', route('my_involved'));
});

Breadcrumbs::register('my_products', function ($breadcrumbs) {
    //todo: dashoboard.
    $breadcrumbs->push('My Products', route('my_products'));
});

Breadcrumbs::register('my_lots', function ($breadcrumbs) {
    //todo: dashoboard.
    $breadcrumbs->push('My Lots', route('my_lots'));
});

Breadcrumbs::register('edit_vendor', function ($breadcrumbs, $vendor) {
    //todo: dashoboard.
    $breadcrumbs->push('Edit Vendor', route('edit_vendor', $vendor->id));
});