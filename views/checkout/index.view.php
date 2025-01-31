<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(base_path('views/partials/head.php')); ?>
    <title>Purchase <?= $courseInfo['course_name'] ?></title>
    <link rel="stylesheet" href="<?= base_url('views/checkout/styles.css') ?>">
</head>

<body>
    <?php require(base_path('views/partials/navigation.php')) ?>
    <main class="main-container">
        <div class="form-part">

        </div>
        <div class="image-part"></div>
    </main>
    <?php require(base_path('views/partials/footer.php')) ?>
</body>

</html>