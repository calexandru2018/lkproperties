<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/poi.php');
    $conn = new Database();
    $poi = new Poi($conn->db);
    $cityPoiIDCityID = explode('-',$_POST['userInput']['poiCityName'][0]);
    switch($_POST['contentType']){
        case 'saveName': $response = $poi->updatePoiName($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveDesc': $response = $poi->updatePoiDesc($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveOther': $response = $poi->updatePoiOther($_POST['contentID'], $_POST['userInput']['poiIsPopular'], $_POST['userInput']['poiIsAlgarve'], $cityPoiIDCityID[1], $cityPoiIDCityID[0]);
            break;
    }

    $poi->closeConnection($conn->db);

    echo json_encode($response);
?>