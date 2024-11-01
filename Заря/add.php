<?php
include "connect.php";
function lol($type){
    switch($type){
        case "int":
            return "INT";
            break;
        case "string":
            return "VARCHAR(255)";
            break;
    }
}
$w=$_GET["w"];
switch($w){
    case 0:
        $name = $_POST["name"]; $authors = $_POST["authors"]; $city = $_POST["city"]; $yof = $_POST["yof"]; $pics = $_POST["pics"]; 
        $info = $_POST["info"]; $facts = $_POST["facts"]; $map = $_POST["map"]; $file_count = 1;
        foreach($_FILES["photo"]["tmp_name"] as $key => $tmp_name){
            $path = "assets/img/$file_count/img" . $file_count . ".png";
            if(move_uploaded_file($tmp_name,$path)){
                echo "Загружено";
            } else {
                echo "ошибка загрузки файла";
            }
            $file_count++;
        }
        $stmt = $pdo -> prepare("INSERT INTO objects(name,authors,city,yof,info,facts,map,pics) VALUES(?,?,?,?,?,?,?,?)");
        $stmt -> execute([$name,$authors,$city,$yof,$info,$facts,$map,$pics]);
        break;
}
echo "<script>window.location.href = 'adm.html'</script>";
?>