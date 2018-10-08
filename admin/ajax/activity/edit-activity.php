<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/activity.php');
    $conn = new Database();
    $activity = new Activity($conn->db);
    switch($_POST['contentType']){
        case 'saveName': $response = $activity->updateActivityName($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveDesc': $response = $activity->updateActivityDesc($_POST['contentID'], $_POST['userInput']);
            break;
        case 'saveOther': $response = $activity->updateActivityOther($_POST['contentID'], $_POST['userInput']['activityCityName'][0]);
            break;
    }

    $activity->closeConnection($conn->db);

    echo json_encode($response);
?>