<?php
try{
    $pdo = new PDO("mysql:host=MySQL-8.0;dbname=dawn;charset=utf8","root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Ошибка подключения: ".$e->getMessage();
}
?>