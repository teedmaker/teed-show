<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ($uri !== '/' && file_exists(__DIR__ .'/public'. $uri)) {
    return false;
}

$uri = trim($uri, '/');

$request  = $uri===''? 'home': $uri;
$request .= preg_match('/\//', $request)? '': '/index';
$request  = explode('/', $request);

$controller = $request[0];
$controller = str_replace(' ', '', ucwords( str_replace('-', ' ', $controller)));

array_shift($request);

$method = $request[0] ?? 'index';
$method = str_replace(' ', '', ucwords(str_replace('-', ' ', $method) ));
$method = lcfirst($method);

array_shift($request);

$data = $request;

//

$controller = new $controller;
$response = call_user_func_array([$controller, $method], $data);
