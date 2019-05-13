<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ($uri !== '/' && file_exists(__DIR__ .'/public'. $uri)) {
    return false;
}

require_once 'errors.php';
require_once 'defines.php';
require_once 'vendor/autoload.php';

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

//

if(!file_exists("src/Controllers/{$controller}")) {
    $controller = "Error";
    $method     = 'notFound';
}

$controller = "TeedShow\\Controllers\\{$controller}";
$controller = new $controller;
$response = call_user_func_array([$controller, $method], $request);
