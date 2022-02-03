<?php
    require_once __DIR__."/../connection.php";
    session_start();
    $userList=$db->query("
         SELECT GROUP_CHAT_LIST
         FROM users
         WHERE ID = ".$_SESSION['id']
    );
    $userList=$userList->fetch(PDO::FETCH_ASSOC);
    if($userList){
        $userList=implode("','" , json_decode($userList['GROUP_CHAT_LIST'],true));
        $userChats=$db->query("
            SELECT ID, NAME
            from group_list
            WHERE ID IN ('$userList')
        ");

        $userChats=$userChats->fetchAll(PDO::FETCH_ASSOC);

        foreach ($userChats as $chat) {
            echo "<li group='".$chat['ID']."' class='group_item'>".$chat['NAME']."</li>";
        }
    }
?>