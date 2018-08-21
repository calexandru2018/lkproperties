<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/service-unique.php');
    $conn = new Database();
    $su = new SU($conn->db);
    $response = $su->updateSU($_POST['contentID'], $_POST['userInput']);

    $su->closeConnection($conn->db);

    echo json_encode($response);
?>