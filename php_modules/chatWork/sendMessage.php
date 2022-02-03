<?php
    require_once "../connection.php";
    $request=json_decode(file_get_contents("php://input"),true);

    //Добавление сообщения
    $userID=$request['currentID'];
    $chatID=$request['chatID'];
    $content=$request['value'];
    $date=date('j.m.Y H:i');
    
    $userName=$db->query("SELECT LOGIN, EMAIL FROM users WHERE ID=".$userID);
    $userName=$userName->fetch(PDO::FETCH_ASSOC);
    if($userName['LOGIN']) $userName=$userName['LOGIN'];
    else $userName=$userName['EMAIL'];

    $db->query("
        INSERT INTO message_list
        (CHAT_ID, USER_ID, USER_NAME, CONTENT, TIME)
        VALUES
        ('$chatID',$userID,'$userName','$content', '$date')
    ");

?>