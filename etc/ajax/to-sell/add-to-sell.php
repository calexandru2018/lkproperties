<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-sell.php');
    $conn = new Database();
    $toSell = new ToSell($conn->db);
    $response = $toSell->insert($_POST['curatedObject']);

    $toSell->closeConnection($conn->db);

    echo json_encode($response);
?>