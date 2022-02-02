<?php
    require_once "./php_modules/connection.php";
    session_start();
    //проверяем наличие куки
    if(isset($_COOKIE["password_cookie_token"]) && !empty($_COOKIE["password_cookie_token"])){
        $user=$db->query("SELECT EMAIL, PASSWORD FROM `users` WHERE PASSWORD_COOKIE_TOKEN='".$_COOKIE['password_cookie_token']."'");
        $user=$user->fetch();
        if($user['EMAIL'] && $user['PASSWORD']){
            $_SESSION['email']=$user['EMAIL'];
            $_SESSION['password']=$user['PASSWORD'];
        }else{
            echo "<p class='mesage_error' >Ошибка выборки БД.</p>";
        }
    }else{
        unset($_SESSION['email']);
        unset($_SESSION['password']);
    }
    if($_SESSION['email'] && $_SESSION['password']){
        header("Location: pages/main.php");
    }else{
        header("Location: pages/signin.php");
    }
?>