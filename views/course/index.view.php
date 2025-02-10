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
        <div class="title-wishlist-container">
            <h2 class="main-title" data-course-slug="<?= $_GET['course-slug'] ?>" data-paid="<?= $paidFor ? 'true' : 'false' ?>" data-course-name="<?= $courseInfo['course_name'] ?>"> <?php if (count($sectionsLessons) == 0): ?><?= $courseInfo['course_name'] ?><?php else : ?><?= $courseInfo['course_name'] ?>: <?= $sectionsLessons[0]['lessons'][0]['lesson_name'] ?><?php endif; ?></h2>
            <?php if (isset($_SESSION['student'])) : ?> <div class="wishlist-button"><i class="bi-bookmark-<?= $isWishlisted ? 'dash' : 'plus' ?>-fill bi bookmark"></i> <?= $isWishlisted ? 'Remove from wishlist' : 'Add to wishlist' ?></div><?php endif ?>
        </div>
        <div class="main-container">
            <div class="video-container">
                <?php if (count($sectionsLessons) == 0): ?>
                    <div class="no-course-container">
                        <img src="<?= base_url('assets/images/no-course.png') ?>" alt="" class="no-course-image">
                        <h3>This course doesn't have any lessons yet</h3>
                    </div>
                <?php else: ?>
                    <video controls crossorigin playsinline class="plyr">
                        <source src="<?= base_url("ewkethub_shared_assets/videos/lesson_videos/{$sectionsLessons[0]['lessons'][0]['video_file_path']}") ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>
                <div class="course-info-box">
                    <p class="course-description"><?= $courseInfo['course_description'] ?></p>
                    <hr class="divider">
                    <div class="course-info">
                        <div class="course-info-item">
                            <div class="instructor-info">
                                <img src="<?= base_url("ewkethub_shared_assets/images/instructors/profile_images/{$courseInfo['instructor_profile_image']}") ?>" alt="" class="instructor-image">
                                <div class="instructor-text-info">
                                    <p class="instructor-name"><?= $courseInfo['instructor_name'] ?></p>
                                    <p style="margin-top: 0;">@<?= $courseInfo['instructor_username'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="course-info-item">
                            <i class="bi bi-people label"></i>
                            <p class="students-count"><?= $studentsCount ?> students</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lessons-container">
                <?php if ($paidFor == false): ?>
                    <div class="course-actions">
                        <?php if (isset($_SESSION['student'])) : ?>
                            <div class="course-action">
                                <form action="/course/<?= $courseInfo['course_slug'] ?>/enroll" method="post">
                                    <input type="hidden" name="coursePrice" value="<?= $courseInfo['price'] ?>">
                                    <input type="hidden" name="courseName" value="<?= $courseInfo['course_name'] ?>">
                                    <input type="submit" value="BUY NOW - <?= $courseInfo['price'] ?>birr" class="course-button enroll-button">
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="course-action">
                                <p>Please <a style="cursor: pointer;" href="/login">login</a> or <a style="cursor: pointer;" href="/signup">signup</a> to buy this course or to continue learning if you already bought the course.</p>
                            </div>
                        <?php endif; ?>
                        <div class="div-divider"></div>
                        <div class="course-action">
                            <div class="feature-container">
                                <i class="bi bi-reception-4 feature-icon"></i>
                                <p>Level: <?= $courseInfo['course_difficulty'] ?></p>
                            </div>
                        </div>
                        <div class="course-action">
                            <div class="feature-container">
                                <i class="bi bi-phone feature-icon"></i>
                                <p>Access on mobile, desktop, and TV</p>
                            </div>
                        </div>
                        <div class="course-action">
                            <div class="feature-container">
                                <i class="bi bi-phone-flip feature-icon"></i>
                                <p>Lifetime access of the course</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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
                                            <?php $j = 0;
                                            foreach ($section['lessons'] as $lesson): ?>
                                                <li class="<?= ($j == 0) ? 'active-lesson' : ''; ?>">
                                                    <div class="lesson-title"><?= $lesson['lesson_name'] ?></div>
                                                    <div class="duration" data-video-url="<?php if (isset($lesson['video_file_path'])) {
                                                                                                echo $lesson['video_file_path'];
                                                                                            } ?>">(<?= $lesson['duration'] ?>)<?php if ($paidFor == false && ($i != 0 || $j != 0)):  ?><i class="bi bi-lock-fill"></i><?php endif; ?></div>
                                                </li>
                                            <?php $j++;
                                            endforeach; ?>
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