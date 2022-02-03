<?php
    require_once "../php_modules/connection.php";
    session_start();
    $user=$db->query("
        SELECT LOGIN, IMG_PROFILE
        FROM users
        WHERE ID=".$_SESSION['id']
    );
    $user=$user->fetch(PDO::FETCH_ASSOC);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css" type="text/css">
    <title>Профиль</title>
</head>
<body>
    <div class="main">
       <div class="profile_container">
            <div class="profile_header">
                <h3 class="profile_title">Профиль</h3>
            </div>
           <div class="profile_photoContainer">
               <div class="profile_photo">
                   <img class="photo" src="../img/enoske.jpg">
               </div>
            <form class="change_photo" >
                    <label for="photo">Выберите фото</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                    <input type="file" class="profile_choicePhoto" id="photo" name="profile_img">
                    <button type="submit" class="send_photo disabled">Отправить</button>
               </form>
               <span class="file_name"></span>
           </div>
           <div class="profile_userdata">
                <div class="user_data">
                    <!-- Login -->
                    <div class="profile_label" >
                        <p class="profile_labelTitle">Профиль</p>
                        <input disabled class="user_login" value="<?php echo $user['LOGIN'] ?>">
                    </div>
                </div>
                <div class="profile_redacticting">Редактирование профиля</div>
           </div>
       </div>
    </div>
    <script type="module" src="../js/profile.js"></script>
</body>
</html>