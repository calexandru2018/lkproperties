<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/to-rent.php');
    $conn = new Database();
    $toRent = new ToRent($conn->db);
   /*  $cityToRentIDCityID = explode('-',$_POST['userInput']['toRentCityName'][0]);
    switch($_POST['contentType']){
        case 'saveName': $response = $toRent->updateToRentName($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveDesc': $response = $toRent->updateToRentDesc($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveOther': $response = $toRent->updateToRentOther($_POST['contentID'], $_POST['userInput']['toRentIsPopular'], $_POST['userInput']['toRentIsAlgarve'], $cityToRentIDCityID[1], $cityToRentIDCityID[0]);
            break;
    } */

    $toRent->closeConnection($conn->db);

    echo json_encode($_POST);
?>