<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/city.php');
    $editConn = new Database();
    $editCity = new City($editConn->db);

  switch($_POST['contentType']){
        case 'saveName': $response = $editCity->updateCityName($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveDesc': $response = $editCity->updateCityDesc($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveOther': $response = $editCity->updateCityOther($_POST['contentID'], $_POST['userInput']['postalCode'][0], $_POST['userInput']['cityVideoURL'][0], $_POST['userInput']['cityIsPopular']);
            break;
    }

    $editCity->closeConnection($editConn->db);

    echo json_encode($response);
?>