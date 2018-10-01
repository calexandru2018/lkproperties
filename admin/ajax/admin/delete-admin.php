<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/admin.php');
    $deleteConn = new Database();
    $deleteAdmin = new Administrator($deleteConn->db);
    $basePath = $_SERVER['DOCUMENT_ROOT'].'/lkproperties/gallery/ourstaff/';
    $response = $deleteAdmin->deleteAdmin($_POST['contentID'], $basePath);

    $deleteAdmin->closeConnection($deleteConn->db);

    echo json_encode($response);
?>