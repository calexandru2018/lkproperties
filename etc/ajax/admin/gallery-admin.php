<?php
    include('../class.upload.php');

    $files = array();
    foreach ($_FILES['image_field'] as $k => $l) {
        foreach ($l as $i => $v) {
        if (!array_key_exists($i, $files))
            $files[$i] = array();
            $files[$i][$k] = $v;
        }
    }
    foreach ($files as $file) {
        $handle = new Upload($file);
        if ($handle->uploaded) {
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
      }

    /* $handle = new upload($_FILES['image_field']);
    if ($handle->uploaded) {
        $handle->file_new_name_body   = 'image_resized';
        $handle->image_resize         = true;
        $handle->image_x              = 100;
        $handle->image_ratio_y        = true;
        $handle->process('../../../gallery');
        if ($handle->processed) {
            echo 'image resized';
            $handle->clean();
        } else {
            echo 'error : ' . $handle->error;
        }
    }else{
        var_dump($_FILES);
        echo 'have not reached';
    } */
?>   