<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/city.php');
    $insertConn = new Database();
    $insertCity = new City($insertConn->db);
    $response = $insertCity->insertCity($_POST['curatedObject']);

    $insertCity->closeConnection($insertConn->db);

    echo json_encode($response);
?>