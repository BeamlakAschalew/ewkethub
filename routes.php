<?php

$router->get('/', 'index.php');

$router->get('/signup', 'auth/signup/signup.php');
$router->post('/signup', 'auth/signup/create.php');
$router->get('/login', 'auth/login/login.php');
$router->post('/login', 'auth/login/create.php');
$router->post('/logout', 'auth/logout.php');

$router->get('/course/{course-slug}', 'course/detail.php');
$router->post('/course/{course-slug}/enroll', 'enroll/enroll.php');

$router->get('/category/{category-slug}', 'category/index.php');

$router->post('/search/{search-term}', 'search/index.php');
$router->get('/search/{search-term}', 'search/index.php');
$router->get('/live/{query}', 'search/live.php');

$router->get('/category/{category-slug}', 'category/index.php');
