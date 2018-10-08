<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-sell.php');
    $conn = new Database();
    $toSell = new ToSell($conn->db);
    $basePath = $_SERVER['DOCUMENT_ROOT'].'/lkproperties/gallery/sale/';
    $response = $toSell->delete($_POST['contentID'], $basePath);

    $toSell->closeConnection($conn->db);

    echo json_encode($response);
?>