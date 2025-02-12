<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

use Core\Database;

try {

    $errors = [];
    $data = sanitise_form($_POST);
    $config = require base_path("essentials/config.php");
    $database = new Database($config["database"]);

    $student = $database->query("SELECT * FROM student WHERE email = :email OR username = :username", [
        'email' => $data['emailUsername'],
        'username' => $data['emailUsername'],
    ])->find();

    if (!$student) {
        $errors['noUser'] = 'No user found with your username';
        view('auth/login/index.view.php', ['errors' => $errors]);
        die();
    }

    if ($student) {
        if (!password_verify($data['password'], $student['password'])) {
            $errors['incorrectPassword'] = 'Incorrect password';
            view('auth/login/index.view.php', ['errors' => $errors]);
            die();
        }
    }

    setcookie("student", json_encode($student), time() + (432000 * 30), "/");

    Core\Session::set('message', [
        'type' => 'success',
        'content' => 'Login successful.'
    ]);

    redirect('/');
} catch (Exception $e) {
    abort(['error' => $e->getMessage()], 500);
}
