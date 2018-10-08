<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/service-common.php');
    $conn = new Database();
    $sc = new SC($conn->db);
    $response = $sc->updateSC($_POST['contentID'], $_POST['userInput']);

    $sc->closeConnection($conn->db);

    echo json_encode($response);
?>