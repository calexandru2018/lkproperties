<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/city.php');
    $deleteConn = new Database();
    $deleteCity = new City($deleteConn->db);
    $response = $deleteCity->deleteCity($_POST['contentID']);

    $deleteCity->closeConnection($deleteConn->db);

    echo json_encode($response);
?>