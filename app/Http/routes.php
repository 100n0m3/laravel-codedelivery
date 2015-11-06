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

Route::get('/', function () {
    return view('app');
});

Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'middleware' => 'auth.checkrole:admin'
], function () {

    /** ------------------------------------------------------------------------
     *  Categories
     *  ------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CategoriesController@index']);
        Route::get('criar',           ['as' => 'create',  'uses' => 'CategoriesController@create']);
        Route::get('{id}',            ['as' => 'show',    'uses' => 'CategoriesController@show']);
        Route::post('salvar',         ['as' => 'store',   'uses' => 'CategoriesController@store']);
        Route::get('{id}/editar',     ['as' => 'edit',    'uses' => 'CategoriesController@edit']);
        Route::post('{id}/atualizar', ['as' => 'update',  'uses' => 'CategoriesController@update']);
        Route::get('{id}/remover',    ['as' => 'destroy', 'uses' => 'CategoriesController@destroy']);
    });

    /** ------------------------------------------------------------------------
     *  Products
     *  ------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/',               ['as' => 'index',   'uses' => 'ProductsController@index']);
        Route::get('criar',           ['as' => 'create',  'uses' => 'ProductsController@create']);
        Route::get('{id}',            ['as' => 'show',    'uses' => 'ProductsController@show']);
        Route::post('salvar',         ['as' => 'store',   'uses' => 'ProductsController@store']);
        Route::get('{id}/editar',     ['as' => 'edit',    'uses' => 'ProductsController@edit']);
        Route::post('{id}/atualizar', ['as' => 'update',  'uses' => 'ProductsController@update']);
        Route::get('{id}/remover',    ['as' => 'destroy', 'uses' => 'ProductsController@destroy']);
    });

    /** ------------------------------------------------------------------------
     *  Orders
     *  ------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/',               ['as' => 'index',   'uses' => 'OrdersController@index']);
        Route::get('criar',           ['as' => 'create',  'uses' => 'OrdersController@create']);
        Route::get('{id}',            ['as' => 'show',    'uses' => 'OrdersController@show']);
        Route::post('salvar',         ['as' => 'store',   'uses' => 'OrdersController@store']);
        Route::get('{id}/editar',     ['as' => 'edit',    'uses' => 'OrdersController@edit']);
        Route::post('{id}/atualizar', ['as' => 'update',  'uses' => 'OrdersController@update']);
        Route::get('{id}/remover',    ['as' => 'destroy', 'uses' => 'OrdersController@destroy']);
    });

    /** ------------------------------------------------------------------------
     *  Clients
     *  ------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
        Route::get('/',               ['as' => 'index',   'uses' => 'ClientsController@index']);
        Route::get('criar',           ['as' => 'create',  'uses' => 'ClientsController@create']);
        Route::get('{id}',            ['as' => 'show',    'uses' => 'ClientsController@show']);
        Route::post('salvar',         ['as' => 'store',   'uses' => 'ClientsController@store']);
        Route::get('{id}/editar',     ['as' => 'edit',    'uses' => 'ClientsController@edit']);
        Route::post('{id}/atualizar', ['as' => 'update',  'uses' => 'ClientsController@update']);
        Route::get('{id}/remover',    ['as' => 'destroy', 'uses' => 'ClientsController@destroy']);
    });

    /** ------------------------------------------------------------------------
     *  Cupoms
     *  ------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'cupoms', 'as' => 'cupoms.'], function () {
        Route::get('/',               ['as' => 'index',   'uses' => 'CupomsController@index']);
        Route::get('criar',           ['as' => 'create',  'uses' => 'CupomsController@create']);
        Route::get('{id}',            ['as' => 'show',    'uses' => 'CupomsController@show']);
        Route::post('salvar',         ['as' => 'store',   'uses' => 'CupomsController@store']);
        Route::get('{id}/editar',     ['as' => 'edit',    'uses' => 'CupomsController@edit']);
        Route::post('{id}/atualizar', ['as' => 'update',  'uses' => 'CupomsController@update']);
        Route::get('{id}/remover',    ['as' => 'destroy', 'uses' => 'CupomsController@destroy']);
    });
});

/** ----------------------------------------------------------------------------
 *  Customer Area
 *  ----------------------------------------------------------------------------
 */
Route::group([
    'prefix'     => 'customer',
    'as'         => 'customer.',
    'middleware' => 'auth.checkrole:client'
], function () {

    /** -----------------------------------------------------------------------
     *  Checkout
     *  -----------------------------------------------------------------------
     */
    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CheckoutController@index']);
        Route::get('criar',           ['as' => 'create',  'uses' => 'CheckoutController@create']);
        Route::get('{id}',            ['as' => 'show',    'uses' => 'CheckoutController@show']);
        Route::post('salvar',         ['as' => 'store',   'uses' => 'CheckoutController@store']);
    });
});

/** ----------------------------------------------------------------------------
 *  API
 *  ----------------------------------------------------------------------------
 */

Route::post('oauth/access_token', function () {
     return Response::json(Authorizer::issueAccessToken());
});

Route::group([
    'prefix'     => 'api',
    'as'         => 'api.',
    'middleware' => 'oauth'
], function () {

    /** -----------------------------------------------------------------------
     *  Orders
     *  -----------------------------------------------------------------------
     */
    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', function () {
            return [
                'id' => 1,
                'client' => 'User Client',
                'total' => 10
            ];
        });
    });
});
