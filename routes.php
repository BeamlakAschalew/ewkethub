<?php

$router->get('/', 'index.php');

$router->get('/signup', 'auth/signup.php');
$router->get('/login', 'auth/login.php');

$router->get('/course/{course-slug}', 'course/detail.php');

$router->post('/search/{search-term}', 'search/index.php');
$router->get('/search/{search-term}', 'search/index.php');
$router->get('/live/{query}', 'search/live.php');

$router->get('/category/{category-slug}', 'category/index.php');
