<?php

include_once 'User.php';

session_start();

$id = $_SESSION['user'];

$img = $_POST['newImg'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

$randomName = User::random_text();
$uploadDir = $_SERVER['DOCUMENT_ROOT']."/app/img/user_data/$id/user_photo/".$randomName.".jpeg";
file_put_contents($uploadDir, $data);

$images = User::loadUserCollection($id);
$_SESSION['images'] = $images;
header("Location: /index.php");
exit();