<?php


use Core\Database;

$config = require base_path("essentials/config.php");
$database = new Database($config['database']);

$data = $_POST;

$courseInfo = $database->query("SELECT course.name AS course_name, course.course_slug AS course_slug, course.id AS course_id, course.description AS course_description, instructor.full_name AS instructor_name, instructor.username AS instructor_username, instructor.profile_picture_path AS instructor_profile_image, course_difficulty.name AS course_difficulty FROM course JOIN instructor ON course.instructor_id = instructor.id JOIN course_difficulty ON course.difficulty = course_difficulty.id WHERE course.course_slug = :course_slug", [
    'course_slug' => $data['course-slug']
])->find();

$courseId = $courseInfo['course_id'];

$enroll = $database->query('INSERT INTO student_course (student_id, course_id) VALUES (:student_id, :course_id)', [
    'student_id' => $_SESSION['student']['id'],
    'course_id' => $courseId
])->find();

if ($database->statement->rowCount() > 0) {
    Core\Session::set('message', [
        'type' => 'success',
        'content' => 'Course bought successfully.'
    ]);
    redirect("/course/{$data['course-slug']}");
} else {
    abort(['error' => 'Error purchasing course'], 500);
}
