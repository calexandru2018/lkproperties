<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/city.php');
    $editConn = new Database();
    $editCity = new City($editConn->db);

  switch($_POST['contentType']){
        case 'saveName': $response = $editCity->updateCityName((int)$_POST['contentID'], $_POST['userInput']);
            break;
        /*case 'savePassword': $response = $editAdmin->updateAdminPassword((int)$_POST['contentID'], $_POST['userInput']['adminPassword'][0]);
            break;
        case 'saveOtherInfo': $response = $editAdmin->updateAdminOtherSettings((int)$_POST['contentID'], $_POST['userInput']['adminPriveliege'][0], $_POST['userInput']['adminIsActive'], $_POST['userInput']['adminIsPublic']);
            break; */
    }

    $editCity->closeConnection($editConn->db);
  /*   foreach($_POST['userInput'] as $key => $value){
        $holder = explode('-', $key);
        $langSortedCityName[strtolower($holder[1])] = $value[0];
    } */
    echo json_encode($response);
?>