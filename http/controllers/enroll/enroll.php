<?php


use Core\Database;

try {

    $config = require base_path("essentials/config.php");
    $database = new Database($config['database']);

    parse_str(html_entity_decode($_SERVER['QUERY_STRING']), $data);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.chapa.co/v1/transaction/verify/{$data['txRef']}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array('Authorization: Bearer CHASECK_TEST-94s8JLF24exPQw3lhFfUaPuieXHiQ1zi'),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($response, true);

    if ($response['data']['status'] !== 'success') {
        Core\Session::set('message', [
            'type' => 'error',
            'content' => 'Couldn\'t purchase course.'
        ]);
        redirect("/course/{$data['courseSlug']}");
    }

    $courseInfo = $database->query("SELECT course.name AS course_name, course.course_slug AS course_slug, course.id AS course_id, course.description AS course_description, course.price AS course_price, instructor.full_name AS instructor_name, instructor.username AS instructor_username, instructor.profile_picture_path AS instructor_profile_image, course_difficulty.name AS course_difficulty FROM course JOIN instructor ON course.instructor_id = instructor.id JOIN course_difficulty ON course.difficulty = course_difficulty.id WHERE course.course_slug = :course_slug", [
        'course_slug' => $data['courseSlug']
    ])->find();

    $courseId = $courseInfo['course_id'];

    $enroll = $database->query('INSERT INTO student_course (student_id, course_id, course_price) VALUES (:student_id, :course_id, :course_price)', [
        'student_id' => $_SESSION['student']['id'],
        'course_id' => $courseId,
        'course_price' => $courseInfo['course_price']
    ])->find();

    if ($database->statement->rowCount() > 0) {
        Core\Session::set('message', [
            'type' => 'success',
            'content' => 'Thank you, course bought successfully.'
        ]);
        redirect("/course/{$data['courseSlug']}");
    } else {
        abort(['error' => 'Error purchasing course'], 500);
    }
} catch (Exception $e) {
    abort(['error' => $e->getMessage()], 500);
}
