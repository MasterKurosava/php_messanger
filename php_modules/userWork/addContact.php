<?php
    require_once "../connection.php";
    session_start();
    $newContact = json_decode(file_get_contents("php://input"), true);

    // Берем выбранного пользователя и его список
    $user=$db->query("
        SELECT ID
        FROM users 
        WHERE EMAIL LIKE '%$newContact%'
        OR LOGIN LIKE '%$newContact%'
    ");
    $user=$user->fetch(PDO::FETCH_ASSOC);

    //создаем новый приватный чат
    $chat_id="priv_".substr(md5(time()),0,6);

    $db->query("
        INSERT INTO private_list
        (ID, USER1_ID, USER2_ID) VALUES
        ('$chat_id',".$_SESSION['id'].", ".$user['ID'].")
    ");

    // Отправляем ответ на fetch
    echo json_encode([
        "userID"=>$user['ID'],
        "chatID"=>$chat_id
    ]);

    // Берем наши приватные чаты
    $currentPrivate=$db->query(" SELECT PRIVATE_CHAT_LIST FROM users WHERE ID =".$_SESSION['id']);
    $currentPrivate=$currentPrivate->fetch(PDO::FETCH_ASSOC);
    // Берем его приватные чаты
    $userPrivate=$db->query(" SELECT PRIVATE_CHAT_LIST FROM users WHERE ID =".$user['ID']);
    $userPrivate=$userPrivate->fetch(PDO::FETCH_ASSOC);

    //Добавляем в наш приватный чат
    $newCurrentPrivate=json_decode($currentPrivate['PRIVATE_CHAT_LIST']);
    $newCurrentPrivate[]=["userID"=> $user['ID'],"chatID"=>$chat_id];
    $newCurrentPrivate=json_encode($newCurrentPrivate);

    //Добавляем в его приватный чат
    $newUserPrivate=json_decode($userPrivate['PRIVATE_CHAT_LIST']);
    $newUserPrivate[]=["userID"=> $_SESSION['id'],"chatID"=>$chat_id];
    $newUserPrivate=json_encode($newUserPrivate);
    //Обновляем у нас и у него
    $db->query(" UPDATE users  SET PRIVATE_CHAT_LIST='$newCurrentPrivate'  WHERE ID = ".$_SESSION['id']);
    $db->query(" UPDATE users  SET PRIVATE_CHAT_LIST='$newUserPrivate'  WHERE ID = ".$user['ID']);
?>