<?php

use Core\Database;

try {

    $errors = [];
    $query = $_GET['query'];

    $config = require base_path("essentials/config.php");
    $database = new Database($config["database"]);

    $coursesResult = $database->query('SELECT * FROM course WHERE course.name LIKE :searchTerm OR course.description LIKE :courseDescription', ['searchTerm' => "%$query%", 'courseDescription' => "%$query%"])->get();
    $caregoriesResult = $database->query('SELECT * FROM category WHERE category.name LIKE :category', ['category' => "%$query%"])->get();

    $finalResult = ['courses' => $coursesResult, 'categories' => $caregoriesResult];
    echo json_encode($finalResult);
} catch (Exception $e) {
    abort(['error' => $e->getMessage()], 500);
}
