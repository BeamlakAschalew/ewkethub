<?php

use Core\Database;

try {

    $config = require base_path("essentials/config.php");
    $database = new Database($config['database']);

    $categories = $database->query("SELECT * FROM category")->get();

    view('categories/index.view.php', ['categories' => $categories]);
} catch (Exception $e) {
    abort(['error' => $e->getMessage()], 500);
}
