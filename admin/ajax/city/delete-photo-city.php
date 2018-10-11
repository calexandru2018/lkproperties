<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../common-url.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/city.php');
    $conn = new Database();
    $city = new City($conn->db);
    $id = explode('-', $_POST['contentID']);
    $response = $city->deletePhoto($_POST['contentID'], $commonBaseURL.'/gallery/city/'.$id[0].'/');
    
    $city->closeConnection($conn->db);
    echo $response;
?>