<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../common-url.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/poi.php');
    $conn = new Database();
    $poi = new Poi($conn->db);
    $basePath = $commonBaseURL.'/gallery/poi/';
    $response = $poi->deletePoi($_POST['contentID'], $basePath);

    $poi->closeConnection($conn->db);

    echo $response;
?>