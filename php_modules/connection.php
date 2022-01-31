<?php
    $host="localhost";
    $name="root";
    $password="";
    $dbname="kurosava";
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $name, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    if(!$db){
        die('Ошибка соединения');
    }
?>