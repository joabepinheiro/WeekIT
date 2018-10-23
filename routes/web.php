<?php

use \Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

foreach (\App\Resource::all() as $resource){
    $route = Route::match($resource->method, $resource->uri, $resource->controller.'@'.$resource->action)->name($resource->nome);

    if(!empty($resource->middleware)){
        foreach (explode(',', $resource->middleware) as $middleware){
            $route->middleware($middleware);
        }
    }
}