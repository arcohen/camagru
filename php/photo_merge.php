<?php

function gd_img_html($image) {
    ob_start();
    imagepng($image);
    $data = ob_get_contents();
    ob_end_clean();
    return "data:image/png;base64,".base64_encode($data);
}

include "../config/connection.php";
session_start();
$username = htmlspecialchars($_SESSION['username']);

$image_parts = explode(";base64,", $_POST["image"]);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];

$image_base64 = base64_decode($image_parts[1]);

file_put_contents("temp.png", $image_base64);

if ($_POST["frame"] == "fool")
    $frame_path = "http://localhost:8080/img/fool.png";
else
    $frame_path = "http://localhost:8080/img/wooh.png";

$frame = imagecreatefrompng($frame_path);
$webcam_img = imagecreatefrompng('temp.png');

imagecopy($webcam_img, $frame, 0, 0, 0, 0, 320, 240);

$img = gd_img_html($webcam_img);

$stmt = $conn->prepare("INSERT INTO images (username, img) VALUES (?, ?)");
$stmt->execute([$_SESSION["username"], $img]);

$folderPath = "../upload/";

$image_parts = explode(";base64,", $img);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];

$image_base64 = base64_decode($image_parts[1]);
$fileName = uniqid() . '.png';

$file = $folderPath . $fileName;
file_put_contents($file, $image_base64);

header("Location: /public/photo.php")

?>