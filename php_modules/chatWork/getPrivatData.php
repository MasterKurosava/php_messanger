<?php
    require_once "../connection.php";
    session_start();
    $request=json_decode(file_get_contents("php://input"),true);

    //Берем имя  пользователя
    $userName=$db->query("
        SELECT LOGIN, EMAIL
        FROM users
        WHERE ID=".$request['userID']
    );
    $userName=$userName->fetch(PDO::FETCH_ASSOC);
    if($userName['LOGIN']) $userName=$userName['LOGIN'];
    else $userName=$userName['EMAIL'];

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
        "userName"=>$userName,
        "messages"=>$messages
    ])

?>