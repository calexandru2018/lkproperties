<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/faq.php');
    $conn = new Database();
    $faq = new Faq($conn->db);
    switch($_POST['contentType']){
        case 'saveQuestion': $response = $faq->updateFaqQuestion($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveAnswer': $response = $faq->updateFaqAnswer($_POST['contentID'], $_POST['userInput']);
            break;
    }

    $faq->closeConnection($conn->db);

    echo json_encode($response);
?>