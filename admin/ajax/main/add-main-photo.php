<?php
    include('../class.upload.php');
    require_once('../../_include/_models/db.php');
    $conn = new Database();

    $files = array();
    $toRentID = 0;
    $commonURL = '../../../gallery/main/';
    foreach ($_FILES['image_field'] as $k => $l) {
        foreach ($l as $i => $v) {
            if (!array_key_exists($i, $files))
                $files[$i] = array();
                if($k == 'name'){
                    $expl = explode('___', $v);
                    $toRentID = $expl[0];
                    $files[$i][$k] = $expl[1];
                }else{
                    $files[$i][$k] = $v;
                }
        }
    }
    // var_dump($files);
    foreach ($files as $file) {
        $fullsizeHandle = new Upload($file);
        $mobileHandle = new Upload($file);
        if ($fullsizeHandle->uploaded) {
            
        /* Fullsize handler */
            $fullsizeHandle->image_convert = 'jpeg';
            $fullsizeHandle->jpeg_quality = 50;
            $fullsizeHandle->file_safe_name = true;
            $fullsizeHandle->file_auto_rename = true;
            // if($fullsizeHandle->image_src_x > 2650){
                $fullsizeHandle->image_resize = true;
                $fullsizeHandle->image_ratio_y = true;
                $fullsizeHandle->image_x = 1920;
            // }
            $fullsizeHandle->dir_auto_create = true;
            $fullsizeHandle->Process($commonURL.'/fullsize/');
        /* Fullsize handler */

        /* Mobile handler */
            $mobileHandle->image_convert = 'jpeg';
            $mobileHandle->jpeg_quality = 50;
            $mobileHandle->file_safe_name = true;
            $mobileHandle->file_auto_rename = true;
            // if($mobileHandle->image_src_x > 2650){
                $mobileHandle->image_resize = true;
                $mobileHandle->image_ratio_y = true;
                $mobileHandle->image_x = 1024;
            // }
            $mobileHandle->dir_auto_create = true;
            $mobileHandle->Process($commonURL.'/mobile/');
        /* Mobile handler */

            if ($fullsizeHandle->processed && $mobileHandle->processed) {
                $response = addPhoto($conn->db, $fullsizeHandle->file_dst_name);
                if($response == true)
                    echo (int)1;
                else
                    echo $response;
            } else {
                echo 'Error: ' . $fullsizeHandle->error;
            }
        } else {
          echo 'Error: ' . $fullsizeHandle->error;
        }
        unset($fullsizeHandle);
        unset($mobileHandle);
    }
    mysqli_close($conn->db);

    function addPhoto($dbConn, $url){
        $queryCheckIfExists = $dbConn->query('
            select 
                mainImageURL
            from
                webpage
            limit 1
        ');
        if($queryCheckIfExists->num_rows == 0){
            $sql = '
                insert into 
                    webpage
                        (
                        mainImageURL 
                        )
                    values
                        (
                            "'.mysqli_real_escape_string($dbConn, $url).'"
                        )
            ';
        }else{
            $sql = '
                update 
                    webpage
                set
                    mainImageURL = "'.mysqli_real_escape_string($dbConn, $url).'"
                where
                    mainImageURL is not null
            ';
        }
        $query = $dbConn->query($sql);
        if($dbConn->error)
            return $dbConn->error;
        else
            return true;
    }
?>   