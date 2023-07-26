<?php

require_once dirname(__DIR__, 1) . '/vendor/autoload.php';
require dirname(__DIR__, 1) . '/routes/web.php';
require __DIR__ . '/database.php';

$request_uri = $_SERVER['REQUEST_URI'];
$request_method = $_SERVER['REQUEST_METHOD'];

// удалить / перед ?
$request_uri = str_replace('/?', '?', $request_uri);

// разделим строку $request_uri по символу "?"
$request_uri_parts = explode('?', $request_uri);

// возьмем первый элемент массива - это и будет наш путь
$request_uri = $request_uri_parts[0];
$request = new \App\Http\Request\Request();

if (count($request_uri_parts) > 1) {
    parse_str($request_uri_parts[1], $query);
    $request->setQuery($query);
}
$find = null;
foreach ($routes as $route) {

    if ($request_uri === $route['uri'] && $request_method === $route['method']) {
        $find = true;
        $handler = $route['handler'];
        $controller = new $handler[0]($request);
        $action = $handler[1];
        $controller->$action();
        break;
    }
}

if (empty($find)) {
    throw new Exception('Путь не найден', http_response_code(422));
}