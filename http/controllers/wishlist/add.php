<?php

use Core\Database;

$data = sanitise_form($_POST);

$config = require base_path("essentials/config.php");
$database = new Database($config['database']);

$course = $database->query("SELECT * FROM course WHERE course_slug = :course_slug", [
    'course_slug' => $data['course_slug']
])->find();

$courseExists = $database->query("SELECT * FROM wishlist WHERE student_id = :student_id AND course_id = :course_id", [
    'student_id' => $_SESSION['student']['id'],
    'course_id' => $course['id']
])->find();

if ($courseExists) {
    echo json_encode(['success' => false, 'error' => 'Course already in wishlist']);
} else {
    $database->query('INSERT INTO wishlist (student_id, course_id) VALUES (:student_id, :course_id)', [
        'student_id' => $_SESSION['student']['id'],
        'course_id' => $course['id']
    ])->find();

    if ($database->statement->rowCount() > 0) {
        echo json_encode(['success' => true, 'error' => 'Course added to wishlist']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Couldn\'t add course to wishlist']);
    }
}
