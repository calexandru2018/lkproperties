<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/city.php');
    $conn = new Database();
    $city = new City($conn->db);

  switch($_POST['contentType']){
        case 'saveName': $response = $city->updateCityName($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveDesc': $response = $city->updateCityDesc($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveOther': $response = $city->updateCityOther($_POST['contentID'], $_POST['userInput']['postalCode'][0], $_POST['userInput']['cityVideoURL'][0], $_POST['userInput']['cityIsPopular']);
            break;
    }

    $city->closeConnection($conn->db);

    echo json_encode($response);
?>