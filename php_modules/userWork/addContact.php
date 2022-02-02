<?php
    require_once "../connection.php";
    session_start();
    $newContact = json_decode(file_get_contents("php://input"), true);
    $user=$db->query("
    SELECT ID 
    FROM users 
    WHERE EMAIL LIKE '%$newContact%'
    OR LOGIN LIKE '%$newContact%'
    ");
    $user=$user->fetch(PDO::FETCH_ASSOC);

    $currentUser=$db->query("
    SELECT ID, CONTACTS_LIST
    FROM users 
    WHERE EMAIL = '".$_SESSION['email']."'
    ");
    $currentUser=$currentUser->fetch(PDO::FETCH_ASSOC);

    $newContactList=json_decode($currentUser['CONTACTS_LIST']);
    $newContactList[]=$user['ID'];
    $newContactList=json_encode($newContactList);

    $sql=$db->query("
    UPDATE users 
    SET CONTACTS_LIST='$newContactList' 
    WHERE ID = ".$currentUser['ID']."
    ");
    
    echo $currentUser['ID'];
?>