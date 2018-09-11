<?php
    include('../class.upload.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/city.php');
    $conn = new Database();
    $photo = new City($conn->db);

    $files = array();
    $cityID = 0;
    $commonURL = '../../../gallery/city/';
    foreach ($_FILES['image_field'] as $k => $l) {
        foreach ($l as $i => $v) {
            if (!array_key_exists($i, $files))
                $files[$i] = array();
                if($k == 'name'){
                    $expl = explode('___', $v);
                    $cityID = $expl[0];
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
            // $thumbnailHandle->file_new_name_body = ;
            $fullsizeHandle->image_watermark = '../../assets/img/watermark2.png';
            $fullsizeHandle->image_watermark_no_zoom_in = false;
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
            $fullsizeHandle->Process($commonURL.$cityID.'/fullsize/');
        /* Fullsize handler */

        /* Thumbnail handler */
            // $thumbnailHandle->file_new_name_body = ;
            $thumbnailHandle->image_watermark = '../../assets/img/watermark2.png';
            $thumbnailHandle->image_watermark_no_zoom_in = false;
            $thumbnailHandle->image_convert = 'jpeg';
            $thumbnailHandle->jpeg_quality = 40;
            $thumbnailHandle->file_safe_name = true;
            $thumbnailHandle->file_auto_rename = true;
            $thumbnailHandle->image_resize = true;
            // $thumbnailHandle->image_ratio_y = true;
            $thumbnailHandle->image_x = 365;
            $thumbnailHandle->image_y = 274;
            $thumbnailHandle->dir_auto_create = true;
            $thumbnailHandle->Process($commonURL.$cityID.'/thumbnail/');
        /* Thumbnail handler */

            if ($fullsizeHandle->processed && $thumbnailHandle->processed) {
                $response = $photo->addCityPhoto($cityID, $thumbnailHandle->file_dst_name, $fullsizeHandle->file_dst_name);
                if($response == true)
                    echo (int)1;
                else
                    echo false;
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