<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-rent.php');
    $conn = new Database();
    $toRent = new ToRent($conn->db);
    switch($_POST['contentType']){
        case 'saveName': $response = $toRent->updateName($_POST['contentID'], $_POST['userInput']);
            break;
        case 'shortDesc': $response = $toRent->updateShortDesc($_POST['contentID'], $_POST['userInput']);
            break;
        case 'longDesc': $response = $toRent->updateLongDesc($_POST['contentID'], $_POST['userInput']);
            break;
        case 'serviceType': $response = $toRent->updateService($_POST['contentID'], $_POST['userInput']);
            break;
        case 'details': $response = $toRent->updateOther($_POST['contentID'], $_POST['userInput']);
            break;
        case 'price': $response = $toRent->updatePriceList($_POST['contentID'], $_POST['userInput']);
            break;
    } 

    $toRent->closeConnection($conn->db);

    echo json_encode($response);
?>