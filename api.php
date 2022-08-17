<?php

const IMG_FILE_NAME = 'images/image.jpg';
header('Content-Type: image/jpeg');

if (!file_exists(IMG_FILE_NAME)) {
    exit;
}


if (
    isset($_GET["width"]) &&
    is_string($_GET["width"]) &&
    isset($_GET["height"]) &&
    is_string($_GET["height"])
) {
    list($width, $height, $type, $attr) = getimagesize(IMG_FILE_NAME);

    $new_width = (int) $_GET['width'];
    $new_height = (int) $_GET['height'];
    $w_ratio = $new_width / $width;
    $h_ratio = $new_height / $height;
    $image = imagecreatefromjpeg(IMG_FILE_NAME);

    if ($w_ratio > $h_ratio) {
        $scale_height = $height * $w_ratio;
        $image = imagescale($image, $new_width, $scale_height);
        $x = 0;
        $y = ($scale_height - $new_height) / 2;
        $image = imagecrop($image, ["x" => $x, "y" => $y, "width" => $new_width, "height" => $new_height]);
    } else if ($w_ratio < $h_ratio) {
        $scale_width = $width * $h_ratio;
        $image = imagescale($image, $scale_width, $new_height);
        $x = ($scale_width - $new_width) / 2;
        $y = 0;
        $image = imagecrop($image, ["x" => $x, "y" => $y, "width" => $new_width, "height" => $new_height]);
    } else if ($w_ratio == $h_ratio) {
        $image = imagescale($image, $new_width, $new_height);
    }

    imagejpeg($image);
    imagedestroy($image);
} else if (isset($_GET["width"]) && is_string($_GET["width"])) {
    list($width, $height, $type, $attr) = getimagesize(IMG_FILE_NAME);

    $new_width = (int) $_GET['width'];

    $image = imagecreatefromjpeg(IMG_FILE_NAME);
    $image = imagescale($image, $new_width);
    imagejpeg($image);
    imagedestroy($image);
} else if (isset($_GET["height"]) && is_string($_GET["height"])) {
    list($width, $height, $type, $attr) = getimagesize(IMG_FILE_NAME);

    $new_height = (int) $_GET['height'];
    $new_width = $width * ($new_height / $height);

    $image = imagecreatefromjpeg(IMG_FILE_NAME);
    $image = imagescale($image, $new_width, $new_height);
    imagejpeg($image);
    imagedestroy($image);
}
