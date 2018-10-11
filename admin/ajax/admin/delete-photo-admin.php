<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../common-url.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/admin.php');
    $deletePhotoAdminConn = new Database();
    $deletePhotoAdmin = new Administrator($deletePhotoAdminConn->db);
    $response = $deletePhotoAdmin->deletePhoto($_POST['contentID'], $commonBaseURL.'/gallery/ourstaff/');

    $deletePhotoAdmin->closeConnection($deletePhotoAdminConn->db);
    echo $response;
?>