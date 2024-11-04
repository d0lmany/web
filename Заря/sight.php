<!DOCTYPE html>
<?php
include "connect.php";
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $stmt = $pdo -> prepare("SELECT COUNT(*) FROM objects WHERE id = :id");
    $stmt -> bindParam(':id', $id, PDO::PARAM_INT); $stmt -> execute();
    $response = $stmt -> fetchColumn();
    if($response < 1){
        echo "<script>alert('Некорректный QR-код. Перенаправляем на главную');window.location.href = 'index.html'</script>";
    }
    $stmt = $pdo -> prepare("SELECT * FROM objects WHERE id = :id");
    $stmt -> bindParam(':id', $id, PDO::PARAM_INT); $stmt -> execute();
    $response = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(!$response){
        echo "<script>alert('Ошибка баз данных. Перенаправляем на главную');window.location.href = 'index.html'</script>";
    }
}
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? echo $response["name"] ?></title>
    <link rel="shortcut icon" href="assets/logo/logo.svg" type="image/svg">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/sight.css">
    <script src="assets/js/album.js"></script>
</head>
<body>
    <header>
        <a href="index.html" class="flex"><img src="assets/logo/logoText.svg" alt="ЗАРЯ"></a>
        <a href="scanning.html">Сканировать</a>
    </header>
    <article>
        <div class="spr"></div>
        <div class="about">
            <section>
                <div class="wrap"><img src="<?
                $path = "assets/img/".$response["path"];
                $files = array_diff(scandir($path), array('.', '..'));
                echo $path."/".$files[2];
                ?>" id="main"></div>
                <div class="album">
                    <?
                    for ($i=2; $i < count($files)+2; $i++) { 
                        $p = $path."/".$files[$i];
                        echo "<img src=$p onclick='select(this)'>";
                    }
                    ?>
                </div>
            </section>
            <section>
                <h1 style="color:var(--orange);font-size:2em;margin:0"><? echo $response["name"] ?></h1>
                <section>
                    <div class="flex">
                        <span>Авторы:</span>
                        <span>Местоположение:</span>
                        <span>Год основания:</span>
                    </div>
                    <div class="flex">
                        <span><? echo $response["authors"] ?></span>
                        <span><? echo $response["city"] ?></span>
                        <span><? echo $response["yof"] ?></span>
                    </div>
                </section>
                <h3>Источники изображений</h3>
                <section>
                    <?
                        $b = json_decode($response["srcs"], true);
                        $authors = $b['authors'];
                        echo "<table>";
                        echo "<tr><th>№</th><th>Источник</th></tr>";
                        foreach ($authors as $index => $author) {
                            echo "<tr><td>" . ($index + 1) . "</td><td>" . htmlspecialchars($author) . "</td></tr>";
                        }
                        echo "</table>";
                        ?>
                    </div>
                </section>
            </section>
        </div>
        <div class="text">
            <h1 style="color:var(--green)">Подробнее</h1>
            <? echo $response["info"]; ?>
            <h4>Факты</h4>
             <ul>
                <? echo $response["facts"];?>
             </ul>
            </div>
            <h1 style="color:var(--orange)">Карта</h1>
            <iframe src="<? echo $response["map"];?>"></iframe>
    </article>
    <footer>
        <ul>
            <li>Контакты</li>
            <li>Email: info@dawn.ru</li>
            <li>Телефон: +7 (999) 123-45-67</li>
        </ul>
        <ul>
            <li>О нас</li>
            <li><a href="https://mit-license.org/">MIT License</a></li>
            <li><a href="https://d0lmany.netlify.app">dev: d0lmany</a></li>
        </ul>
        <ul>
            <li>Копирайты</li>
            <li>© 2024 Заря</li>
            <li>Некоммерческий проект</li>
        </ul>
    </footer>
</body>
</html>