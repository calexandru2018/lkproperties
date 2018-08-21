<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/city.php');
    $conn = new Database();
    $city = new City($conn->db);
    $response = $city->deleteCity($_POST['contentID']);

    $city->closeConnection($conn->db);

    echo json_encode($response);
?>