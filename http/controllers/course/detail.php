<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Core\Database;

$config = require base_path("essentials/config.php");
$database = new Database($config['database']);

$data = $_GET;

$courseInfo = $database->query("SELECT course.name AS course_name, course.id AS course_id, course.description AS course_description FROM course WHERE course.course_slug = :course_slug", [
    'course_slug' => $data['course-slug']
])->find();

$courseId = $courseInfo['course_id'];

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

// dd($sectionsAndLessons);

view('course/index.view.php', ['courseInfo' => $courseInfo, 'sectionsLessons' => $sectionsAndLessons]);
