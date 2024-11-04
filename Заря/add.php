<?php
include "connect.php";
$name = htmlspecialchars($_POST['name']); $authors = htmlspecialchars($_POST['authors']);
$city = htmlspecialchars($_POST['city']); $yof = htmlspecialchars($_POST['yof']);
$map = htmlspecialchars($_POST['map']); $h1 = htmlspecialchars($_POST['h1']);
$p1 = htmlspecialchars($_POST['p1']); $h2 = htmlspecialchars($_POST['h2']);
$p2 = htmlspecialchars($_POST['p2']); $facts = htmlspecialchars($_POST['facts']); $photos = $_FILES['photo']; $good = false;

$link = str_replace("maps","map-widget/v1",$map);

$info = "<h3>$h1</h3><p>$p1</p><h3>$h2</h3><p>$p2</p>";

$fa = explode("\n",$facts); $facts = "";
foreach($fa as $f){
    $facts .= "<li>$f</li>";
}

$random = bin2hex(random_bytes(5));
mkdir("assets/img/$random"); $auth = [];
for ($i=0; $i < count($photos["name"]); $i++) { 
    $ftmpname = $photos["tmp_name"][$i];
    $ftype = str_replace("image/","",$photos["type"][$i]);
    $tfn = 'f'.($i+1);
    if(!empty($_POST[$tfn])){
        $auth[] = htmlspecialchars($_POST[$tfn]);
        if(move_uploaded_file($ftmpname,"assets/img/$random/$i.$ftype")){
            echo "загружено";
            $good = true;
        } else{
            echo "ошибка загрузки";
            $good = false;
        }
    }
}
$json = json_encode(['authors' => $auth]);
try{
    $sql = $pdo -> prepare("INSERT INTO objects(name,authors,city,yof,map,info,facts,srcs,path) VALUES(?,?,?,?,?,?,?,?,?)");
    $sql -> execute([$name,$authors,$city,$yof,$link,$info,$facts,$json,$random]); $good = true;
} catch (PDOException $e){
    echo $e;
    $good = false;
}
if($good){
    echo "<script>window.location.href = 'adm.html'</script>";
}
?>