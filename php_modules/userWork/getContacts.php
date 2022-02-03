<?php
    session_start();
    require_once __DIR__."/../connection.php";

    $request = json_decode(file_get_contents("php://input"), true);

    //запрашиваем наши контакты
    $contactsList=$db->query("SELECT PRIVATE_CHAT_LIST FROM users WHERE ID=".$_SESSION['id']);
    $contactsList=$contactsList->fetch();
    $contactsList=json_decode($contactsList['PRIVATE_CHAT_LIST'],true);
    //если есть контакты
    if(count($contactsList)){
        $sqlContacts='';
        for ($i=0; $i < count($contactsList); $i++) {
            $sqlContacts.= $contactsList[$i]['userID'];
            if($i!=count($contactsList)-1){
                $sqlContacts.=",";
            }
        }
        //запрашиваем наши контакты
        if($request=="userContactList"){
            $contacts=$db->query("SELECT ID, LOGIN, EMAIL FROM users WHERE ID IN (".$sqlContacts.")");
            $contacts=$contacts->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($contacts);
        }
        //запрашиваем наши приватные сообщения
        else{
            //приватные чаты
            $privateList=$db->query("SELECT PRIVATE_CHAT_LIST FROM users WHERE ID=".$_SESSION['id']);
            $privateList=$privateList->fetch(PDO::FETCH_ASSOC);
            $privateList=$privateList['PRIVATE_CHAT_LIST'];
            $privateList=json_decode($privateList,true);

            foreach ($privateList as $chat) {
                $contact=$db->query("SELECT ID, LOGIN, EMAIL FROM users WHERE ID =".$chat['userID']);
                $contact=$contact->fetch(PDO::FETCH_ASSOC);
                if($contact['LOGIN']){
                    echo "<li private='".$chat['chatID']."' userID='".$chat['userID']."' class='contact_item'>".$contact['LOGIN']."</li>";
                }else{
                    echo "<li private='".$chat['chatID']."' userID='".$chat['userID']."' class='contact_item'>".$contact['EMAIL']."</li>";
                }
            };
        }
    }
?>