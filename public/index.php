<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';
require BASE_PATH . 'Core/Router.php';
require BASE_PATH . 'Core/Database.php';

session_start();

if (!isset($_SESSION['student'])) {
    if (isset($_COOKIE['student'])) {
        $userFromCookie = json_decode($_COOKIE['student'], true);
        $_SESSION['student']['id'] = $userFromCookie['id'];
        $_SESSION['student']['fullName'] = $userFromCookie['full_name'];
        $_SESSION['student']['email'] = $userFromCookie['email'];
        $_SESSION['student']['username'] = $userFromCookie['username'];
        $_SESSION['student']['profilePath'] = $userFromCookie['profile_picture_path'];
    }
}

$router = new \Core\Router();
require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);

