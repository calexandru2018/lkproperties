<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/city.php');
    $conn = new Database();
    $city = new City($conn->db);
    $response = $city->deleteCityPhoto($_POST['contentID']);
    $id = explode('-', $_POST['contentID']);
    if($response != false){
        $base_directory = $_SERVER['DOCUMENT_ROOT'].'/lkproperties/gallery/city/'.$id[0].'/';
        if(unlink($base_directory.'fullsize/'.$response->fullsizeURL) && unlink($base_directory.'thumbnail/'.$response->thumbnailURL))
            $response = true;
        else 
            $response = false;
    }
    $city->closeConnection($conn->db);
    echo json_encode($response);
?>