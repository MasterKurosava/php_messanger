<?php
    require_once("../connection.php");
    
    $login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
    $password= filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
    $passwordRep= filter_var(trim($_POST['passwordRep']),FILTER_SANITIZE_STRING);

    $errors=false;

    $sql="SELECT * FROM users WHERE EMAIL='$email'";
    $createdUser=$db->query($sql);
    $createdUser=$createdUser->fetchAll();
    if(count($createdUser)>0){
        echo "Почта занята";
        exit();
    }else{
        if(strlen($login)<5 || strlen($login)>40){ 
            echo "Длина логина должна быть от 5 до 40 символов";
            $errors=true;
            exit();
        }
        if(strlen($password) < 8){ 
            echo "Пароль должен содежать минимум 8 символов";
            $errors=true;
            exit();
        }
        if($password != $passwordRep){ 
            echo "Пароли не совпадают";
            $errors=true;
            exit();
        }
    }
    // Переменная $headers нужна для Email заголовка
    $token=substr(md5(rand()),0,8);
    $subject = "Подтверждение почты";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .="Content-type: text/html; charset=utf-8\r\n";
    $headers .="To: <$email>\r\n";
    $headers .="From: <kurosavatest@gmail.com>\r\n";
    $message='
    <html>
        <head>
            <title>Подтвердите Email</title>
        </head>
        <body>
            <p>Чтобы подтвердить Email, перейдите по <a href="http://messanger-master/php_modules/authentication/mailVerification.php?token='.$token.'"> ссылке </a></p>
        </body>
    </html>';

    //добавление пользователя
    if(!$errors){
        $hash=md5($password)."liza";
        $sqlAdd = "
            INSERT INTO users
            (LOGIN, PASSWORD, EMAIL, CONTACTS_LIST_ID, GROUP_CHAT_LIST_ID,PRIVATE_CHAT_LIST_ID, IMG_PROFILE_ID, VERIFICATION,TOKEN)
            VALUES (:LOGIN, :PASSWORD, :EMAIL,:CONTACTS_LIST_ID, :GROUP_CHAT_LIST_ID,:PRIVATE_CHAT_LIST_ID, :IMG_PROFILE_ID, :VERIFICATION,:TOKEN)
        ";
        $statement = $db->prepare($sqlAdd);
        $statement->execute(
        array(
            ':LOGIN'  => $_POST['login'],
            ':PASSWORD' => $hash,
            ':EMAIL' => $_POST['email'],
            ':CONTACTS_LIST_ID' => 1,
            ':GROUP_CHAT_LIST_ID' => 1,
            ':PRIVATE_CHAT_LIST_ID' => 1,
            ':IMG_PROFILE_ID' => 1,
            ':VERIFICATION' => 0,
            ':TOKEN' => $token
            )
        );
    };
    
    //проверка дошла ли почта
    if(mail($email, $subject, $message, $headers)){
        //Запоминаем токен
        session_start();
        $_SESSION['verifyEmail']=$email;
        header("Location: ./mailVerification.php");
    }
    else{
        header("Location: ../../register.php");
    }

    exit();
?>