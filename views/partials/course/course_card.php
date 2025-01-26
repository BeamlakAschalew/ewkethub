<a href="/course/course-name">
    <div class="course">
        <div class="course-image-container">
            <img
                class="course-image"
                src="<?= web_asset('images/course_thumbnails/1737823631.jpg') ?>"
                alt="" />
        </div>
        <div class="course-text">
            <div class="course-title">
                <?= $course['course_name'] ?>
            </div>

            <div class="course-author"><?= $course['instructor_name'] ?></div>
            <div class="course-price"><?= $course['price'] ?>birr</div>
            <div class="course-category"><?= $course['category_name'] ?></div>
            <?php dd(dirname(parse_url($_SERVER['REQUEST_URI'])['path'])) ?>
        </div>
    </div>
</a>