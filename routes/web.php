<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/board', 'BoardController@index');
$router->get('/board/{board}', 'BoardController@show');
$router->post('/board', 'BoardController@store');
$router->put('/board/{board}', 'BoardController@update');
$router->delete('/board/{board}', 'BoardController@destroy');

