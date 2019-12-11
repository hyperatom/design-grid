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

use Illuminate\Http\Request;

$router->get('/', function (Request $req) use ($router) {
    $params = [
        'offsetLeft' => $req->get('offsetLeft', 0),
        'offsetTop' => $req->get('offsetTop', 0),
        'offsetRight' => $req->get('offsetRight', 0),
        'offsetBottom' => $req->get('offsetBottom', 0),
        'width' => $req->get('width', 'auto')
    ];

    return view('loader', $params);
});

$router->get('/test', function (Request $req) use ($router) {
    return view('frame', ['query' => http_build_query($req->all())]);
});
