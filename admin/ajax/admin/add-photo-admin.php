<?php
    include('../class.upload.php');
    require_once('../../_include/_models/db.php');
    require_once('../../_include/_models/admin.php');
    $addNewPhotoConn = new Database();
    $photo = new Administrator($addNewPhotoConn->db);

    $files = array();
    $adminID = 0;
    foreach ($_FILES['image_field'] as $k => $l) {
        foreach ($l as $i => $v) {
            if (!array_key_exists($i, $files))
                $files[$i] = array();
                if($k == 'name'){
                    $expl = explode('___', $v);
                    $adminID = $expl[0];
                    $files[$i][$k] = $expl[1];
                }else{
                    $files[$i][$k] = $v;
                }
        }
    }
    // var_dump($files);
    foreach ($files as $file) {
        $handle = new Upload($file);
        if ($handle->uploaded) {
            /* Should be used only for real estate phtoos */
            /* $handle->image_watermark = 'watermark.png';
            $handle->image_watermark_no_zoom_in = false; */
            /*  if($handle->image_src_x > 2650){
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_x = 2560;
            }
            $handle->image_resize = true;
            $handle->image_ratio_y = true;
            $handle->image_x = 800; */

            $handle->image_convert = 'jpeg';
            $handle->jpeg_quality = 60;
            $handle->image_resize          = true;
            $handle->image_ratio_crop      = true;
            $handle->image_y               = 300;
            $handle->image_x               = 300;
            $handle->Process("../../../gallery/ourstaff");
            if ($handle->processed) {
                $response = $photo->addAdminPhoto($adminID, $handle->file_dst_name);
                if($response == true)
                    echo (int)1;
                else
                    echo false;
            } else {
                echo 'Error: ' . $handle->error;
            }
        } else {
          echo 'Error: ' . $handle->error;
        }
        unset($handle);
    }
?>   