<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css" type="text/css">
    <title>Регистрация</title>
</head>
<body>
    <div class="main">
        <div class="register_window">
            <h2 class="register_title">Регистрация</h2>
            <form action="../php_modules\authentication\signup.php" method="post" class="register_form">
                <div class="register_login input_container">
                    <label for="login">Логин <span class="register_noImportant">  (не обязательно)</span></label>
                    <input type="text" name="login" id="login">
                </div>
                <div class="register_email input_container">
                    <label for="email">Почта</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="register_password input_container">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="register_passwordRep input_container">
                    <label for="passwordRep">Повторение пароля</label>
                    <input type="password" name="passwordRep" id="passwordRep">
                </div>
                <div class="register_bottom">
                    <input class="submit_btn" type="submit" value="Зарегистрироваться">
                    <a href="./signin.php" class="readress">Уже есть аккаунт?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>