<?php

if (isset($_SESSION['student'])) {
    unset($_SESSION['student']);
}

if (isset($_COOKIE['student'])) {
    setcookie('student', '', time() - 3600, '/');
}

redirect('/');