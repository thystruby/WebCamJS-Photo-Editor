<?php

include_once 'User.php';

$email_address = $_POST['email'];

$user = User::checkEmailExists($email_address);

if ($user) {
    $newPassword = User::random_text();
    $subject = "WebCamJS : New password";
    $message = "Your new password for the site WebCamJS.ru: ".$newPassword;

    User::changePassword($user['id'], $newPassword);

    mail($email_address, $subject, $message);

    header("Location: /login.html");
    exit();
} else {

}
