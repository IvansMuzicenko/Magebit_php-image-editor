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
    $x = ($width - $new_width) / 2;
    $y = ($height - $new_height) / 2;


    $image = imagecreatefromjpeg(IMG_FILE_NAME);
    $image = imagecrop($image, ["x" => $x, "y" => $y, "width" => $new_width, "height" => $new_height]);
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
