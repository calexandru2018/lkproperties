<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-sell.php');
    $conn = new Database();
    $toSell = new ToSell($conn->db);
    $response = $toSell->deletePhoto($_POST['contentID']);
    $id = explode('-', $_POST['contentID']);
    if($response != false){
        $base_directory = $_SERVER['DOCUMENT_ROOT'].'/lkproperties/gallery/sale/'.$id[0].'/';
        if(unlink($base_directory.'fullsize/'.$response->fullsizeURL) && unlink($base_directory.'thumbnail/'.$response->thumbnailURL))
            $response = true;
        else 
            $response = false;
    }
    $toSell->closeConnection($conn->db);
    echo json_encode($response);
?>