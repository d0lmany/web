<?php
include "connect.php";
if(isset($_GET["w"])){
    try{
            $mass = $_POST["del_id"];
            for ($i = 0; $i<count($mass); $i++) {
                $sql = "DELETE FROM products WHERE id=$mass[$i]";
                $pdo -> query($sql);
                unlink("img/". $mass[$i].".png");
            }
            $that = "Location: redirect.php?meth=1";
        } catch (Exception $e) {
            $that = "Location: redirect.php?error=$e";
        }
        header($that);
        exit();
}
if(isset($_GET["cat"])){
    try{
        $cat=$_GET["cat"];
    $sql = "DELETE FROM categories WHERE id=$cat";
    $pdo -> query($sql);
    $that = "Location: redirect.php?meth=1";
    } catch (Exception $e){
        $that = "Location: redirect.php?error=$e";
    }
    header($that);
        exit();
}
?>