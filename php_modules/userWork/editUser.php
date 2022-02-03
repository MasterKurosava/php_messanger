<?php
    require_once "../connection.php";
    session_start();
    $userData = json_decode(file_get_contents("php://input"), true);

    $login=$userData['login'];

    if($login){
        $db->query("
            UPDATE users 
            SET LOGIN='".$login."' 
            WHERE ID = ".$_SESSION['id']."
        ");
    }
    var_dump($_FILES['profile_img']);
    if(isset($_FILES['profile_img'])){
        $file_array=$_FILES['profile_img'];
        
        $extension = array('jpg', 'png', 'jpeg');
        // $file_ext=explode('.',$file_array[$])
    }
?>