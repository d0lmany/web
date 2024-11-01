<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование товара</title>
</head>
<body class="text-slate-50 bg-slate-900 accent-pink-500">
    <? include "connect.php"; sethead() ?>
    <main class="m-10 flex justify-center">
        <section class="w-1/2 m-1">
            <h3 class="text-lg text-center">
                <?
                if(isset($_POST["cobj"]) || isset($_POST["name"])){
                    echo "Внесите изменения";
                } else{
                    echo "Выберите товар";
                }
                ?>
            </h3>
            <?
            if(isset($_POST["name"])){
                $id=$_POST["id"]; $name=$_POST["name"]; $id_category=$_POST["category"]; $price=$_POST["price"];
        $quantity=$_POST["quantity"]; $ex_date=$_POST["ex_date"];
        try{
            $so = $pdo -> prepare("UPDATE products SET name=?, id_category=?, price=?, quantity=?, ex_date=? WHERE id=?");
            $so -> execute([$name,$id_category,$price,$quantity,$ex_date,$id]);
            $that= "Location: redirect.php?meth=3";
        } catch (Exception $e) {
            //$that ="Location: redirect.php?error=$e";
            echo "<script>alert($e)</script>";
        }
        header($that);
        exit();
            } else{
                if(isset($_POST["cobj"])){
                $cobj=$_POST["cobj"];
                $sql = "SELECT * FROM products WHERE id=$cobj";
                $res = $pdo -> query($sql);
                $war = $res->fetchAll(PDO::FETCH_NUM); $ware = $war[0];
                $qwe = "
                <form method='post' class='p-2 border border-slate-150 bg-indigo-950'>
                <label class='flex justify-between mb-1'>Имя товара:<input type='text' name='name' class='bg-slate-900 border border-slate-150 w-1/2' value=".$ware[1]."></label>
                <label class='flex justify-between mb-1'>Категория:<select name='category' class='bg-slate-900 border border-slate-150 w-1/2'>"; echo $qwe;
                show_categories();
                echo <<<LIT
                </select></label><label class='flex justify-between mb-1'>Цена:<input type='number' name='price' class='bg-slate-900 border border-slate-150 w-1/2' value=".$ware[3]."></label>
                <label class='flex justify-between mb-1'>Количество:<input type='number' name='quantity' class='bg-slate-900 border border-slate-150 w-1/2' value=".$ware[4]."></label>
                <label class='flex justify-between mb-1'>Годен до:<input type='date' name='ex_date' class='bg-slate-900 border border-slate-150 w-1/2' value=".$ware[5]."></label>
                <input type='hidden' name='id' value=$ware[0]><input type='submit' value='Сохранить' class='bg-violet-950 p-2 text-center hover:bg-violet-900 transition duration-150 w-full'>
                LIT;
            } else {
                $qwe = <<<LIT
                <form method="post" class="p-2 border border-slate-150 bg-indigo-950">
            <table class="border-separate border border-slate-500 border-spacing-1 w-full">
                <tr class="bg-cyan-950 border border-slate-500">
                    <th>Товар</th>
                    <th>ID Категории</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Годен до</th>
                    <th>    </th>
                </tr>
    LIT;
    echo $qwe;
    $result = $pdo->query("SELECT * FROM products");
            $ware = $result->fetchAll(PDO::FETCH_NUM);
            foreach($ware as $row){
                echo "<tr class='hover:bg-cyan-700 transition duration-150'>";
                for ($i = 1; $i < count($row); $i++) {
                    echo '<td>' . htmlspecialchars($row[$i]) . '</td>';
                }
                echo "<td class='text-center hover:bg-violet-700 transition duration-150'><button type='submit' name='cobj' value=$row[0]>Выбрать</button></td></tr>";
            } echo "</table>";
            }
            }
            ?>
        </form>
        </section>
    </main>
    <?setfooter()?>
</body>
</html>