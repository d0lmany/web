-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.0
-- Время создания: Окт 31 2024 г., 12:10
-- Версия сервера: 8.0.35
-- Версия PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dawn`
--

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE `objects` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `authors` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `yof` year NOT NULL,
  `info` mediumtext NOT NULL,
  `facts` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `map` text NOT NULL,
  `pics` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `objects`
--

INSERT INTO `objects` (`id`, `name`, `authors`, `city`, `yof`, `info`, `facts`, `map`, `pics`) VALUES
(1, 'Сказ об Урале', 'Е. В. Александров, В. С. Зайков', 'Челябинск, Привокзальная площадь', '1967', '<h3>Композиция</h3>\r\n<p>Идея создания монумента «Сказ об Урале» возникла у Виталия Зайкова ещё в те времена, когда он жил в Петербурге, благодаря сказам Павла Бажова. Урал звал художника не только как отчий дом, но и как край, с которым у него был связан один из самых серьёзных творческих замыслов. Мысль о «Сказе» постоянно преследовала художника. Поиск образа и работа над ним заняли долгих шесть лет.\r\n\r\nХудожник объездил весь Урал, исходил пешком его бескрайние просторы в поисках своего «клада». Виталий Зайков понял, что главная идея должна лежать всё же не в природной экзотике, а в значимости Урала для страны, в силе духа и трудолюбии уральцев.\r\n\r\nВ «Сказе об Урале» много идёт от поэтической сказочности Бажова, от былинного народного фольклора: великан, носящий огромный пояс с глубокими карманами, в которых он прячет все свои сокровища. Само слово «Урал» переводится с башкирского как пояс. И, несмотря, на былинно-эпическую трактовку образа, отчётливо видно, что скульптор показывает Урал не прошлого, а сегодняшний, Урал индустриальный. Этот аллегорический образ уральского богатыря символизирует могущество трудового Урала, который Александр Твардовский называет: «Урал — опорный край державы, её добытчик и кузнец» (надпись присутствует на фасаде постамента).\r\n\r\nОбщая высота монумента 12 метров. Год создания 1967. Открыт 6 ноября 1967 года.\r\n\r\nВырубленный из гранита «Сказ об Урале» — воплощение физической силы и творческой мощи уральских мастеров. На постаменте, засыпанном каменными глыбами, стоит вырубленный из гранита богатырь. В его руках молот, что говорит о рабочих заслугах Южного Урала и его жителей.\r\n\r\nСкульптурная композиция «Сказ об Урале» экспонируется в Москве на республиканской художественной выставке «Советская Россия», а затем на Всесоюзной юбилейной художественной выставке.\r\n\r\nВ 2007 году по настоятельной просьбе Заслуженного архитектора России Евгения Александрова (1917–2007) была проведена реконструкция постамента у монумента.</p>\r\n<h3>Дед Мороз</h3>\r\n<p>В 2009 году по задумке челябинской школьницы Даны Гирко «Сказ об Урале» был наряжен в 7-метровый новогодний кафтан Деда Мороза. Организатором акции выступили представители бизнес-сообщества Челябинска при одобрении со стороны администрации города Челябинска. В 2010 году акцию повторили, на этот раз кафтан стал самым большим кафтаном Деда Мороза и попал в книгу рекордов Гиннеса. Размеры костюма если перевести на человеческие мерки составляют: размер шубы — 300, размер головного убора — 280, длина кафтана — 8 метров. Для такого пошива использовалось 30 тысяч метров нитей, 100 метров красного бархата, 50 метров искусственного меха и 150 метров синтепона. На время акции памятнику прикрепили 74-метровую бороду (74 символизирует код региона).\r\n\r\nДанная затея встретила неоднозначную реакцию жителей. Одна часть жителей нашла затею забавной, яркий наряд скрывал суровую каменную скульптуру и придавал праздничный вид привокзальной площади. Другая часть жителей города была возмущена грубым нарушением композиции и облика памятника, искажением его исторического значения и называли акцию вандализмом.\r\n\r\n«Сказ об Урале» является духовным символом Урала. В народе существует примета: стоит приехать к богатырю-кузнецу, коснуться его или поцеловать, при этом загадав сокровенное желание, и сама сила могучего Урала воплотит его в жизнь.</p>', '<li>В 2023 году Центральный банк России представил обновлённые банкноты достоинством 1000 и 5000 рублей. Банкнота в 5000 рублей посвящена Екатеринбургу и Уральскому федеральному округу, основное изображение оборотной стороны банкноты — памятник «Сказ об Урале»</li>', 'https://yandex.ru/map-widget/v1/?um=constructor%3A53de1ef60a6ae832a0c1c56e8b0680a77db56d663d0ac900091a9197a45dc2ec&amp;source=constructor', '{\"authors\": [\"dawn.ru\", \"mbdoy312.blogspot.com\", \"dzen.ru\", \"dzen.ru\", \"www.youtube.com, Яна Славкова\"]}'),
(2, 'Памятник Курчатову', 'В. А. Авакян, Б. В. Петров, В. Л. Глазырин, И. В. Талалай, инженер В. Наумов', 'Челябинск, п-е пр. Ленина и у. Лесопарковой', '1986', '<h3>Композиция</h3><p>Памятник представляет собой сложную архитектурно-скульптурную композицию, в состав которой входят два пилона и находящаяся между ними статуя Курчатова на постаменте. Полусферы на пилонах символизируют расщепленный атом. Высота пилонов составляет 27 метров. Высота статуи — 6,4 метра. Общая высота памятника (вместе с постаментом) — 11 метров.</p><h3>История</h3><p>После установки памятника обе части атомного ядра были оснащены специальными прожекторами, которые из-за технических проблем проработали в течение лишь нескольких недель. Кроме того в 1988 году в результате действий вандалов была повреждена электрическая система памятника и его освещение перестало работать.</p><p>В 2006 году, по предложению администрации Челябинска, к 270-летию города был разработан новый проект внешней подсветки атома. В ходе реализации данного проекта на прилегающей территории были осуществлены замена опор освещения, установка новых прожекторов, освещающих памятник, ремонт светильников внутри ядра атома, монтаж светодиодов и установка нового высокотехнологичного оборудование по динамическому эффекту подсветки атома. После реализации проекта по реконструкции памятника его освещение прожекторами осуществляется ежедневно в темное время суток. В праздничные дни при помощи дистанционного управления включается подсветка самого атома. Проект восстановления памятника был реализован предприятием «Челябгорсвет», а средства на его финансирование выделил губернатор Челябинской области Пётр Сумин.', '<li>Поскольку памятник расположен рядом с территорией студенческого городка ЮУрГУ, он является излюбленным местом встречи студентов, молодёжи и влюблённых, любителей футбола, экстремальных видов спорта, а также скейтеров</li>', 'https://yandex.ru/map-widget/v1/?um=constructor%3A53de1ef60a6ae832a0c1c56e8b0680a77db56d663d0ac900091a9197a45dc2ec&amp;source=constructor', '{\"authors\": [\"astra74.ru\", \"dzen.ru\", \"mediazavod.ru\", \"rutube.ru, ЮУрГУ-ТВ\", \"ru.wikipedia.org\"]}');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `objects`
--
ALTER TABLE `objects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
