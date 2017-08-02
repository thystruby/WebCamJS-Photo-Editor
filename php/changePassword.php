<?php

include_once 'User.php';

session_start();

$id = $_SESSION['user'];

$newPass =  $_POST['new_password'];

User::changePassword($id, $newPass);

header("Location: /personalAccount.php");
exit();