<?php
echo "<script src='https://cdn.tailwindcss.com'></script>";//damn
$req=0; $dbname="fpyzvpbd_m1";
switch($req){
    case 0:
        $server="MySQL-8.0"; $user="root"; $pass="";
        break;
    case 1:
        $server="localhost"; $user="fpyzvpbd"; $pass="nRydG2";
        break;
}
try{
    $pdo = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8",$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Ошибка подключения: ".$e->getMessage();
}
#   FUNCTIONS   #
function getprods(){
    global $pdo;
    if($sql = ($pdo -> query("SELECT * FROM cart ORDER BY id DESC LIMIT 1"))-> fetch(PDO::FETCH_NUM)){
        $sql = $pdo -> query("SELECT * FROM cart ORDER BY id DESC LIMIT 1");
    $cart = $sql -> fetch(PDO::FETCH_NUM); $ids = explode(" ",$cart[1]); $prods = [];
    foreach($ids as $id){
        $sql = ($pdo -> query("SELECT name FROM products WHERE id = $id")) -> fetch();
        array_push($prods,$sql[0]);
    }
    $row = join(", ",$prods);
    echo "<tr><td>$row</td><td>$cart[2]</td></tr>";
    }
}
function showtab1($tn, $categoryFilter = null, $orderBy = null, $orderDirection = 'ASC', $search = null) {
    global $pdo;
    list($sql, $params) = buildSql($tn, $categoryFilter, $orderBy, $orderDirection, $search);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $ware = $stmt->fetchAll(PDO::FETCH_NUM);
    foreach ($ware as $row) {
        echo '<tr class="hover:bg-cyan-700 transition duration-150 text-lg">';
        echo "<td><input type='checkbox' name='cart_id[]' value='".$row[0]."'></td>";
        if ($tn == "products") {
            $path = "img" . DIRECTORY_SEPARATOR . $row[0] . ".png";
            echo "<td class='w-24'><img src='$path' alt='$row[0]'></td>";
        }
        for ($i = 1; $i < count($row); $i++) {
            echo '<td>' . htmlspecialchars($row[$i]) . '</td>';
        }
        echo '</tr>';
    }
}
function showtab($tn, $categoryFilter = null, $orderBy = null, $orderDirection = 'ASC', $search = null) {
    global $pdo;
    list($sql, $params) = buildSql($tn, $categoryFilter, $orderBy, $orderDirection, $search);
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $ware = $stmt->fetchAll(PDO::FETCH_NUM);
    foreach ($ware as $row) {
        echo '<tr class="hover:bg-cyan-700 transition duration-150 text-lg">';
        if ($tn == "products") {
            $path = "img" . DIRECTORY_SEPARATOR . $row[0] . ".png";
            echo "<td class='w-24'><img src='$path' alt='$row[0]'></td>";
        }
        for ($i = 1; $i < count($row); $i++) {
            echo '<td>' . htmlspecialchars($row[$i]) . '</td>';
        }
        echo '</tr>';
    }
}
function buildSql($tn, $categoryFilter = null, $orderBy = null, $orderDirection = 'ASC', $search = null) {
    $sql = "SELECT * FROM $tn";
    $where = [];
    $params = [];
    if ($categoryFilter !== null && $categoryFilter !== "") {
        $where[] = "id_category = ?";
        $params[] = $categoryFilter;
    }
    if ($search !== null && $search !== "") {
        $where[] = "name LIKE ?";
        $params[] = "%" . $search . "%";
    }
    if (!empty($where)) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }
    if ($orderBy !== null) {
        $sql .= " ORDER BY $orderBy $orderDirection";
    }
    return [$sql, $params];
}
function sethead(){
    $temp = <<<'EOT'
    <header class="bg-slate-950 p-4 flex justify-between">
    <a href="index.php" class="hover:text-purple-600 transition duration-150 text-lg flex items-center">Система управления товарами</a>
    <div class="relative inline-block text-left"><div>
    <button class="inline-flex justify-center w-full hover:text-cyan-600 transition duration-150 text-lg outline-none" id="menu-button">
    Меню</button></div><div class="absolute right-0 z-10 mt-2 w-56 rounded-md hidden bg-slate" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="menu">
    <div class="py-1" role="none">
    <a href="show.php" class="block px-4 py-2 text-sm hover:bg-cyan-700 bg-slate-800 transition duration-150" role="menuitem">Обозреватель</a>
    <a href="cart.php" class="block px-4 py-2 text-sm hover:bg-cyan-700 bg-slate-800 transition duration-150" role="menuitem">Корзина</a>
    <a href="add.php" class="block px-4 py-2 text-sm hover:bg-cyan-700 bg-slate-800 transition duration-150" role="menuitem">Добавить позицию</a>
    <a href="delete.php" class="block px-4 py-2 text-sm hover:bg-cyan-700 bg-slate-800 transition duration-150" role="menuitem">Удалить позицию</a>
    <a href="editor.php" class="block px-4 py-2 text-sm hover:bg-cyan-700 bg-slate-800 transition duration-150" role="menuitem">Редактировать товар</a>
    </div></div></div></header><script>
    const menuButton = document.getElementById('menu-button');
    const menu = document.getElementById('menu');
    let timeout; function showMenu() {
        clearTimeout(timeout);
        menu.classList.remove('hidden');
    } function hideMenu() {
        timeout = setTimeout(() => {
            menu.classList.add('hidden');
        }, 200);
    }
    menuButton.addEventListener('mouseenter', showMenu);
    menuButton.addEventListener('mouseleave', hideMenu);
    menu.addEventListener('mouseenter', showMenu);
    menu.addEventListener('mouseleave', hideMenu);
    </script>
    EOT;
    echo $temp;
}
function show_categories(){
    global $pdo;
    $result = $pdo->query("SELECT * FROM categories");
    $ware = $result->fetchAll(PDO::FETCH_NUM);
    foreach($ware as $row){
        echo "<option value='$row[0]'>$row[1]</option>";
    }
}
function prods_in_cats($rows){
    $manytext = <<<'EOT'
    <p>Обнаружены товары в категории!</p>
    <table class="border-separate border border-slate-150 border-spacing-1 w-full p-2 bg-indigo-950">
                <tr class="bg-cyan-950 border border-slate-500">
                    <th>ID</th>
                    <th>Товар</th>
                    <th>Цена</th>
                </tr>
    EOT;
    echo $manytext;
    foreach($rows as $row){
        echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[3]</td></tr>";
    }
    echo "</table>";
}
function setfooter(){
    echo <<< KEO
    <footer class="bg-slate-950 p-4 flex justify-end">
        <a href="https://d0lmany.netlify.app" class="hover:text-purple-600 transition duration-150 text-lg">dev: d0lmany</a>
    </footer>    
    KEO;
}
?>