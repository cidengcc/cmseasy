<?php

function imageWaterMark($groundImage, $waterPos = 0, $waterImage = "", $waterText = "", $textFont = 5, $textColor = "#FF0000", $transparent = 100, $quality = 100)
{
    //var_dump($groundImage,$waterPos,$waterImage,$waterText,$textFont,$textColor,$transparent,$quality);
    if (substr($waterImage, 0, 1) == '/') {
        $waterImage = substr($waterImage, 1);
    }
    //var_dump($waterImage);
    $isWaterImage = false;
    $formatMsg = "暂不支持该文件格式，请用图片处理软件将图片转换为GIF、JPG、PNG格式。";
    if (!empty($waterImage) && file_exists($waterImage)) {
        $isWaterImage = true;
        $water_info = getimagesize($waterImage);
        //var_dump($water_info);
        $water_w = $water_info[0];
        $water_h = $water_info[1];
        switch ($water_info[2]) {
            case 1:
                $water_im = imagecreatefromgif($waterImage);
                break;
            case 2:
                $water_im = imagecreatefromjpeg($waterImage);
                break;
            case 3:
                $water_im = imagecreatefrompng($waterImage);
                break;
            default:die($formatMsg);
        }
    }
    $groundImage = preg_replace('#' . config::get('base_url') . '#is', '', $groundImage, 1);
    if (substr($groundImage, 0, 1) == '/') {
        $groundImage = substr($groundImage, 1);
    }
    //var_dump(config::get('base_url'));
    //var_dump(($groundImage));
    //var_dump(file_exists($groundImage));
    if (!empty($groundImage) && file_exists($groundImage)) {
        $ground_info = getimagesize($groundImage);
        //var_dump($ground_info);
        $ground_w = $ground_info[0];
        $ground_h = $ground_info[1];
        switch ($ground_info[2]) {
            case 1:
                $ground_im = imagecreatefromgif($groundImage);
                break;
            case 2:
                $ground_im = imagecreatefromjpeg($groundImage);
                break;
            case 3:
                $ground_im = imagecreatefrompng($groundImage);
                break;
            default:die($formatMsg);
        }
    } else {
        return;
    }
    if ($isWaterImage) {
        $w = $water_w;
        $h = $water_h;
        $label = "图片的";
    } else {
        $temp = @imagettfbbox(ceil($textFont * 2.5), 0, "./cour.ttf", $waterText);
        $w = $temp[2] - $temp[6];
        $h = $temp[3] - $temp[7];
        unset($temp);
        $label = "文字区域";
    }
    if (($ground_w <= $w) || ($ground_h <= $h)) {
        return;
    }
    switch ($waterPos) {
        case 0:
            $posX = rand(0, ($ground_w - $w));
            $posY = rand(0, ($ground_h - $h));
            break;
        case 1:
            $posX = 0;
            $posY = 0;
            break;
        case 2:
            $posX = ($ground_w - $w) / 2;
            $posY = 0;
            break;
        case 3:
            $posX = $ground_w - $w;
            $posY = 0;
            break;
        case 4:
            $posX = 0;
            $posY = ($ground_h - $h) / 2;
            break;
        case 5:
            $posX = ($ground_w - $w) / 2;
            $posY = ($ground_h - $h) / 2;
            break;
        case 6:
            $posX = $ground_w - $w;
            $posY = ($ground_h - $h) / 2;
            break;
        case 7:
            $posX = 0;
            $posY = $ground_h - $h;
            break;
        case 8:
            $posX = ($ground_w - $w) / 2;
            $posY = $ground_h - $h;
            break;
        case 9:
            $posX = $ground_w - $w;
            $posY = $ground_h - $h;
            break;
        default:
            $posX = rand(0, ($ground_w - $w));
            $posY = rand(0, ($ground_h - $h));
            break;
    }
    if ($posX < 20) {
        $posX = 20;
    }

    if ($posY < 20) {
        $posY = 20;
    }

    if ($posX > $ground_w - $w - 20) {
        $posX = $ground_w - $w - 20;
    }

    if ($posY > $ground_h - $h - 20) {
        $posY = $ground_h - $h - 20;
    }

    imagesavealpha($ground_im, true);
    imagealphablending($ground_im, false);
    imagesavealpha($water_im, true);
    imagealphablending($water_im, false);
    if ($isWaterImage) {
        imagecopymerge_alpha($ground_im, $water_im, $posX, $posY, 0, 0, $water_w, $water_h, $transparent);
    } else {
        if (!empty($textColor) && (strlen($textColor) == 7)) {
            $R = hexdec(substr($textColor, 1, 2));
            $G = hexdec(substr($textColor, 3, 2));
            $B = hexdec(substr($textColor, 5));
        } else {
            die("水印文字颜色格式不正确！");
        }
        imagestring($ground_im, $textFont, $posX, $posY, $waterText, imagecolorallocate($ground_im, $R, $G, $B));
    }
    @unlink($groundImage);
    switch ($ground_info[2]) {
        case 1:
            imagegif($ground_im, $groundImage);
            break;
        case 2:
            imagejpeg($ground_im, $groundImage, $quality);
            break;
        case 3:
            imagepng($ground_im, $groundImage);
            break;
        default:die('未知格式');
    }
    if (isset($water_info)) {
        unset($water_info);
    }

    if (isset($water_im)) {
        imagedestroy($water_im);
    }

    unset($ground_info);
    imagedestroy($ground_im);
}

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
{
    // getting the watermark width
    $w = imagesx($src_im);
    // getting the watermark height
    $h = imagesy($src_im);

    // creating a cut resource
    $cut = imagecreatetruecolor($src_w, $src_h);
    // copying that section of the background to the cut
    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
    // inverting the opacity
    //$opacity = 100 - $opacity;

    // placing the watermark now
    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct);
}
