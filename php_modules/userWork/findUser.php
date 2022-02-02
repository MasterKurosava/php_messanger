<?php
    session_start();
    require_once "../connection.php";
    $searching = json_decode(file_get_contents("php://input"), true);
    $users=$db->query("
    SELECT ID, LOGIN, EMAIL 
    FROM users 
    WHERE EMAIL LIKE '%$searching%'
    OR LOGIN LIKE '%$searching%'
    ");
    $users=$users->fetchAll(PDO::FETCH_ASSOC);

    $currentContacts=$db->query("
    SELECT ID, CONTACTS_LIST 
    FROM users 
    WHERE EMAIL = '".$_SESSION['email']."'
    ");

    $currentContacts=$currentContacts->fetch(PDO::FETCH_ASSOC);
    $id=$currentContacts['ID'];
    $currentContacts=json_decode($currentContacts['CONTACTS_LIST']);
    $filter=array();
    
    for ($i=0; $i <= count($users); $i++) { 
        $valid=true;
        for ($j=0; $j <= count($currentContacts); $j++) { 
           if($users[$i]['ID']==$currentContacts[$j] || $users[$i]['ID']==$id){
            $valid=false;
           }
        }
        if($valid){ $filter[]=$users[$i];}
    }
    
    if(count($filter)>0){
        echo json_encode(array_values($filter));
    }else{
        echo json_encode([]);
    }
?>