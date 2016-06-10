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

Route::bind('category', function($slug)
{
    $categories = new CategoryRepository();
    
    return $categories->findBySlug($slug);
});

Route::multilingual(function() {
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
});