<?php
    require_once __DIR__."/../connection.php";
    session_start();
    $chat_data=json_decode(file_get_contents("php://input"),true);

    $chatID="group_". substr(md5(time()),0,5);;
    $usersID= $chat_data['users'];
    $usersID[]=$_SESSION['id'];

    $createChat=$db->query("
        INSERT INTO group_list 
        (ID, NAME, USERS) VALUES 
        ('$chatID' , '".$chat_data['chatName']."' , '".json_encode($usersID)."')
    ");

    $setUsersList=$db->query("
        SELECT ID, GROUP_CHAT_LIST FROM users
        WHERE ID IN (". implode(",", $usersID). ")
    ");
    $setUsersList=$setUsersList->fetchAll(PDO::FETCH_ASSOC);

    foreach ($setUsersList as $list) {
        $newList=json_decode($list['GROUP_CHAT_LIST'],true);
        $newList[]=$chatID;
        $newList=json_encode($newList);
        
        $setUsersList=$db->query("
            UPDATE users SET GROUP_CHAT_LIST='$newList' WHERE ID=".$list['ID']."
        ");
    }

    echo json_encode([
        "chat_ID"=>$chatID,
        "chat_name"=>$chat_data['chatName'],
    ])
?>