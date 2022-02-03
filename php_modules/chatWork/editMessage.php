<?php
    require_once "../connection.php";
    $request=json_decode(file_get_contents("php://input"),true);

    //Находим чат и имя чата
    $db->query("
        UPDATE message_list
        SET CONTENT='".$request['newContent']."'
        WHERE ID=".$request['messageID']
    );

?>