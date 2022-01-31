<?php
    require_once("../connection.php");

    $email=filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
    $password=filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
    $remember=$_POST['rememberMe'];

    if($email && $password){
        $password=md5($password)."liza";
        $sql="SELECT ID FROM users WHERE EMAIL='$email' AND `PASSWORD`='$password' AND VERIFICATION=1";
        $user=$db->query($sql);
        $user=$user->fetch();
        if($user['ID']){
            if($remember){
                //добавляем куки
                $password_cookie_token=md5($user["id"].$password.time());
                $db->query("UPDATE users SET PASSWORD_COOKIE_TOKEN='".$password_cookie_token."' WHERE EMAIL='".$email."'");
                setcookie("password_cookie_token",$password_cookie_token, time()+(1000*60*60*24*30), "/");
            }
            else{
                //выключаем куки
                if(isset($_COOKIE["password_cookie_token"])){
                    $db->query("UPDATE users SET PASSWORD_COOKIE_TOKEN='' WHERE EMAIL='".$email."'");
                }
                setcookie("password_cookie_token","", time()-3600, "/");
            }
            header('Location: ../../pages/main.php');
            exit();
        }else{
            echo "Пользователь не найден";
            header('Location: ../../pages/signin.php');
            exit();
        }
    }


?>