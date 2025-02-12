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

if (! $courseExists) {
    echo json_encode(['success' => false, 'error' => 'Course doesn\'t exist in wishlist']);
} else {
    $database->query('DELETE FROM wishlist WHERE student_id = :student_id AND course_id = :course_id', [
        'student_id' => $_SESSION['student']['id'],
        'course_id' => $course['id']
    ])->find();

    if ($database->statement->rowCount() > 0) {
        echo json_encode(['success' => true, 'error' => 'Removed course from wishlist']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Couldn\'t remove course from wishlist']);
    }
}
