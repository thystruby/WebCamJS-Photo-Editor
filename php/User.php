<?php

class User
{
    public static function getDbConnection() {
        $paramsPath = 'db_config.php';
        $params = include($paramsPath);

        // Устанавливаем соединение
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        // Задаем кодировку
        $db->exec("set names utf8");

        return $db;
    }

    public static function signIn($login, $password)
    {
        $db = User::getDbConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE login = :login AND password = :password';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        // Обращаемся к записи
        $user = $result->fetch();

        if ($user) {
            session_start();
            $_SESSION['user'] = $user['id'];
            return $user;
        } else return false;
    }

    public static function signUp($login, $password, $email)
    {
        $db = User::getDbConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO user VALUES (null, :login, :password, :email)';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function getUserData($id)
    {
        // Соединение с БД
        $db = User::getDbConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function loadUserCollection($id)
    {
        $imgRootPath = "app/img/user_data/$id/user_photo";
        $images = [];
        $files = array_slice(scandir("../".$imgRootPath), 2);
        foreach ($files as $key => $imgName) {
            $images[$key] = "../".$imgRootPath . '/'. $imgName;
        }
        return $images;
    }

    public static function loadUserAvatar($id)
    {
        $imgRootPath = "app/img/user_data/$id/avatar";
        $files = array_slice(scandir("../".$imgRootPath), 2);
        if ($files[0]) {
            $avatar = "../".$imgRootPath . '/'. $files[0];
            return $avatar;
        } else {
            $avatar = "../app/img/icons/boy.svg";
            return $avatar;
        }
    }

    public static function changePassword($id, $newPass)
    {
        $db = User::getDbConnection();

        // Текст запроса к БД
        $sql = 'UPDATE user SET password = :newPass WHERE id=:id';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':newPass', $newPass, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function checkEmailExists($email)
    {
        // Соединение с БД
        $db = User::getDbConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE email = :email';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    //randomText
    public static function random_text( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-+.";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

    // Валидация пользователя
    public static function checkUserExists($email, $login) 
{ 
// Соединение с БД 
$db = User::getDbConnection(); 

// Текст запроса к БД 
$sql = 'SELECT * FROM user WHERE email = :email OR login = :login'; 

// Получение и возврат результатов. Используется подготовленный запрос 
$result = $db->prepare($sql); 
$result->bindParam(':email', $email, PDO::PARAM_STR); 
$result->bindParam(':login', $login, PDO::PARAM_STR); 

// Указываем, что хотим получить данные в виде массива 
$result->setFetchMode(PDO::FETCH_ASSOC); 
$result->execute(); 

if($result->fetch()) { 
return true; 
} else return false; 
}
}