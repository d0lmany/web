<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link rel="shortcut icon" href="assets/logo/logo.svg" type="image/svg">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/adm.css">
</head>
<body>
    <header><h1 style="color:var(--orange);margin:0">Панель администратора</h1></header>
    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Авторы</th>
                <th>Местоположение</th>
                <th>Год основания</th>
                <th>Авторы</th>
            </tr>
            <? include "connect.php"; $sql = $pdo -> query("SELECT * FROM objects"); $that = $sql -> fetchAll(PDO::FETCH_NUM);
            foreach($that as $row){
                echo "<tr>";
                for ($i=0; $i < count($row)-4; $i++) { 
                    echo "<td>$row[$i]</td>";
                }
                echo "<td>$row[8]</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <form action="add.php?w=0" method="post" enctype="multipart/form-data">
        <h3>Добавить объект</h3><hr>
        <section class="flex">
            <label>Название:<input required type="text" name="name"></label>
            <label>Авторы:<input required type="text" name="authors"></label>
            <label>Страна и город:<input required type="text" name="city"></label>
            <label>Год основания:<input required type="number" name="yof"></label>
            <label>Информация (используйте &#60;h3&#62; и &#60;p&#62;):<textarea name="info"></textarea></label>
            <label>Факты (используйте &#60;li&#62;):<textarea name="facts"></textarea></label>
            <label>Координаты:<input required type="text" name="map"></label>
            <label>Источники фото (в формате JSON):<textarea name="pics"></textarea></label>
            <label>Фото 1 (png):<input required type="file" accept="image/png" name="photo[]"></label>
            <label>Фото 2 (png):<input required type="file" accept="image/png" name="photo[]"></label>
            <label>Фото 3 (png):<input required type="file" accept="image/png" name="photo[]"></label>
            <label>Фото 4 (png):<input required type="file" accept="image/png" name="photo[]"></label>
            <label>Фото 5 (png):<input required type="file" accept="image/png" name="photo[]"></label>
            <input type="submit" value="Добавить">
        </section>
        </form>
        <form method="post">
            <h3>Создание QR-кода</h3><hr>
            <div id="img">
            <?
            $qrCodeUrl = '';
            if (isset($_POST["id"])){
                $id = $_POST["id"];
                $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . $id . '&size=200x200';
                echo '<img src="' . $qrCodeUrl . '" alt="QR Code" id="qrcode"/>';
            }
            ?>
            </div>
            <label>ID:<input required type="number" name="id"></label>
            <input type="submit" value="Создать">
            <?php if ($qrCodeUrl): ?>
                <div>
                    <a href="<? echo $qrCodeUrl; ?>" download="qrcode.png">Скачать QR-код</a>
                </div>
            <?php endif; ?>
        </form>
    </main>
    <div class="secret">Администрирование доступно только с компьютера!</div>
    <footer><a href="https://d0lmany.netlify.app">dev:d0lmany</a><a href="index.html">На главную</a></footer>
</body>
</html>