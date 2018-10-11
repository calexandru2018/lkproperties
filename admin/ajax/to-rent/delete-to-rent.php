<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../common-url.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-rent.php');
    $conn = new Database();
    $toRent = new ToRent($conn->db);
    $basePath = $commonBaseURL.'/gallery/rental/';
    $response = $toRent->delete($_POST['contentID'], $basePath);

    $toRent->closeConnection($conn->db);

    echo $response;
?>