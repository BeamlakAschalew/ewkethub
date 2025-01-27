<!DOCTYPE html>
<html lang="en">

<head>
    <?php require(base_path('views/partials/head.php')); ?>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
    <link rel="stylesheet" href="<?= base_url('views/course/styles.css') ?>">
    <title><?= $courseInfo['course_name'] ?></title>
</head>

<body>
    <?php require(base_path('views/partials/navigation.php')) ?>
    <main>
        <h2><?= $courseInfo['course_name'] ?></h2>
        <div class="main-container">
            <div class="video-container">

                <video controls crossorigin playsinline class="plyr">
                    <source src="<?= base_url("ewkethub_shared_assets/videos/lesson_videos/{$sectionsLessons[0]['lessons'][0]['video_file_path']}") ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="lessons-container">
                <div class="accordion">
                    <?php if (count($sectionsLessons) == 0): ?>
                        <div class="no-sections">There are no sections</div>
                    <?php else: ?>
                        <?php $i = 0;
                        foreach ($sectionsLessons as $section): ?>
                            <div class="section">
                                <div class="section-header <?= ($i == 0) ? 'active' : ''; ?>">
                                    <h3><?= $section['section']['section_name'] ?></h3>
                                    <i class="bi bi-chevron-down toggle-icon"></i>
                                </div>
                                <div class="section-content">
                                    <?php if (count($section['lessons']) == 0): ?>
                                        <div class="no-lessons">There are no lessons</div>
                                    <?php else: ?>
                                        <ul>
                                            <?php foreach ($section['lessons'] as $lesson): ?>
                                                <li>
                                                    <div class="lesson-title"><?= $lesson['lesson_name'] ?></div>
                                                    <div class="duration" data-video-url="<?= $lesson['video_file_path'] ?>">(<?= $lesson['duration'] ?>)</div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php $i++;
                        endforeach; ?>
                    <?php endif; ?>
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