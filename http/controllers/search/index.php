<?php

use Core\Database;

try {
    $searchTerm = $_GET['search-term'] ?? $_POST['search-term'];
    $config = require base_path("essentials/config.php");
    $database = new Database($config["database"]);

    $courses = $database->query("SELECT course.name AS course_name, instructor.full_name AS instructor_name, course.price AS price, category.name AS category_name, course.course_thumbnail_path AS thumbnail_path, course.course_slug AS course_slug FROM course JOIN instructor ON course.instructor_id = instructor.id JOIN category ON course.category_id = category.id WHERE course.name LIKE :search_term", ['search_term' => "%$searchTerm%"])->get();
    view("search/index.view.php", ['searchTerm' => $searchTerm, 'courses' => $courses]);
} catch (Exception $e) {
    abort(['error' => $e->getMessage()], 500);
}
