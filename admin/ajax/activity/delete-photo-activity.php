<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    require_once('../common-url.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/activity.php');
    $conn = new Database();
    $activity = new Activity($conn->db);
    $id = explode('-', $_POST['contentID']);
    $response = $activity->deletePhoto($_POST['contentID'], $commonBaseURL.'/gallery/activity/'.$id[0].'/');
    
    $activity->closeConnection($conn->db);
    echo $response;
?>