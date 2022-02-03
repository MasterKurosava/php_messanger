<?php
    require_once "../connection.php";
    session_start();
    $request=json_decode(file_get_contents("php://input"),true);

    //Находим чат и имя чата
    $chat=$db->query("
        SELECT * FROM group_list
        WHERE ID='".$request['chatID']."'
    ");
    
    $chat=$chat->fetch(PDO::FETCH_ASSOC);

    //Берем историю сообщений
    $messages=$db->query("
        SELECT *
        FROM message_list
        WHERE CHAT_ID='".$request['chatID']."'
        ORDER BY TIME ASC
    ");

    $messages=$messages->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "currentUser"=>$_SESSION['id'],
        "chatName"=>$chat['NAME'],
        "messages"=>$messages,
        "chatUsers"=>$chat['USERS']
    ])

?>