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
use App\Repositories\InvolvedRepository;
use App\Repositories\PagesRepository;
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

    Route::bind('static_page', function ($slug){
        return (new PagesRepository())->find($slug);
    });

    Route::bind('involved', function ($id){
        return (new InvolvedRepository())->find($id);
    });

Route::multilingual(function () {
    Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]);
    
    Route::get('page/{static_page}.html', [
        'as' => 'show_page',
        'uses' => 'PagesController@show'
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
    
    Route::get('vendors', [
        'as' => 'vendors',
        'uses' => 'VendorController@index'
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

        Route::get('my-vendors', [
            'as' => 'my_vendors',
            'uses' => 'DashboardController@myVendors'
        ]);

        Route::get('my-products', [
            'as' => 'my_products',
            'uses' => 'DashboardController@myProducts'
        ]);

        Route::get('my-involved', [
            'as' => 'my_involved',
            'uses' => 'DashboardController@myInvolved'
        ]);


/*-------Account Settings---------*/


        Route::get('settings', [
            'as' => 'settings',
            'uses' => 'DashboardController@accountsettings'
        ]);

         Route::post('setupdate', [
            'as' => 'setupdate',
            'uses' => 'DashboardController@update'
        ]);


/*-----End--account Settings---------*/




        Route::group(['middleware' => 'can_handle_action:vendor'], function ()
        {
            Route::get('vendor/{vendor}/edit', [
                'as' => 'edit_vendor',
                'uses' => 'VendorController@edit'
            ]);

            Route::post('vendor/{vendor}/edit', [
                'as' => 'update_vendor',
                'uses' => 'VendorController@update'
            ]);
        });

        Route::group(['middleware' => 'can_handle_action:product'], function () // For product only
        {
            Route::get('product/{product}/edit', [
                'as' => 'edit_product',
                'uses' => 'ProductsController@getEditForm'
            ]);

            Route::post('product/{product}/edit', [
                'as' => 'update_product',
                'uses' => 'ProductsController@update'
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

                Route::post('product/{product}/add-image', [
                    'as' => 'add_product_image',
                    'uses' => 'ProductsController@addImage'
                ]);

                Route::post('product/{product}/remove-image', [
                    'as' => 'remove_product_image',
                    'uses' => 'ProductsController@removeImage'
                ]);

                Route::post('product/{product}/remove-spec', [
                    'as' => 'remove_product_spec',
                    'uses' => 'ProductsController@removeSpec'
                ]);

                Route::post('product/{product}/image-sort', [
                    'as' => 'sort_product_image',
                    'uses' => 'ProductsController@saveImagesOrder'
                ]);
            });
        });

        Route::get('vendor/{vendor}/product/create', [
            'as' => 'add_product',
            'uses' => 'ProductsController@getCreate'
        ]);
        
        Route::post('involve/product/{product}', [
            'as' => 'involve_product',
            'middleware' => 'can_involve_product',
            'uses' => 'UsersController@involveProductOffer'
        ]);

        Route::post('involve/exit/{involved}', [
            'as' => 'involve_product_cancel',
            'uses' => 'UsersController@exitProductOffer'
        ]);
        
        Route::post('vendor/{vendor}/product/{product}/create', [
            'as' => 'post_create_product',
            'uses' => 'ProductsController@create'
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

    Route::get('verified/{confirmationCode}', [
        'as' => 'verify_email',
        'uses' => 'Auth\VerifyUserController@confirm'
    ]);
    
    Route::group(['middleware' => 'auth'], function () {
        Route::get('confirmation-code/resend', [
            'as' => 'resend_verify_email_form',
            'uses' => 'Auth\VerifyUserController@resendVerify'
        ]);

        Route::post('confirmation-code/resend', [
            'as' => 'resend_verify_email',
            'uses' => 'Auth\VerifyUserController@resendConfirmationCode'
        ]);
    });
});