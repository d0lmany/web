<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обозреватель</title>
    <style>
        th:nth-child(3), tr td:nth-child(3){
            display: none;
        }
    </style>
</head>
<body class="text-slate-50 bg-slate-900 accent-pink-500">
    <? include "connect.php"; sethead();?>
    <main class="m-5 flex">
    <section class="w-3/4 m-1">
        <h3 class="text-lg text-center">Товары</h3>
        <table class="border-separate border border-slate-500 border-spacing-1 w-full">
    <tr class="bg-cyan-950 border border-slate-500">
        <th>Фото</th>
        <th>Товар</th>
        <th>ID Категории</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Годен до</th>
    </tr>
    <?
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : null;
    $orderDirection = isset($_GET['orderDirection']) ? $_GET['orderDirection'] : 'ASC';
    $search = isset($_GET['search']) ? $_GET['search'] : null;
    showtab("products", $category, $orderBy, $orderDirection, $search);
    ?>
    </table>
    </section>
    <section class="w-1/4 m-1">
        <h3 class="text-lg text-center">Категории</h3>
    <table class="border-separate border border-slate-500 border-spacing-1 w-full">
        <tr class="bg-cyan-950 border border-slate-500">
            <th>Категория</th>
        </tr>
        <? showtab("categories") ?>
    </table>
    <h3 class="text-lg text-center">Опции отображения товаров</h3>
    <form class="border p-1 border-slate-500 w-full">
    <label for="search" class="flex justify-between">Поиск по названию:<input type="text" id="search" name="search" value="<? echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="bg-slate-900 border border-slate-150 w-1/2 outline-none"></label>
    <label for="categoryFilter" class="flex justify-between">Категория:<select id="categoryFilter" name="category" class="bg-slate-900 border border-slate-150 w-1/2 outline-none">
        <option value="">Все</option>
        <? show_categories() ?>
    </select></label>
    <label for="orderBy" class="flex justify-between">Сортировать по:<select id="orderBy" name="orderBy" class="bg-slate-900 border border-slate-150 w-1/2 outline-none">
    <option value="id">ID</option>
    <option value="price">Цене</option>
    <option value="name">Имени</option>
    <option value="quantity">Количеству</option>
    <option value="ex_date">Сроку годности</option>
    </select></label>
    <label for="orderDirection" class="flex justify-between">Направление:<select id="orderDirection" name="orderDirection" class="bg-slate-900 border border-slate-150 w-1/2 outline-none">
        <option value="ASC">Возрастанию</option>
        <option value="DESC">Убыванию</option>
    </select></label>
    <input type="submit" value="Применить" class="bg-violet-950 text-center hover:bg-violet-900 transition duration-150 w-full">
</form>
    </section>
    </main>
    <?setfooter()?>
</body>
</html>