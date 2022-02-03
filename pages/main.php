<?php
    session_start();
    if(!$_SESSION['id']){
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Мессенджер</title>
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/forms.css" rel="stylesheet" type="text/css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8 " />
  </head>
  <body>
    <div class="main">
        <div class="container">
            <div class="container_sidebar">
                <div class="contacts">
                    <h3 class="title">Ваши контакты</h3>
                    <div class="add_contact"><span class="add_plus">+</span> Добавить контакт</div>
                    <div class="contacts_container">
                        <ul class="contacts_list">
                            <?php require_once "../php_modules/userWork/getContacts.php" ?>
                        </ul>
                    </div>
                </div> 
                <div class="group">
                    <h3 class="title">Ваши групповые чаты</h3>
                    <div class="add_group"><span class="add_plus">+</span> Добавить групповой чат</div>
                    <div class="groups_container">
                        <ul class="groups_list">
                        <?php require_once "../php_modules/chatWork/getGroups.php" ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chat_container">
                <!-- чат -->
            </div>

            <div class="settings_menu">
                <ul class="settings_list">
                    <li class="setting_item"><a href="./profile.php">Профиль</a></li>
                    <li class="setting_item"><a href="../php_modules/authentication/logout.php">Выйти</a></li>
                </ul>

            </div>
            </div>
        </div>
    </div>
    <script type="module"  src="../js/main.js"></script>
    <script type="module"  src="../js/interface/contacts.js"></script>
    <script type="module"  src="../js/interface/groups.js"></script>
  </body> 
</html>