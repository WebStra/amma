<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

Breadcrumbs::register('expire_soon_products', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Oferte care exipra', route('expire_soon_products'));
});

Breadcrumbs::register('view_blog', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Blog', route('view_blog'));
});

Breadcrumbs::register('view_post', function ($breadcrumbs, $post) {
    $breadcrumbs->parent('view_blog');
    $breadcrumbs->push($post->title, route('view_post', $post->id));
});

Breadcrumbs::register('contacts', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Contacts', route('contacts'));
});

Breadcrumbs::register('frontend_vendors', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Vendors', route('vendors'));
});

Breadcrumbs::register('view_vendor_frontend', function ($breadcrumbs, $vendor) {
    $breadcrumbs->parent('view_blog');
    $breadcrumbs->push($vendor->name, route('view_vendor', $vendor->id));
});

Breadcrumbs::register('support', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Support', route('support'));
});

Breadcrumbs::register('show_page', function ($breadcrumbs, $static_page) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($static_page->title, route('show_page', $static_page->id));
});

Breadcrumbs::register('view_category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($category->present()->renderName(), route('view_category', [ $category->slug ]));
});

Breadcrumbs::register('view_vendor', function ($breadcrumbs, $vendor) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($vendor->present()->renderTitle(), route('view_vendor', $vendor->slug));
});

Breadcrumbs::register('view_sub_category', function ($breadcrumbs, $category, $subcategory) {
    $breadcrumbs->parent('view_category', $category);
    $breadcrumbs->push($subcategory->present()->renderName(), route('view_sub_category', [ $category->slug, $subcategory->slug ]));
});

//Breadcrumbs::register('view_lot', function ($breadcrumbs, $lot) {
//    if($lot->vendor)
//        $breadcrumbs->parent('view_vendor', $lot->vendor);
//
//    $breadcrumbs->push($lot->present->renderName(), route('view_lot', $lot->id));
//});
//
//Breadcrumbs::register('view_product', function ($breadcrumbs, $product) {
//    $breadcrumbs->parent('view_lot', $product->lot);
//    $breadcrumbs->push($product->name, route('view_product', $product->id));
//});

Breadcrumbs::register('my_vendors', function ($breadcrumbs) {
    //todo: dashoboard.
    $breadcrumbs->push('My Vendors', route('my_vendors'));
});

Breadcrumbs::register('create_vendor', function ($breadcrumbs) {
    //todo: dashoboard.
    $breadcrumbs->push('Vendor Create', route('create_vendor'));
});

Breadcrumbs::register('add_product', function ($breadcrumbs, $vendor) {
    $breadcrumbs->parent('view_vendor', $vendor);
    $breadcrumbs->push('Product create', route('add_product', $vendor->id));
});

Breadcrumbs::register('edit_product', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('view_product', $product);
    $breadcrumbs->push('Edit', route('edit_product', $product->id));
});

Breadcrumbs::register('vendors', function ($breadcrumbs) {
    $breadcrumbs->push('Vendors', route('vendors'));
});

Breadcrumbs::register('add_lot', function ($breadcrumbs, $vendor) {
    //todo: dashoboard.
    $breadcrumbs->parent('view_vendor', $vendor);
    $breadcrumbs->push('Create lot', route('add_lot', $vendor->slug));
});

Breadcrumbs::register('settings', function ($breadcrumbs) {
    //todo: dashoboard.
    $breadcrumbs->push('Settings Account', route('settings'));
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