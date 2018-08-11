<?php
    include('../class.upload.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/poi.php');
    $conn = new Database();
    $photo = new Poi($conn->db);

    $files = array();
    $poiID = 0;
    $commonURL = '../../../assets/img/gallery/poi/';
    foreach ($_FILES['image_field'] as $k => $l) {
        foreach ($l as $i => $v) {
            if (!array_key_exists($i, $files))
                $files[$i] = array();
                if($k == 'name'){
                    $expl = explode('___', $v);
                    $poiID = $expl[0];
                    $files[$i][$k] = $expl[1];
                }else{
                    $files[$i][$k] = $v;
                }
        }
    }
    // var_dump($files);
    foreach ($files as $file) {
        $fullsizeHandle = new Upload($file);
        $thumbnailHandle = new Upload($file);
        if ($fullsizeHandle->uploaded && $thumbnailHandle->uploaded) {
            
        /* Fullsize handler */
            $fullsizeHandle->image_convert = 'jpeg';
            $fullsizeHandle->jpeg_quality = 60;
            $fullsizeHandle->file_safe_name = true;
            $fullsizeHandle->file_auto_rename = true;
            if($fullsizeHandle->image_src_x > 2650){
                $fullsizeHandle->image_resize = true;
                $fullsizeHandle->image_ratio_y = true;
                $fullsizeHandle->image_x = 2560;
            }
            $fullsizeHandle->dir_auto_create = true;
            $fullsizeHandle->Process($commonURL.$poiID.'/fullsize/');
        /* Fullsize handler */

        /* Thumbnail handler */
            $thumbnailHandle->image_convert = 'jpeg';
            $thumbnailHandle->jpeg_quality = 40;
            $thumbnailHandle->file_safe_name = true;
            $thumbnailHandle->file_auto_rename = true;
            $thumbnailHandle->image_resize = true;
            $thumbnailHandle->image_ratio_y = true;
            $thumbnailHandle->image_x = 365;
            $thumbnailHandle->dir_auto_create = true;
            $thumbnailHandle->Process($commonURL.$poiID.'/thumbnail/');
        /* Thumbnail handler */

            if ($fullsizeHandle->processed && $thumbnailHandle->processed) {
                if($photo->addPoiPhoto($poiID, $thumbnailHandle->file_dst_name, $fullsizeHandle->file_dst_name))
                    echo true;
                else 
                    echo 'issues updating';
            } else {
                echo 'Error: ' . $fullsizeHandle->error;
            }
        } else {
          echo 'Error: ' . $fullsizeHandle->error;
        }
        unset($fullsizeHandle);
        unset($thumbnailHandle);
    }
    $photo->closeConnection($conn->db);
?>   