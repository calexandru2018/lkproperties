<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../common-url.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-rent.php');
    $conn = new Database();
    $toRent = new ToRent($conn->db);
    $id = explode('-', $_POST['contentID']);
    $response = $toRent->deletePhoto($_POST['contentID'], $commonBaseURL.'/gallery/rental/'.$id[0].'/');

    $toRent->closeConnection($conn->db);
    echo json_encode($response);
?>