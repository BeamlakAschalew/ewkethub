<?php

$router->get('/', 'index.php');
$router->get('/login', 'auth/login.php');
$router->get('/signup', 'auth/signup.php');
$router->get('/home', 'home.php');