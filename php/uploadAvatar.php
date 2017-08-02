<?php

include_once 'User.php';

session_start();

$id = $_SESSION['user'];
unset($_SESSION['avatar']);

$uploadDir = $_SERVER['DOCUMENT_ROOT']."/app/img/user_data/$id/avatar/_avatar.jpeg";
move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir);

$_SESSION['avatar'] = User::loadUserAvatar($id);

header("Location: /personalAccount.php");
exit();