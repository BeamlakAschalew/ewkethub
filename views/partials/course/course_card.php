<a href="/course/course-name">
    <div class="course">
        <div class="course-image-container">
            <img
                class="course-image"
                src="<?= base_url("ewkethub_shared_assets/images/course_thumbnails/{$course['thumbnail_path']}") ?>"
                alt="" />
        </div>
        <div class="course-text">
            <div class="course-title">
                <?= $course['course_name'] ?>
            </div>

            <div class="course-author"><?= $course['instructor_name'] ?></div>
            <div class="course-price"><?= $course['price'] ?>birr</div>
            <div class="course-category"><?= $course['category_name'] ?></div>
        </div>
    </div>
</a>