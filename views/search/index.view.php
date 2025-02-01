<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(base_path('views/partials/head.php')); ?>
    <link rel="stylesheet" href="<?= base_url('views/search/styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url('views/partials/course/course_card.css') ?>">
    <title>Search results "<?php echo $searchTerm ?>"</title>
</head>

<body>
    <?php require(base_path('views/partials/navigation.php')) ?>
    <main class="main-container">
        <h2><?= count($courses) ?> Results for "<?= $searchTerm ?>"</h2>
        <div class="grid-container">
            <!-- <div class="filter-side">
                <div class="dropdown">
                    <label for="sort">Sort by:</label>
                    <select id="sort" class="dropdown-select">
                        <option value="relevant">Most Relevant</option>
                        <option value="viewed">Most Viewed</option>
                        <option value="rated">Highest Rated</option>
                        <option value="newest">Newest</option>
                        <option value="oldest">Oldest</option>
                    </select>
                </div>

                <div class="radio-group">
                    <span>Difficulty Level:</span>
                    <label>
                        <input type="radio" name="level" value="all" checked>
                        <span>All Levels</span>
                    </label>
                    <label>
                        <input type="radio" name="level" value="beginner">
                        <span>Beginner</span>
                    </label>
                    <label>
                        <input type="radio" name="level" value="intermediate">
                        <span>Intermediate</span>
                    </label>
                    <label>
                        <input type="radio" name="level" value="advanced">
                        <span>Advanced</span>
                    </label>
                </div>

                <div class="price-range">
                    <label for="price">Max price:</label>
                    <input type="range" id="price" min="0" max="1000" step="50" value="500">
                    <div class="price-values">
                        <span>$0</span>
                    </div>
                </div>
            </div> -->
            <div class="results-section">
                <div class="courses">
                    <?php foreach ($courses as $course)
                        require(base_path('views/partials/course/course_card.php'))
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php require(base_path('views/partials/footer.php')) ?>
    <script src="<?= base_url('views/partials/navigation.js'); ?>"></script>
</body>


</html>