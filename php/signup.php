<?php

include_once 'User.php';

$login =  $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];

if (!(User::checkUserExists($email, $login))) {
    User::signUp($login, $password, $email);
    $user = User::signIn($login, $password);
    if ($user) {
        mkdir("../app/img/user_data/" . $user['id']);
        mkdir("../app/img/user_data/" . $user['id'] . "/avatar");
        mkdir("../app/img/user_data/" . $user['id'] . "/user_photo");
        $images = User::loadUserCollection($user['id']);
        $avatar = User::loadUserAvatar($user['id']);
        session_start();
        $_SESSION['avatar'] = $avatar;
        $_SESSION['images'] = $images;
        $_SESSION['login'] = $user['login'];
        $_SESSION['email'] = $user['email'];
        exit();
    }
} else echo '0';