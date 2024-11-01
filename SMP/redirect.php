<?php
if(isset($_GET["meth"])){
$method=$_GET["meth"];
switch($method){
    case 1:
        $msg="Удалено успешно!";
        break;
    case 2:
        $msg="Добавлено успешно!";
        break;
    case 3:
        $msg="Обновлено успешно!";
}
}
if(isset($_GET["error"])){
    $er=$_GET["error"];
    $msg="Произошла ошибка: $er";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редирект</title>
</head>
<body class="text-slate-50 bg-slate-900 accent-pink-500">
    <? include "connect.php"; sethead(); ?>
    <main class="m-5 flex justify-center">
        <section class="w-1/2 m-1">
            <h3 class="text-lg text-center">
                <? echo htmlspecialchars($msg) ?>
            </h3>
        </section>
    </main>
    <?setfooter()?>
</body>
</html>