<?php

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

function categoryIs($value) {
    return $_GET['category-slug'] == $value;
}

function abort($attributes = [], $code = 404) {
    http_response_code($code);
    extract($attributes);
    require base_path("views/{$code}.php");
    die();
}

function authorize($condition, $status = 404) {
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path($path) {
    return BASE_PATH . $path;
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

function getCurrentDate() {
    return date('Y-m-d');
}

function sanitise_form($formData) {
    $sanitisedData = [];

    foreach ($formData as $key => $value) {
        $sanitisedData[$key] = htmlspecialchars(trim($value));
    }

    return $sanitisedData;
}
