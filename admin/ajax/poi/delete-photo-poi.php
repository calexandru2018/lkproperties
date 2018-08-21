<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/poi.php');
    $conn = new Database();
    $poi = new Poi($conn->db);
    $response = $poi->deletePoiPhoto($_POST['contentID']);
    $id = explode('-', $_POST['contentID']);
    if($response != false){
        $base_directory = $_SERVER['DOCUMENT_ROOT'].'/lkproperties/gallery/poi/'.$id[0].'/';
        if(unlink($base_directory.'fullsize/'.$response->fullsizeURL) && unlink($base_directory.'thumbnail/'.$response->thumbnailURL))
            $response = true;
        else 
            $response = false;
    }
    $poi->closeConnection($conn->db);
    echo json_encode($response);
?>