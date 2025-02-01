<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(base_path('views/partials/head.php')); ?>
    <link rel="stylesheet" href="<?= base_url('views/styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url('views/partials/course/course_card.css') ?>">
    <title>EwketHub</title>
</head>

<body>
    <?php require(base_path('views/partials/navigation.php')); ?>
    <main class="main-container">
        <div class="inside-wrapper">
            <div class="text-container">
                <h1>Online courses at your convinience</h1>
                <p>Master real world skills and knowledge without any disruption at your comfort zone</p>
                <?php if (!isset($_SESSION['student'])): ?>
                    <div class="action-container">
                        <a class="button login" href="/login">Login</a>
                        <a class="button signup" href="/signup">Signup</a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="image-container">
                <img src="../assets/images/online_learning.png" alt="" srcset="">
            </div>
        </div>
        <div class="motivational">
            <div class="feature"><img src="../assets/images/read.png" alt="">
                <p>
                    Learn the essential skills
                </p>
            </div>
            <div class="feature"><img src="../assets/images/badge.png" alt="">
                <p>Break the knowledge barrier</p>
            </div>
            <div class="feature"><img src="../assets/images/bar.png" alt="">
                <p>Get ready for your next career</p>
            </div>
            <div class="feature"><img src="../assets/images/graduation.png" alt="">
                <p>Master different skills</p>
            </div>
        </div>

        <div class="categories-container">
            <h2>Top Categories</h2>
            <div class="categories">
                <a href="/category/marketing" class="category">
                    <img src="../assets/images/email.png" alt="" class="category-image">
                    <p class="category-name">Marketing</p>
                </a>
                <a href="/category/development" class="category">
                    <img src="../assets/images/web-programming.png" alt="" class="category-image">
                    <p class="category-name">Development</p>
                </a>
                <a href="/category/music" class="category">
                    <img src="../assets/images/musical-note.png" alt="" class="category-image">
                    <p class="category-name">Music</p>
                </a>
                <a href="/category/art-illustration" class="category">
                    <img src="../assets/images/art.png" alt="" class="category-image">
                    <p class="category-name">Art & Illustration</p>
                </a>
                <a href="/category/design" class="category">
                    <img src="../assets/images/curve.png" alt="" class="category-image">
                    <p class="category-name">Design</p>
                </a>
                <a href="/category/film-video" class="category">
                    <img src="../assets/images/video-ico.png" alt="" class="category-image">
                    <p class="category-name">Film & Video</p>
                </a>
                <a href="/category/animation-3d" class="category">
                    <img src="../assets/images/animation.png" alt="" class="category-image">
                    <p class="category-name">Animation & 3D</p>
                </a>
                <a href="/category/data-science" class="category">
                    <img src="../assets/images/data.png" alt="" class="category-image">
                    <p class="category-name">Data Science</p>
                </a>
                <a href="/category/photography" class="category">
                    <img src="../assets/images/photography.png" alt="" class="category-image">
                    <p class="category-name">Photography</p>
                </a>
                <a href="/category/finance" class="category">
                    <img src="../assets/images/hand.png" alt="" class="category-image">
                    <p class="category-name">Finance</p>
                </a>
            </div>
        </div>

        <div class="latest-courses-container">
            <h2>Latest Courses</h2>
            <div class="courses">
                <?php foreach ($courses as $course) :
                    require(base_path('views/partials/course/course_card.php'));
                endforeach;
                ?>
            </div>
        </div>

    </main>
    <?php require(base_path('views/partials/footer.php')); ?>
    <script src="<?= base_url('views/partials/navigation.js'); ?>"></script>
</body>

</html>