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
    <header>
        <h1 style="color:var(--orange);margin:0">Панель администратора</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Авторы</th>
                    <th>Местоположение</th>
                    <th>Год основания/открытия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "connect.php";
                $stmt = $pdo->query("SELECT * FROM objects")->fetchAll(PDO::FETCH_NUM);
                foreach ($stmt as $row) {
                    echo "<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td><td>{$row[4]}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <footer><a href="https://d0lmany.netlify.app">dev:d0lmany</a><a href="adm.php">К панели</a><a href="index.html">На главную</a></footer>
</body>