<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Core\Database;

$config = require base_path("essentials/config.php");
$database = new Database($config['database']);

$data = $_GET;

$courseInfo = $database->query("SELECT course.name AS course_name, course.course_slug AS course_slug, course.id AS course_id, course.description AS course_description, course.price AS price, instructor.full_name AS instructor_name, instructor.username AS instructor_username, instructor.profile_picture_path AS instructor_profile_image, course_difficulty.name AS course_difficulty FROM course JOIN instructor ON course.instructor_id = instructor.id JOIN course_difficulty ON course.difficulty = course_difficulty.id WHERE course.course_slug = :course_slug", [
    'course_slug' => $data['course-slug']
])->find();

$courseId = $courseInfo['course_id'];

$loggedIn = isset($_SESSION['student']);

$studentsCount = $database->query('SELECT COUNT(*) AS students_count FROM student_course WHERE course_id = :course_id', ['course_id' => $courseId])->find()['students_count'];

if ($loggedIn) {
    $hasEntry = $database->query('SELECT * FROM student_course WHERE course_id = :course_id AND student_id = :student_id', [
        'course_id' => $courseId,
        'student_id' => $_SESSION['student']['id']
    ])->find();
    $hasEntry ? $paidFor = true : $paidFor = false;
} else {
    $paidFor = false;
}

$sections = $database->query("
    SELECT 
        section.id AS section_id,
        section.section_name,
        section.section_slug,
        section.description AS section_description
    FROM 
        section
    WHERE 
        section.course_id = :course_id
    ORDER BY 
        section.order
", ['course_id' => $courseId])->get();

$sectionsAndLessons = [];

foreach ($sections as $section) {
    $sectionId = $section['section_id'];
    $lessons = $database->query("
        SELECT 
            lesson.id AS lesson_id,
            lesson.name AS lesson_name,
            lesson.description AS lesson_description,
            lesson.lesson_slug,
            lesson.video_file_path,
            lesson.duration,
            lesson.order AS lesson_order
        FROM 
            lesson
        WHERE 
            lesson.section_id = :section_id
        ORDER BY 
            lesson.order
    ", ['section_id' => $sectionId])->get();

    $sectionsAndLessons[] = [
        'section' => $section,
        'lessons' => $lessons
    ];
}

view('course/index.view.php', ['courseInfo' => $courseInfo, 'sectionsLessons' => $sectionsAndLessons, 'paidFor' => $paidFor, 'studentsCount' => $studentsCount]);
