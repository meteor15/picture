<?php
Header("Content-type: image/jpg").
$old = imageCreateFromJpeg(getcwd()."/storage/{$_REQUEST['img']}");
$w = imageSX($old);
$h = imageSY($old);
$w_new=round($w*2);
$h_new=round($h*2);
$new = imageCreate($w_new, $h_new);
imageCopyResized($new, $old, 0, 0, 0, 0, $w_new, $h_new, $w, $h);
imageJpeg($new);
imageDestroy($old);
imageDestroy($new);
