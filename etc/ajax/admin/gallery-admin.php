<?php
    include('../class.upload.php');

    $files = array();
    print_r($_FILES);
    /* foreach ($_FILES['image_field'] as $k => $l) {
        foreach ($l as $i => $v) {
        if (!array_key_exists($i, $files))
            $files[$i] = array();
            $files[$i][$k] = $v;
        }
    }
    foreach ($files as $file) {
        $handle = new Upload($file);
        if ($handle->uploaded) {
            $handle->image_convert = 'jpeg';
            $handle->jpeg_quality = 60;
            $handle->image_watermark = 'watermark.png';
            $handle->image_watermark_no_zoom_in = false;
            if($handle->image_src_x > 2650){
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_x = 2560;
            }
            $handle->Process("../../../gallery");
            if ($handle->processed) {
                echo 'OK';
            } else {
                echo 'Error: ' . $handle->error;
            }
        } else {
          echo 'Error: ' . $handle->error;
        }
        unset($handle);
      } */
?>   