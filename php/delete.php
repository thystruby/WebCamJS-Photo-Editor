<?php

include_once 'User.php';

$imgSrc = $_SERVER['DOCUMENT_ROOT'].substr($_POST['imgSrc'], 2);

unlink($imgSrc);

session_start();
$images = User::loadUserCollection($_SESSION['user']);

$_SESSION['images'] = $images;
