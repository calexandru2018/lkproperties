<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/admin.php');
    $deletePhotoAdminConn = new Database();
    $deltePhotoAdmin = new Administrator($deletePhotoAdminConn->db);
    $response = $deltePhotoAdmin->deleteAdminPhoto($_POST['contentID']);

   if($response != false){
        $base_directory = $_SERVER['DOCUMENT_ROOT'].'/lkproperties/ourstaff/';
        if(unlink($base_directory.$response))
            $response = true;
        else 
            $response = false;
    } 

    $deltePhotoAdmin->closeConnection($deletePhotoAdminConn->db);
    echo json_encode($response);
?>