<?php

include "../config/connection.php";

function base64_to_png($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb"); 
    fwrite($ifp, base64_decode( $base64_string)); 
    fclose($ifp); 
    return($output_file); 
}

function gd_img_html($image) {
    ob_start();
    imagepng($image);
    $data = ob_get_contents();
    ob_end_clean();
    return "data:image/png;base64,".base64_encode($data);
}

session_start();
$username = htmlspecialchars($_SESSION['username']);
base64_to_png(str_replace("data:image/png;base64,", "",$_POST["webcam_img"]), 'temp.png');

$webcam_img = imagecreatefrompng("temp.png");
$frame = imagecreatefrompng($_POST["frame"]);

imagealphablending($webcam_img, false);
imagesavealpha($webcam_img, true);
imagecopymerge($webcam_img, $frame, 0, 0, 0, 0, 0, 320, 240);

$merged_img = gd_img_html();

$stmt = $conn->prepare("INSERT INTO images (username, img) VALUES (?, ?)");
$stmt->execute([$username, $merged_img]);

header('Location: /public/photo.php');

?>