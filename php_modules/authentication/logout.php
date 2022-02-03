<?php
    require_once "../connection.php";
    session_start();
    $db->query("
        UPDATE users
        SET PASSWORD_COOKIE_TOKEN=NULL
        WHERE ID=".$_SESSION['id']."
    ");
    session_destroy();
    header("Location: ../../pages/signin.php");
?>