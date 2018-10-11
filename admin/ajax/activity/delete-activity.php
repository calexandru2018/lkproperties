<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/activity.php');
    $conn = new Database();
    $activity = new Activity($conn->db);
    $basePath = $commonBaseURL.'/gallery/activity/';
    $response = $activity->deleteActivity($_POST['contentID'], $basePath);

    $activity->closeConnection($conn->db);
    echo json_encode($response);
?>