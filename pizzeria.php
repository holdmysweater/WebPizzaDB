<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/index.php');

$signUpErrors = UserActions::signUp();

require_once($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php');
?>

    <main class="wrapper container-fluid text-center mt-4 mb-5">
        <form class="mb-5" action="pizzeria.php" method="get">
            <label class="form-label fs-5 fw-bold">Фильтрация результата поиска</label>
            <div class="mb-3">
                <label>По цене:</label>
                <div class="d-flex">
                    <input type="number" name="costFrom" placeholder="Цена от" class="form-control me-2"
                           value="<?php echo (isset($_GET['costFrom']) && htmlspecialchars($_GET['costFrom']) !== '') ? (int)$_GET['costFrom'] : ''; ?>">
                    <input type="number" name="costTo" placeholder="Цена до" class="form-control ms-2"
                           value="<?php echo (isset($_GET['costTo']) && htmlspecialchars($_GET['costFrom']) !== '') ? (int)$_GET['costTo'] : ''; ?>">
                </div>
            </div>
            <div class="mb-3">
                <label>Фильтрация по категории:</label>
                <select name="category" class="form-control">
                    <option value=""
                        <?php echo (!(isset($_GET['category'])) || $_GET['category'] === '') ? 'selected' : ''; ?>>
                        Все категории
                    </option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo (int)$cat['id']; ?>"
                                <?php echo (isset($_GET['category']) && (int)$_GET['category'] === $cat['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Фильтрация по названию:</label>
                <input type="text" name="name" placeholder="Введите название товара" class="form-control"
                       value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
            </div>
            <div class="mb-4">
                <label>Фильтрация по рецептуре:</label>
                <textarea class="form-control" placeholder="Введите рецептуру товара" name="recipe"><?php echo isset($_GET['recipe']) ? htmlspecialchars($_GET['recipe']) : ''; ?></textarea>
            </div>
            <input type="submit" value="Применить фильтр" class="btn btn-primary me-2">
            <input type="submit" name="clearFilter" value="Очистить фильтр" class="btn btn-danger">
        </form>
        <table class="table table-bordered">
            <thead>
            <tr class="table-light">
                <th scope="col" class="fw-medium">Изображение</th>
                <th scope="col" class="fw-medium">Название</th>
                <th scope="col" class="fw-medium">Категория</th>
                <th scope="col" class="fw-medium">Рецептура</th>
                <th scope="col" class="fw-medium">Стоимость</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($foodItems)): ?>
                <?php foreach ($foodItems as $row): ?>
                    <tr>
                        <th scope="row">
                            <img src="assets/images/menu/<?php echo htmlspecialchars($row['img_path']); ?>" alt="image" style="max-width: 200px;">
                        </th>
                        <td class="fw-light"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td class="fw-light"><?php echo htmlspecialchars($row['category_name']); ?></td>
                        <td class="fw-light"><?php echo htmlspecialchars($row['recipe']); ?></td>
                        <td class="fw-light"><?php echo htmlspecialchars($row['cost']); ?> ₽</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Нет данных</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </main>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php');
?>