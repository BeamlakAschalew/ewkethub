<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(base_path('views/partials/head.php')); ?>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
    <link rel="stylesheet" href="<?= base_url('views/course/styles.css') ?>">
    <title>Document</title>
</head>

<body>
    <?php require(base_path('views/partials/navigation.php')) ?>
    <main>
        <h1>Introduction to Web Development</h1>
        <div class="main-container">
            <div class="video-container">

                <video controls crossorigin playsinline class="plyr">
                    <source src="../../assets/videos/1.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="lessons-container">
                <div class="accordion">
                    <div class="section">
                        <div class="section-header active">
                            <h3>Section 1: Introduction</h3>
                            <i class="bi bi-chevron-down toggle-icon"></i>
                        </div>
                        <div class="section-content" style="display: block;">
                            <ul>
                                <li>
                                    <div class="lesson-title">Lesson 1.1: Introduction to the Course</div>
                                    <div class="duration" data-video-url="2.mp4">(5:00)</div>
                                </li>
                                <li>
                                    <div class="lesson-title">Lesson 1.2: Setting Up Your Environment</div>
                                    <div class="duration" data-video-url="3.mp4">(10:00)</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="section">
                        <div class="section-header">
                            <h3>Section 2: Getting Started</h3>
                            <i class="bi bi-chevron-down toggle-icon"></i>
                        </div>
                        <div class="section-content">
                            <ul>
                                <li>
                                    <div class="lesson-title">Lesson 2.1: Basics of HTML</div>
                                    <div class="duration" data-video-url="3.mp4">(15:00)</div>
                                </li>
                                <li>
                                    <div class="lesson-title">Lesson 2.2: Basics of CSS</div>
                                    <div class="duration" data-video-url="4.mp4">(20:00)</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php require(base_path('views/partials/footer.php')) ?>
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script src="<?= base_url('views/course/script.js'); ?>"></script>
    <script src="<?= base_url('views/partials/navigation.js'); ?>"></script>
</body>

</html>