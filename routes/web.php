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

$router->get('/grid', function (Request $req) use ($router) {
    $unitWidth = $req->get('unitWidth', 72);
    $gutterWidth = $req->get('gutterWidth', 6);
    $width = $req->get('width', 'auto');
    $offsetLeft = $req->get('offsetLeft', 0);
    $offsetRight = $req->get('offsetRight', 0);

    if ($req->has('gridX')) {
        $gridX = $req->get('gridX');
        $width = ($gridX * $unitWidth) + (($gridX-1) * $gutterWidth) + 1;
    }

    if ($req->has('center')) {
        $offsetLeft = $offsetLeft * 2;
        $offsetRight = $offsetRight * 2;
    }

    $params = [
        'lineWidth' => $req->get('lineWidth', 1),
        'lineXHex' => '%23' . $req->get('lineXHex', 'ff00ff'),
        'lineYHex' => '%23' . $req->get('lineYHex', '00ffff'),
        'center' => $req->has('center'),
        'offsetLeft' => $offsetLeft,
        'offsetRight' => $offsetRight,
        'offsetTop' => $req->get('offsetTop', 0),
        'offsetBottom' => $req->get('offsetBottom', 0),
        'width' => $width,
        'unitWidth' => $unitWidth,
        'gutterWidth' => $gutterWidth,
    ];

    return view('loader', $params);
});

$router->get('/', function (Request $req) use ($router) {
    return view('test', ['query' => http_build_query($req->all())]);
});
