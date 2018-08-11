<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-rent.php');
    $conn = new Database();
    $toRent = new ToRent($conn->db);
    $response = $toRent->deleteToRent($_POST['contentID']);

    $toRent->closeConnection($conn->db);

    echo json_encode($response);
?>