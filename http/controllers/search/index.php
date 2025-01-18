<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$searchTerm = $_GET['search-term'] ?? $_POST['search-term'];
view("search/index.view.php", ['searchTerm' => $searchTerm]);
