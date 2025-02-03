<?php

use Core\Database;

$config = require base_path("essentials/config.php");
$database = new Database($config['database']);

$categories = $database->query("SELECT * FROM category")->get();

view('categories/index.view.php', ['categories' => $categories]);
