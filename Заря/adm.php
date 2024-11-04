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
        <form action="add.php" method="post" enctype="multipart/form-data" style="width:65%">
            <h3>Добавить объект</h3>
            <hr>
            <h4>Основное</h4>
            <label>Название:<input required type="text" name="name" required></label>
            <label>Авторы:<input required type="text" name="authors" required></label>
            <label>Страна и город:<input required type="text" name="city" required></label>
            <label>Год основания:<input required type="number" name="yof" required></label>
            <h4>Карта</h4>
            <label>Ссылка на карту:<input required type="url" name="map"></label>
            <p>Перейдите на <a href="https://yandex.ru/map-constructor/">этот сайт</a> и следуйте инструкции справа, если ещё не знаете как добавить карту.</p>
            <h4>Информация</h4>
            <label>Первый заголовок:<input type="text" name="h1" required></label>
            <label>Информация:<textarea name="p1" required></textarea></label>
            <label>Второй заголовок:<input type="text" name="h2" required></label>
            <label>Информация:<textarea name="p2" required></textarea></label>
            <label>Факты (каждый факт с новой строки):<textarea name="facts" required></textarea></label>
            <h4>Фото</h4>
            <p>Выберите картинки и подпишите её источник</p>
            <h5>Основное (обязательно)</h5>
            <label><input type="file" name="photo[]" required><input type="text" name="f1" required></label>
            <h5>Дополнительные (опционально)</h5>
            <label><input type="file" name="photo[]"><input type="text" name="f2"></label>
            <label><input type="file" name="photo[]"><input type="text" name="f3"></label>
            <label><input type="file" name="photo[]"><input type="text" name="f4"></label>
            <label><input type="file" name="photo[]"><input type="text" name="f5"></label>
            <input type="submit" value="Добавить">
        </form>
        <section>
            <form method="post">
                <h3>Создание QR-кода</h3>
                <hr>
                <div id="img">
                    <?
                    $qrCodeUrl = '';
                    if (isset($_POST["id"])) {
                        $id = $_POST["id"];
                        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($id) . '&size=200x200';
                        if (!is_dir("qr")) {
                            mkdir("qr", 0755, true);
                        }
                        $fileName = 'qr/qrcode_' . $id . '.png';
                        $imageData = file_get_contents($qrCodeUrl);
                        if ($imageData !== false) {
                            file_put_contents($fileName, $imageData);
                            echo '<img src="' . $fileName . '" alt="QR Code" id="qrcode"/>';
                        } else {
                            echo 'Ошибка при получении QR-кода.';
                        }
                    }
                    ?>

                </div>
                <label><select name="id" required style="width:100%;padding:1%">
                        <option value="">Выберите объект</option>
                        <?
                        include "connect.php";
                        $stmt = $pdo->query("SELECT id,name FROM objects");
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            echo "<option value='" . htmlspecialchars($row["id"]) . "'>" . htmlspecialchars($row["name"]) . "</option>";
                        }
                        ?>
                    </select></label>
                <p>Сгенерированные QR-коды сохраняются в папке "qr"</p>
                <input type="submit" value="Создать">
                <?php if ($qrCodeUrl): ?>
                    <div>
                        <a href="<? echo $qrCodeUrl; ?>" download>Скачать QR-код</a>
                    </div>
                <?php endif; ?>
            </form>
            <form>
                <h3>Как создать карту?</h3>
                <hr>
                <ul>
                    <li>Перейдите на <a href="https://yandex.ru/map-constructor/">этот сайт</a></li>
                    <li>Нажмите на "создать карту"</li>
                    <li>Введите адрес объекта в поле сверху или найдите его самостоятельно</li>
                    <li>Нажмите на него, он должен добавиться в список слева</li>
                    <li>Нажмите "сохранить и продолжить"</li>
                    <li>Поставьте галочку у "Растянуть по ширине"</li>
                    <li>Скопируйте ссылку из поля "Ссылка на карту"</li>
                    <li>На панели администратора вставьте ссылку в поле "Ссылка на карту"</li>
                </ul>
            </form>
            <form>
                <h3>Желаете просмотреть существующие объекты?</h3>
                <hr>
                <a href="table.php" style="display:block;text-align:center">Перейти</a>
            </form>
        </section>
    </main><br>
    <div class="secret">Администрирование доступно только с компьютера!</div>
    <footer><a href="https://d0lmany.netlify.app">dev:d0lmany</a><a href="index.html">На главную</a></footer>
</body>

</html>