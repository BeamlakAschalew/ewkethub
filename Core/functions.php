<?php

use Core\Response;

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($attributes = [], $code = 404) {
    http_response_code($code);
    extract($attributes);
    require base_path("views/{$code}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN) {
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path($path) {
    return BASE_PATH . $path;
}

function base_asset_path($path) {
    return __DIR__ . '/../../' . $path;
}

function get_shared_asset($relative_path) {
    // Navigate up from project root to sibling directory
    $shared_root = dirname(__DIR__, 2) . '/ewkethub_shared_assets';
    $full_path = $shared_root . '/' . ltrim($relative_path, '/');

    // Verify file exists for safety
    return file_exists($full_path) ? $full_path : null;
}

function web_asset($relative_path) {
    // Generate relative URL path
    return "/../ewkethub_shared_assets/" . ltrim($relative_path, '/');
}

function view($path, $attributes = []) {
    extract($attributes);

    require base_path('views/' . $path);
}

function redirect($path) {
    header("location: {$path}");
    exit();
}

function base_url($path = '') {
    $basePath = str_replace('/public', '', dirname($_SERVER['SCRIPT_NAME']));
    return rtrim($basePath, '/') . '/' . ltrim($path, '/');
}

function base_path_display() {
    return str_replace('/public', '', dirname($_SERVER['SCRIPT_NAME']));
}

function getCurrentDate() {
    return date('Y-m-d');
}


function getAssetsDir() {
    return dirname(dirname(dirname(base_path(''))));
}

// function old($key, $default = '')
// {
//     return Core\Session::get('old')[$key] ?? $default;
// }