<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/admin.php');
    $insertConn = new Database();
    $insertAdmin = new Administrator($insertConn->db);
    $response = $insertAdmin->insertAdmin($_POST);

    $insertAdmin->closeConnection($insertConn->db);

    echo json_encode($response);
?>