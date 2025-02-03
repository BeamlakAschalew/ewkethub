<?php

use Core\Database;

try {

    $config = require base_path("essentials/config.php");
    $database = new Database($config['database']);

    $studentCourses = $database->query("SELECT course.name AS course_name, instructor.full_name AS instructor_name, course.price AS price, category.name AS category_name, course.course_thumbnail_path AS thumbnail_path, course.course_slug AS course_slug FROM course JOIN instructor ON course.instructor_id = instructor.id JOIN category ON course.category_id = category.id JOIN student_course ON student_course.course_id = course.id WHERE student_course.student_id = :student_id", [
        'student_id' => $_SESSION['student']['id']
    ])->get();

    view("my-courses/index.view.php", ['studentCourses' => $studentCourses]);
} catch (Exception $e) {
    abort(['error' => $e->getMessage()], 500);
}
