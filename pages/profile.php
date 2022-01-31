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
               <div class="change_photo">
                    <label for="photo">Выберите фото</label>
                    <input type="file" class="profile_choicePhoto" id="photo">
               </div>
           </div>
           <div class="profile_userdata">
                <div class="user_data">
                    <!-- Login -->
                    <div class="profile_label">
                        <p class="profile_login">Профиль</p>
                        <input disabled class="user_login"value="Mr.Kurosava">
                    </div>
                    <!-- email -->
                    <div class="profile_label">
                        <p class="profile_login">Почта</p>
                        <input disabled class="user_login" value="mihailkalachiov@mail.ru">
                    </div>
                    <!-- telephone -->
                    <div class="profile_label">
                        <p class="profile_login">Телефон</p>
                        <input disabled type="number" class="user_login" value="8 777 307 8555">
                    </div>
                </div>
                <div class="profile_redacticting">Редактирование профиля</div>
           </div>
       </div>
    </div>
</body>
</html>