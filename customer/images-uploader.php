<?php

//require('helper.php');
session_start();

require 'helper.php';
require '../db/newDB.php';

$files_names = $_FILES['upload-input']['name'];
$files_types = $_FILES['upload-input']['type'];
$files_errors = $_FILES['upload-input']['error'];
$galleries_names_csv = $_POST['galleries-names'];


$content_to_update = array();

if (isset($galleries_names_csv) && !empty($galleries_names_csv)) {
    // Convert CSV to an array
    $galleries_names_global = str_getcsv($galleries_names_csv);
    // Initialize galleries names array for the image
    $galleries_names_image = array();
    array_push($galleries_names_image, 'all');

    foreach ($galleries_names_global as $key => &$gallery_name) {
        // Strip first and last whitespace(s)
        $gallery_name = trim($gallery_name);
        // Replace multiple whitespaces with one
        $gallery_name = preg_replace('/\s\s+/', ' ', $gallery_name);
        // Make it lowercase
        $gallery_name = strtolower($gallery_name);

        if (!empty($gallery_name)) {
            array_push($galleries_names_image, $gallery_name);
            $content_to_update[2] = $galleries_names_image;

            if (!in_array($gallery_name, $json_in_decoded['galleries'])) {
                array_push($json_in_decoded['galleries'], $gallery_name);
                $content_to_update[1][] = $gallery_name;
            } else {
                $content_to_update[1] = array();
            }
        }
    }
} else {
    $content_to_update[1] = array();
    $content_to_update[2][] = 'all';
}

foreach ($files_errors as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['upload-input']['tmp_name'][$key];
        $orig_file_name = $files_names[$key];
        $uuid = generate_uuid();
        $uuid_file_name = $uuid . '.' . pathinfo($orig_file_name, PATHINFO_EXTENSION);

        if (!move_uploaded_file($tmp_name, UPLOADED_IMAGES_DIR . $uuid_file_name))
            die('Sorry, there was an error uploading the image(s).');

        // Write image's infos in JSON file
        $json_in_decoded['images'][$uuid] = array(
            'uuid' => $uuid_file_name,
            'name' => $orig_file_name,
            'type' => $files_types[$key],
            'galleries' => $galleries_names_image
        );
    }

    $content_to_update[0] = '<img src="' . UPLOADED_IMAGES_DIR . $uuid_file_name . '">';
    echo json_encode($content_to_update);
    
    $img_cus_nic = $_POST['img_cus_nic'];
    $img_ser_number = $_POST['img_ser_number'];
    //image file name save to the db
    global $conn;
    $save_images = "INSERT INTO service_images
            (
             ser_number,
             cus_nic,
             image_path,
             status)
VALUES (
        '$img_ser_number',
        '$img_cus_nic',
        '$uuid_file_name',
        '1');";
    $run_query = mysqli_query($conn, $save_images);
    if ($run_query) {
        echo "<script>alert('Vehicle Images successfully uploaded');</script>";
        echo "<script>window.location.href='../user/user_home.php';</script>";
    }

    //image file name save to the db
}

if (isset($_GET['gallery'])) {
    $files_names = dir_to_array(UPLOADED_IMAGES_DIR);
    $gallery_name = $_GET['gallery'];
    
    foreach ($json_in_decoded['images'] as $uuid => $image_item) {
        if (in_array($gallery_name, $image_item['galleries']) && in_array($image_item['uuid'], $files_names)) {
            echo '<li><img src="images/' . $image_item['uuid'] . '" id="' . $uuid . '"></li>';
        }
    }
}

if (isset($_GET['id']) && isset($_GET['fromgallery']) && isset($_GET['togallery'])) {
    $gallery_name_index = array_search($_GET['fromgallery'], $json_in_decoded['images'][$_GET['id']]['galleries']);

    if ($_GET['fromgallery'] == 'all') {
        $json_in_decoded['images'][$_GET['id']]['galleries'][] = $_GET['togallery'];
    } else {
        $json_in_decoded['images'][$_GET['id']]['galleries'][$gallery_name_index] = $_GET['togallery'];
    }

    $files_names = dir_to_array(UPLOADED_IMAGES_DIR);
    $gallery_name = $_GET['fromgallery'];

    foreach ($json_in_decoded['images'] as $uuid => $image_item) {
        if (in_array($gallery_name, $image_item['galleries']) && in_array($image_item['uuid'], $files_names)) {
            echo '<li><img src="images/' . $image_item['uuid'] . '" id="' . $uuid . '"></li>';
        }
    }
}

$json_out = json_encode($json_in_decoded, JSON_PRETTY_PRINT);
file_put_contents(JSON_MODEL, $json_out);
?>