<?php

include_once 'User.php';

$login =  $_POST['login'];
$password = $_POST['password'];

$user = User::signIn($login, $password);

if ($user) {
    $images = User::loadUserCollection($user['id']);
    $avatar = User::loadUserAvatar($user['id']);
    session_start();
    $_SESSION['avatar'] = $avatar;
    $_SESSION['images'] = $images;
    $_SESSION['login'] = $user['login'];
    $_SESSION['email'] = $user['email'];
} else echo '0';