<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>*{outline:none}</style>
    <title>Добавление позиций</title>
</head>
<body class="text-slate-50 bg-slate-900 accent-pink-500">
    <? include "connect.php"; sethead() ?>
    <main class="m-10 flex justify-center">
        <section class="w-1/3 m-1">
            <h3 class="text-lg text-center">Добавить товар</h3>
            <form action="insert.php?w=1" method="post" class="p-2 border border-slate-150 bg-indigo-950" enctype="multipart/form-data">
                <section class="flex justify-center hidden mb-1" id="photo"></section>
                <label class="flex justify-between mb-1">Фото товара:<input id="file" type="file" name="photo" accept="image/png" class="bg-slate-900 border border-slate-150 w-1/2" required></label>
                <label class="flex justify-between mb-1">Имя товара:<input type="text" name="name" class="bg-slate-900 border border-slate-150 w-1/2" required></label>
                <label class="flex justify-between mb-1">Категория:<select name="category" class="bg-slate-900 border border-slate-150 w-1/2" required><? echo show_categories() ?></select></label>
                <label class="flex justify-between mb-1">Цена:<input type="number" name="price" class="bg-slate-900 border border-slate-150 w-1/2" required></label>
                <label class="flex justify-between mb-1">Количество:<input type="number" name="quantity" class="bg-slate-900 border border-slate-150 w-1/2" required></label>
                <label class="flex justify-between mb-1">Годен до:<input type="date" name="ex_date" class="bg-slate-900 border border-slate-150 w-1/2" required></label>
                <input type="submit" value="Добавить" class="bg-violet-950 p-2 text-center hover:bg-violet-900 transition duration-150 w-full">
            </form>
        </section>
        <section class="w-1/3 m-1">
            <h3 class="text-lg text-center">Добавить категорию</h3>
            <form action="insert.php?w=2" method="post" class="p-2 border border-slate-150 bg-indigo-950">
                <label class="flex justify-between mb-1">Имя категории:<input type="text" name="category" class="bg-slate-900 border border-slate-150 w-1/2"></label>
                <input type="submit" value="Добавить" class="bg-violet-950 p-2 text-center hover:bg-violet-900 transition duration-150 w-full">
            </form>
        </section>
    </main>
    <?setfooter()?>
    <script>
        let a = document.getElementById("file")
        a.addEventListener("change",()=>{
            if(!a.files[0].name.includes(".png")){
                alert("Некорректный формат файла. Пожалуйста, загрузите png")
                a.value = null
            } else{
                let c = document.getElementById("photo"), d = document.createElement("img")
                d.src = URL.createObjectURL(a.files[0]); c.appendChild(d)
                c.classList.remove("hidden")
            }
        })
    </script>
</body>
</html>