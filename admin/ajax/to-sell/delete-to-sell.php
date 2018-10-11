<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../common-url.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-sell.php');
    $conn = new Database();
    $toSell = new ToSell($conn->db);
    $basePath = $commonBaseURL.'/gallery/sale/';
    $response = $toSell->delete($_POST['contentID'], $basePath);

    $toSell->closeConnection($conn->db);

    echo $response;
?>