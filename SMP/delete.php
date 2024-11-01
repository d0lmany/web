<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>*{outline:none}</style>
    <title>Удаление позиций</title>
</head>
<body class="text-slate-50 bg-slate-900 accent-pink-500">
    <? include "connect.php"; sethead();?>
    <main class="m-10 flex justify-center">
    <section class="w-2/3 m-1">
        <h3 class="text-lg text-center">Удалить товар</h3>
        <form action="drop.php?w=1" method="post" class="p-2 border border-slate-150 bg-indigo-950">
            <table class="border-separate border border-slate-500 border-spacing-1 w-full">
                <tr class="bg-cyan-950 border border-slate-500">
                    <th>    </th>
                    <th>Товар</th>
                    <th>ID Категории</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Годен до</th>
                </tr>
                <?
                $result = $pdo->query("SELECT * FROM products");
                $ware = $result->fetchAll(PDO::FETCH_NUM);
                foreach($ware as $row){
                    echo "<tr><td><input type='checkbox' name='del_id[]' value='".$row[0]."'></td>";
                    for ($i = 1; $i < count($row); $i++) {
                        echo '<td>' . htmlspecialchars($row[$i]) . '</td>';
                    }
                    echo '</tr>';
                }
                ?>
            </table>
            <input type="submit" value="Удалить" class="bg-violet-950 p-2 text-center hover:bg-violet-900 transition duration-150 w-full">
        </form>
    </section>
    <section class="w-1/3 m-1">
        <section>
            <h3 class="text-lg text-center">Удалить категорию</h3>
        <form method="post" class="p-2 border border-slate-150 bg-indigo-950">
            <select name="category" class="bg-slate-900 border border-slate-150 w-full"><? echo show_categories() ?></select>
            <input type="submit" value="Проверить" class="bg-violet-950 p-2 text-center hover:bg-violet-900 transition duration-150 w-full">
        </form>
        </section>
        <section>
            <?
            if(isset($_POST["category"])){
                $check = $_POST["category"]; $sql="SELECT * FROM products WHERE id_category=$check";
                $result = $pdo -> query($sql); $ware = $result->fetchAll(PDO::FETCH_NUM);
                if(empty($ware)){
                    $sodel = <<<EOT
                    <p class="text-lg text-center">Категория пуста</p>
                    <form action="drop.php?cat=$check" method="post" class="p-2 border border-slate-150 bg-indigo-950">
                    <input type="submit" value="Удалить" class="bg-violet-950 p-2 text-center hover:bg-violet-900 transition duration-150 w-full">
                    </form>
                    EOT;
                    echo $sodel;
                } else{
                    prods_in_cats($ware);
                }
            }
            ?>
        </section>
    </section>
    </main>
    <?setfooter()?>
</body>
</html>