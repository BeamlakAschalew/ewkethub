<!DOCTYPE html>
<html lang="en">

<head>
    <?php require base_path('views/partials/head.php'); ?>
    <link rel="stylesheet" href="<?= base_url("views/categories/styles.css") ?>">
    <title>Categories</title>
</head>

<body>
    <?php require base_path('views/partials/navigation.php'); ?>
    <main class="main-container">
        <div class="inside-text">
            <h1>Categories</h1>
        </div>
        <div class="categories-container">
            <div class="categories">
                <?php foreach ($categories as $category) : ?>
                    <a href="<?= base_url("category/{$category['slug']}") ?>" class="category">
                        <div class="category-image" style="background-image: url('<?= base_url("assets/images/{$category['slug']}.jpg") ?>');"></div>
                        <h3><?= $category['name'] ?></h3>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <?php require base_path('views/partials/footer.php'); ?>
    <script src="<?= base_url("views/partials/navigation.js") ?>"></script>
</body>

</html>