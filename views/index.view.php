<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'partials/head.php'; ?>
    <link rel="stylesheet" href="<?= base_url('views/styles.css') ?>">
    <title>EwketHub</title>
</head>

<body>
    <?php require 'partials/navigation.php'; ?>
    <main class="main-container">
        <div class="inside-wrapper">
            <div class="text-container">
                <h1>Online courses at your convinience</h1>
                <p>Master real world skills and knowledge without any disruption at your comfort zone</p>
                <div class="action-container">
                    <a class="button login" href="/login">Login</a>
                    <a class="button signup" href="/signup">Signup</a>
                </div>
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
                <div class="category">
                    <img src="" alt="" class="category-image">
                    <p class="category-name">Marketing</p>
                </div>
                <div class="category">
                    <img src="" alt="" class="category-image">
                    <p class="category-name">Development</p>
                </div>
                <div class="category">
                    <img src="" alt="" class="category-image">
                    <p class="category-name">Music</p>
                </div>
                <div class="category">
                    <img src="" alt="" class="category-image">
                    <p class="category-name">Art & Illustration</p>
                </div>
                <div class="category">
                    <img src="" alt="" class="category-image">
                    <p class="category-name">Design</p>
                </div>
                <div class="category">
                    <img src="" alt="" class="category-image">
                    <p class="category-name">Film & Video</p>
                </div>
                <div class="category">
                    <img src="" alt="" class="category-image">
                    <p class="category-name">Animation & 3D</p>
                </div>
                <div class="category">
                    <img src="" alt="" class="category-image">
                    <p class="category-name">Data Science</p>
                </div>
                <div class="category">
                    <img src="" alt="" class="category-image">
                    <p class="category-name">Photography</p>
                </div>
                <div class="category">
                    <img src="" alt="" class="category-image">
                    <p class="category-name">Finance</p>
                </div>
            </div>
        </div>

        <div class="top-courses-container">
            <h2>Top Courses</h2>
            <div class="courses">
                <div class="course">
                    <div class="course-image-container">
                        <img
                            class="course-image"
                            src="../../assets/images/c5.webp"
                            alt="" />
                    </div>
                    <div class="course-text">
                        <div class="course-title">
                            Web development
                        </div>

                        <div class="course-author">Dr. Angela Yu</div>
                        <div class="course-price">300birr</div>
                        <div class="course-category">Development</div>
                    </div>
                </div>
                <div class="course">
                    <div class="course-image-container">
                        <img
                            class="course-image"
                            src="../../assets/images/c5.webp"
                            alt="" />
                    </div>
                    <div class="course-text">
                        <div class="course-title">
                            Web development
                        </div>

                        <div class="course-author">Dr. Angela Yu</div>
                        <div class="course-price">300birr</div>
                        <div class="course-category">Development</div>
                    </div>
                </div>
                <div class="course">
                    <div class="course-image-container">
                        <img
                            class="course-image"
                            src="../../assets/images/c5.webp"
                            alt="" />
                    </div>
                    <div class="course-text">
                        <div class="course-title">
                            Web development
                        </div>

                        <div class="course-author">Dr. Angela Yu</div>
                        <div class="course-price">300birr</div>
                        <div class="course-category">Development</div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php require 'partials/footer.php'; ?>
</body>

</html>