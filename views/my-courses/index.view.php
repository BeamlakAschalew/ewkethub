<!DOCTYPE html>
<html lang="en">

<head>
    <?php require base_path('views/partials/head.php'); ?>
    <link rel="stylesheet" href="<?= base_url('views/my-courses/styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url("views/partials/course/course_card.css") ?>">
    <title>My Courses</title>
</head>

<body>
    <?php require base_path('views/partials/navigation.php'); ?>
    <main class="main-container">
        <h1>My courses</h1>

        <?php if (count($studentCourses) == 0) : ?>
            <div class="no-course">
                <h2>You have no courses purchased</h2>
            </div>
        <?php else : ?>
            <div class="courses-container">
                <div class="courses">
                    <?php foreach ($studentCourses as $course) :
                        require(base_path('views/partials/course/course_card.php'));
                    endforeach;
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <?php require base_path('views/partials/footer.php'); ?>
    <script src="<?= base_url('views/partials/navigation.js'); ?>"></script>
</body>

</html>