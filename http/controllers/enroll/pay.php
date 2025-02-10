<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Core\Database;

function generateTxRef() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 25; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

try {
    $config = require base_path("essentials/config.php");
    $database = new Database($config['database']);

    $data = $_POST;

    $environment = $_SERVER['SERVER_NAME'];

    $returnUrl = $environment == 'localhost' || $environment == 'ewkethub.localhost' ? 'http://ewkethub.localhost' : 'http://ewkethub.beamlak.dev';

    $courseInfo = $database->query("SELECT course.name AS course_name, course.course_slug AS course_slug, course.id AS course_id, course.description AS course_description, instructor.full_name AS instructor_name, instructor.username AS instructor_username, instructor.profile_picture_path AS instructor_profile_image, course_difficulty.name AS course_difficulty FROM course JOIN instructor ON course.instructor_id = instructor.id JOIN course_difficulty ON course.difficulty = course_difficulty.id WHERE course.course_slug = :course_slug", [
        'course_slug' => $data['course-slug']
    ])->find();

    $courseId = $courseInfo['course_id'];

    $student = $_SESSION['student'];

    $tx = generateTxRef();

    // dd(http_build_query([
    //     'courseSlug' => $data['course-slug'],
    //     'txRef'      => $tx,
    // ]));

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.chapa.co/v1/transaction/initialize',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode([
            "amount" => $data['coursePrice'],
            "currency" => "ETB",
            "email" => "{$student['email']}",
            "first_name" => "{$student['fullName']}",
            "last_name" => "{$student['fullName']}",
            "phone_number" => "0936648802",
            "tx_ref" => $tx,
            "return_url" => $returnUrl . "/confirm?" . http_build_query([
                'courseSlug' => $data['course-slug'],
                'txRef'      => $tx,
            ]),
            "customization" => [
                "title" => "Pay {$data['coursePrice']}",
            ],
            "meta" => [
                "hide_receipt" => "true"
            ]
        ]),
        CURLOPT_HTTPHEADER => array('Authorization: Bearer CHASECK_TEST-94s8JLF24exPQw3lhFfUaPuieXHiQ1zi',  'Content-Type: application/json'),
    ));



    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response, true);

    if ($response['status'] === 'success') {
        header("Location: " . $response['data']['checkout_url']);
        die();
    } else {
        abort(['error' => 'Failed to initialize transaction'], 500);
    }
} catch (Exception $e) {
    abort(['error' => $e->getMessage()], 500);
}
