<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../common-url.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/city.php');
    $conn = new Database();
    $city = new City($conn->db);
    $basePath = $commonBaseURL.'/gallery/city/';
    $response = $city->deleteCity($_POST['contentID'], $basePath);

    $city->closeConnection($conn->db);

    echo json_encode($response);
?>