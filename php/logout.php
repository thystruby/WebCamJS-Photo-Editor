<?php

session_start();
unset($_SESSION["user"]);
unset($_SESSION["images"]);
unset($_SESSION["login"]);
unset($_SESSION["email"]);
unset($_SESSION['avatar']);
header("Location: /");