<?php
    session_start();
    require_once "../php_modules/connection.php";
    $contactsList=$db->query("SELECT CONTACTS_LIST FROM users WHERE EMAIL='".$_SESSION['email']."'");
    $contactsList=$contactsList->fetch();
    $contactsList=json_decode($contactsList['CONTACTS_LIST']);
    if(count($contactsList)){
        $sqlContacts='';
        for ($i=0; $i < count($contactsList); $i++) {
            $sqlContacts.= $contactsList[$i];
            if($i!=count($contactsList)-1){
                $sqlContacts.=",";
            }
        }
        $contats=$db->query("SELECT ID,LOGIN, EMAIL FROM users WHERE ID IN (".$sqlContacts.")");
        $contats=$contats->fetchAll();

        foreach ($contats as $contact) {
            if($contact['LOGIN']){
                echo "<li id='user_".$contact['ID']."' class='contact_item'>".$contact['LOGIN']."</li>";
            }else{
                echo "<li id='user_".$contact['ID']."' class='contact_item'>".$contact['EMAIL']."</li>";
            }
        };
    };
?>