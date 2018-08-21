<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/admin.php');
    $editConn = new Database();
    $editAdmin = new Administrator($editConn->db);

    switch($_POST['contentType']){
        case 'savePersInfo': $response = $editAdmin->updateAdminPersInfo((int)$_POST['contentID'], $_POST['userInput']['adminName'][0], $_POST['userInput']['adminEmail'][0]);
            break;
        case 'savePassword': $response = $editAdmin->updateAdminPassword((int)$_POST['contentID'], $_POST['userInput']['adminPassword'][0]);
            break;
        case 'saveOtherInfo': $response = $editAdmin->updateAdminOtherSettings((int)$_POST['contentID'], $_POST['userInput']['adminPriveliege'][0], $_POST['userInput']['adminIsActive'], $_POST['userInput']['adminIsPublic']);
            break;
    }

    $editAdmin->closeConnection($editConn->db);

    echo json_encode($response);
?>