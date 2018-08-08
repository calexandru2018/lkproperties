<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/activity.php');
    $conn = new Database();
    $activity = new Activity($conn->db);
    $response = $activity->deleteActivityPhoto($_POST['contentID']);
    $id = explode('-', $_POST['contentID']);
    if($response != false){
        $base_directory = $_SERVER['DOCUMENT_ROOT'].'/lkproperties/assets/img/gallery/activity/'.$id[0].'/';
        if(unlink($base_directory.'fullsize/'.$response->fullsizeURL) && unlink($base_directory.'thumbnail/'.$response->thumbnailURL))
            $response = true;
        else 
            $response = false;
    }
    $activity->closeConnection($conn->db);
    echo json_encode($response);
?>