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
$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => env('API_VERSION', 'v1')], function($router)
{
    $router->get('cocktails', 'CocktailController@list');
    $router->get('cocktails/{id:[0-9]+}', 'CocktailController@index');
    $router->get('cocktails/random', 'CocktailController@randomList');
    $router->get('tags', 'TagController@list');
    $router->get('tags/popular', 'TagController@popularList');
    $router->get('tag_categories', 'TagCategoryController@list');
    $router->get('tag_categories/popular', 'TagCategoryController@popularList');
});
