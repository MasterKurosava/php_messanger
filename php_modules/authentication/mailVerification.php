<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/signin.css" type="text/css">
    <title>Верификация</title>
    <style>
        .emailCheck_container{
            display: flex;
            box-sizing: border-box;
            align-items: center;
            width: fit-content;
            min-width: 300px;
            height: 50px;
            border: 1px solid black;
            border-radius: 10px;
            padding: 50px;
            font-size: 23px;
            box-shadow: 0 0 10px 1px #00d200;
            margin: 50px auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="main">
    <?php
        require_once "../connection.php";
        session_start();
        //находим пользователя, который регистрируется
        $sql="SELECT * FROM users WHERE EMAIL='".$_SESSION['verifyEmail']."'";
        $user=$db->query($sql);
        $user=$user->fetch();

        if($_GET['token'] == $user['TOKEN']){  
            echo '<div class="emailCheck_container">E-mail подтвержден. Пожалуйста, подождите.</div>';
            unset($_SESSION['verifyEmail']);
            $userId=$user['ID'];
            $db->query("UPDATE `users` SET `VERIFICATION` = '1', `TOKEN` = 'NULL' WHERE `ID` = $userId");
            header('Location: ../../pages/main.php');
        }
        else{
            echo '<div class="emailCheck_container">Подтвердите свой e-mail, а затем перезагрузите страницу.</div>';
        }
    ?>
    </div>
</body>
</html>