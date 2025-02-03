<?php

try {

    if (isset($_SESSION['student'])) {
        unset($_SESSION['student']);
    }

    if (isset($_COOKIE['student'])) {
        setcookie('student', '', time() - 3600, '/');
    }

    redirect('/');
} catch (Exception $e) {
    abort(['error' => $e->getMessage()], 500);
}
