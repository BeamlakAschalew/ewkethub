<!DOCTYPE html>
<html lang="en">

<head>
    <?php require base_path('views/partials/head.php'); ?>
    <link rel="stylesheet" href="<?= base_url("views/category/styles.css") ?>">
    <link rel="stylesheet" href="<?= base_url("views/partials/course/course_card.css") ?>">
    <title><?= $categoryInfo['name'] ?> Courses</title>
</head>

<body>
    <?php require base_path('views/partials/navigation.php'); ?>
    <main class="main-container">
        <div class="top-banner" style="background-image: url('<?= base_url("assets/images/{$categoryInfo['slug']}.jpg") ?>');">
            <div class="inside-text">
                <h1><?= $categoryInfo['name'] ?></h1>
                <?php if (isset($categoryInfo['description'])) : ?>
                    <p class="category-description"><?= $categoryInfo['description'] ?></p>
                <?php endif ?>
            </div>
        </div>
        <?php if (count($categoryCourses) == 0) : ?>
            <div class="no-course">
                <h2>No courses available in this category</h2>
            </div>
        <?php else : ?>
            <div class="courses-container">
                <h2><?= $categoryInfo['name'] ?> Courses</h2>
                <div class="courses">
                    <?php foreach ($categoryCourses as $course) :
                        require(base_path('views/partials/course/course_card.php'));
                    endforeach;
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <?php require base_path('views/partials/footer.php'); ?>
    <script src="<?= base_url("views/partials/navigation.js") ?>"></script>
</body>

</html>