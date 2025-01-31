<?php

use Core\Database;

$errors = [];
$targetDir = "../../ewkethub_shared_assets/images/students/profile_images/";
$data = $_POST;
$config = require base_path("essentials/config.php");
$database = new Database($config["database"]);

$student = $database->query("SELECT * FROM student WHERE email = :email OR username = :username", [
    'email' => $_POST['email'],
    'username' => $_POST['username'],
])->find();

if ($student) {
    $errors['exists'] = 'Username or email is taken';
    view('auth/signup/index.view.php', ['errors' => $errors]);
    die();
}

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$file = $_FILES['profileImage'];
$fileName = null;
if (isset($file) && $file['error'] === 0) {
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = time() . '.' . $fileExtension;
    $fileTmpPath = $file['tmp_name'];
    $fileType = $file['type'];
    $targetFilePath = $targetDir . $fileName;

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            echo "File uploaded successfully: " . $targetFilePath;
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "Invalid file type. Please upload an image (JPEG, PNG, or GIF).";
    }
} else {
    echo "Error uploading the file. Error code: " . $file['error'];
}

$database->query(
    "INSERT INTO student (full_name, username, email, password, profile_picture_path, bio) VALUES (:full_name, :username, :email, :password, :profile_picture_path, :bio)",
    [
        'full_name' => $data['fullName'],
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        'profile_picture_path' => $fileName,
        'bio' => $data['bio']
    ]
)->find();

$studentId = $database->connection->lastInsertId();

$studentFind = $database->query(
    "SELECT * FROM student WHERE id = :id",
    ['id' => $studentId]
)->find();

setcookie("student", json_encode($studentFind), time() + (432000 * 30), "/");

Core\Session::set('message', [
    'type' => 'success',
    'content' => 'Signup successful.'
]);
redirect('/');
