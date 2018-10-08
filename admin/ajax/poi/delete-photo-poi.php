<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/poi.php');
    $conn = new Database();
    $poi = new Poi($conn->db);
    $id = explode('-', $_POST['contentID']);
    $response = $poi->deletePhoto($_POST['contentID'], $_SERVER['DOCUMENT_ROOT'].'/lkproperties/gallery/poi/'.$id[0].'/');
    
    $poi->closeConnection($conn->db);
    echo json_encode($response);
?>