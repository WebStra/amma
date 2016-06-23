<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Repositories\CategoryRepository;
use App\Repositories\PostsRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\VendorRepository;

/* ----------------------------------------------
 *  Route bindings.
 * ----------------------------------------------
 */
    Route::bind('category', function ($slug) {
        return (new CategoryRepository)->findBySlug($slug);
    });

    Route::bind('post', function ($slug) {
        return (new PostsRepository)->findBySlug($slug);
    });

    Route::bind('product', function ($id){
        return (new ProductsRepository)->find($id);
    });

    Route::bind('vendor', function ($slug){
        return (new VendorRepository)->find($slug);
    });

Route::multilingual(function () {
    Route::get('/', [
        'as' => 'home',
        'uses' => function () {
            return view('home');
        }
    ]);

    Route::get('category/{category}', [
        'as' => 'view_category',
        'uses' => 'CategoriesController@show'
    ]);

    Route::get('product/{product}', [
        'as' => 'view_product',
        'uses' => 'ProductsController@show'
    ]);

    Route::get('blog', [
        'as' => 'view_blog',
        'uses' => 'PostController@index'
    ]);

    Route::get('blog/{post}', [
        'as' => 'view_post',
        'uses' => 'PostController@show'
    ]);

    Route::group(['middleware' => 'auth'], function (){
        Route::get('vendor/create', [
            'as' => 'create_vendor',
            'uses' => 'VendorController@getCreate'
        ]);

        Route::post('vendor/create', [
            'as' => 'post_create_vendor',
            'uses' => 'VendorController@postCreate'
        ]);

        Route::get('vendor/{vendor}/edit', [
            'as' => 'edit_vendor',
            'uses' => 'VendorController@edit'
        ]);

        Route::post('vendor/{vendor}/edit', [
            'as' => 'update_vendor',
            'uses' => 'VendorController@update'
        ]);
        
        Route::get('my-vendors', [
            'as' => 'my_vendors',
            'uses' => 'DashboardController@myVendors'
        ]);
        
        Route::get('vendor/{vendor}/product/create', [
            'as' => 'add_product',
            'uses' => 'ProductsController@getCreate'
        ]);

        Route::group(['middleware' => 'accept-ajax'], function () {
            Route::post('product/{product}/add-color', [
                'as' => 'add_product_color',
                'uses' => 'ProductsController@addColor'
            ]);
    
            Route::post('product/{product}/remove-color', [
                'as' => 'remove_product_color',
                'uses' => 'ProductsController@removeColor'
            ]);
        });
        
        Route::post('vendor/{vendor}/product/{product}/create', [
            'as' => 'post_create_product',
            'uses' => 'ProductsController@postSave'
        ]);

        Route::get('product/{product}/edit', [
            'as' => 'edit_product',
            'uses' => 'ProductsController@getEditForm'
        ]);

        Route::post('product/{product}/edit', [
            'as' => 'update_product',
            'uses' => 'ProductsController@update'
        ]);
    });
    
    Route::get('vendors/view/{vendor}', [
        'as' => 'view_vendor',
        'uses' => 'VendorController@show'
    ]);

    /* ----------------------------------------------
     *  Auth routes.
     * ----------------------------------------------
     */
    Route::get('login', [
        'as' => 'get_login',
        'uses' => 'Auth\AuthController@getLogin'
    ]);

    Route::get('register', [
        'as' => 'get_register',
        'uses' => 'Auth\AuthController@getRegister'
    ]);

    Route::get('recover', [
        'as' => 'get_recover',
        'uses' => 'Auth\AuthController@getRecover'
    ]);

    Route::post('register', [
        'as' => 'post_register',
        'uses' => 'Auth\AuthController@postRegister'
    ]);

    Route::post('login', [
        'as' => 'post_login',
        'uses' => 'Auth\AuthController@postLogin'
    ]);

    Route::get('logout', [
        'as' => 'logout',
        'uses' => 'Auth\AuthController@logout'
    ]);
});