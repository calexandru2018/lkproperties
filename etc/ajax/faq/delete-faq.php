<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/faq.php');
    $conn = new Database();
    $faq = new Faq($conn->db);
    $response = $faq->deleteFaq($_POST['contentID']);

    $faq->closeConnection($conn->db);

    echo json_encode($response);
?>