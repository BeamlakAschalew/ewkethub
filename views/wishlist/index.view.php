<!DOCTYPE html>
<html lang="en">

<head>
    <?php require base_path('views/partials/head.php'); ?>
    <link rel="stylesheet" href="<?= base_url('views/wishlist/styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url("views/wishlist/course_card.css") ?>">
    <title>My wishlist</title>
</head>

<body>
    <?php require base_path('views/partials/navigation.php'); ?>
    <main class="main-container">
        <h1>My wishlist</h1>

        <?php if (count($studentWishlist) == 0) : ?>
            <div class="no-course">
                <h2>You have no courses on your wishlist</h2>
            </div>
        <?php else : ?>
            <div class="courses-container">
                <div class="courses">
                    <?php foreach ($studentWishlist as $course) :
                        require(base_path('views/wishlist/course_card.php'));
                    endforeach;
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <?php require base_path('views/partials/footer.php'); ?>
    <script src="<?= base_url("views/wishlist/script.js") ?>"></script>
</body>

</html>