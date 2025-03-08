-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 07:19 PM
-- Server version: 8.0.36
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Пиццы'),
(2, 'Комбо'),
(3, 'Закуски'),
(4, 'Коктейли'),
(5, 'Кофе');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int UNSIGNED NOT NULL,
  `img_path` varchar(45) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'no_img.png',
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `id_category` int UNSIGNED NOT NULL,
  `recipe` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cost` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `img_path`, `name`, `id_category`, `recipe`, `cost`) VALUES
(1, 'diablo.png', 'Диабло', 1, 'Острые колбаски чоризо, острый перец халапеньо, соус барбекю, митболы из говядины, томаты, сладкий перец, красный лук, моцарелла, фирменный томатный соус', 859),
(2, 'margarita.png', 'Маргарита', 1, 'Увеличенная порция моцареллы, томаты, итальянские травы, фирменный томатный соус', 669),
(3, 'chicken_box.png', 'Чикен бокс', 2, 'Картошка без курицы, как курица без картошки — лучше вместе. Выбирайте куриные наггетсы, кусочки или крылья барбекю и заказывайте сразу в комбо с пряной картошечкой и соусом', 260),
(4, 'two_branded_snacks.png', '2 фирменные закуски', 2, NULL, 369),
(5, 'dodo_box.png', 'Додо Бокс', 2, 'Набор юного космонавта, который легко настроить по вкусу ребенка: две закуски и напиток на выбор. В каждом комбо игрушка, а в нашем приложении игра-компаньон', 429),
(6, 'omelette_with_ham_and_mushrooms.png', 'Омлет с ветчиной и грибами', 3, 'Горячий сытный омлет с поджаристой корочкой, ветчина, шампиньоны и моцарелла', 179),
(7, 'danwich_with_ham_and_cheese.png', 'Дэнвич ветчина и сыр', 3, 'Поджаристая чиабатта и знакомое сочетание ветчины, цыпленка, моцареллы со свежими томатами, соусом ранч и чесноком', 259),
(8, 'caesar_salad.png', 'Салат Цезарь', 3, 'Цыпленок, свежие листья салата айсберг, томаты черри, сыры чеддер и пармезан, соус цезарь, пшеничные гренки, итальянские травы', 250),
(9, 'classic_milkshake.png', 'Классический молочный коктейль', 4, 'Это классика: молоко, мороженое и ничего лишнего', 185),
(10, 'strawberry_milkshake.png', 'Клубничный молочный коктейль', 4, 'Лето всегда рядом: сироп из спелой клубники, молоко и мороженое', 220),
(11, 'chocolate_milkshake.png', 'Шоколадный молочный коктейль', 4, 'Шоколадный милкшейк со сливочным мороженым и фирменным какао', 209),
(12, 'coffee_beans_branded_mix.png', 'Кофе в зернах - фирменная смесь', 5, 'Фирменная смесь кофейных зерен из 100% арабики. Кофейные зерна из Бразилии и Эфиопии обжаренные по специальному рецепту Додо. Идеально подходят для заваривания в домашних условиях', 935),
(13, 'coconut_latte.png', 'Кофе Кокосовый латте', 5, 'Горячий латте с кокосовым сиропом', 169),
(14, 'coffee_americano.png', 'Кофе Американо', 5, 'Горячий кофе для ценителей чистого вкуса', 99),
(15, 'pasta_pesto.png', 'Паста Песто', 3, 'Паста из печи с соусом песто, цыпленком, томатами, моцареллой и фирменным томатным соусом', 349),
(16, 'cheese_starter.png', 'Сырный Стартер', 3, 'Горячая закуска с очень сырной начинкой. Моцарелла, пармезан, чеддер и соус ранч в тонкой пшеничной лепешке', 189),
(17, 'unexplored_combo.png', 'Неизведанное комбо', 2, 'Открывайте новые вкусы и горизонты! В комбо — две оригинальные пиццы, два напитка и шанс выиграть путешествие', 1285),
(18, 'arriva.png', 'Аррива!', 1, 'Цыпленок, острые колбаски чоризо, соус бургер, сладкий перец, красный лук, томаты, моцарелла, соус ранч, чеснок', 789),
(19, 'four_seasons.png', 'Четыре сезона', 1, 'Увеличенная порция моцареллы, ветчина, пикантная пепперони, кубики брынзы, томаты, шампиньоны, итальянские травы, фирменный томатный соус', 669),
(20, 'carbonara.png', 'Карбонара', 1, 'Бекон, сыры чеддер и пармезан, моцарелла, томаты, красный лук, чеснок, фирменный соус альфредо, итальянские травы', 859);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_1` (`id_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foreign_key_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
