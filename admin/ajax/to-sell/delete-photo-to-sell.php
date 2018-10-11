<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../common-url.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-sell.php');
    $conn = new Database();
    $toSell = new ToSell($conn->db);
    $id = explode('-', $_POST['contentID']);
    $response = $toSell->deletePhoto($_POST['contentID'], $commonBaseURL.'/gallery/sale/'.$id[0].'/');

    $toSell->closeConnection($conn->db);
    echo json_encode($response);
?>