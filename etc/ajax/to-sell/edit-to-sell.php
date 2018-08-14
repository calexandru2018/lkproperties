<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-sell.php');
    $conn = new Database();
    $toSell = new toSell($conn->db);
    switch($_POST['contentType']){
        case 'saveName': $response = $toSell->updateName($_POST['contentID'], $_POST['userInput']);
            break;
        case 'shortDesc': $response = $toSell->updateShortDesc($_POST['contentID'], $_POST['userInput']);
            break;
        case 'longDesc': $response = $toSell->updateLongDesc($_POST['contentID'], $_POST['userInput']);
            break;
        case 'serviceType': $response = $toSell->updateService($_POST['contentID'], $_POST['userInput']);
            break;
        case 'details': $response = $toSell->updateOther($_POST['contentID'], $_POST['userInput']);
            break;
        case 'price': $response = $toSell->updatePriceList($_POST['contentID'], $_POST['userInput']);
            break;
    } 

    $toSell->closeConnection($conn->db);

    echo json_encode($response);
?>