<?php
include "connect.php";
switch($_GET["meth"]){
    case "put":
        $mass_id = array_filter($_POST["cart_id"], 'strlen'); $the_price = 0;
        for ($i=0; $i < count($mass_id); $i++) { 
            $a_price = $pdo -> query("SELECT price FROM products WHERE id = $mass_id[$i]");
            $get_price = ($a_price -> fetch(PDO::FETCH_NUM))[0];
            $the_price += $get_price;
        }
        $products = join(" ",$mass_id);
        try{
            $pdo -> query("INSERT INTO cart(products,sum) VALUES('$products',$the_price)");
        } catch (PDOException $e){
            echo $e;
        }
        break;
    case "buy":
        $pdo -> query("TRUNCATE TABLE cart");
        echo "<script>alert('Товары куплены!');window.location.href = 'cart.php'</script>";
}
?>