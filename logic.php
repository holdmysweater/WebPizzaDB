<?php
$host = 'localhost';
$dbname = 'pizzeria';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $categoryStmt = $conn->prepare('SELECT id, name FROM categories');
    $categoryStmt->execute();
    $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['clearFilter'])) {
        header('Location: pizzeria.php');
        exit();
    }

    $whereConditions = [];
    $params = [];

    $filters = [
        'name' => ['query' => 'foods.name LIKE :name', 'value' => fn($v) => "%$v%"],
        'category' => ['query' => 'foods.id_category = :category', 'value' => fn($v) => $v],
        'recipe' => ['query' => 'foods.recipe LIKE :recipe', 'value' => fn($v) => "%$v%"],
        'costFrom' => ['query' => 'foods.cost >= :costFrom', 'value' => fn($v) => (int)$v],
        'costTo' => ['query' => 'foods.cost <= :costTo', 'value' => fn($v) => (int)$v],
    ];

    foreach ($filters as $key => $filter) {
        if (!empty($_GET[$key])) {
            $whereConditions[] = $filter['query'];
            $params[":$key"] = $filter['value']($_GET[$key]);
        }
    }

    $query = 'SELECT img_path, foods.name, categories.name AS category_name, recipe, cost FROM foods INNER JOIN categories ON foods.id_category = categories.id'
        . (!empty($whereConditions) ? ' WHERE ' . implode(' AND ', $whereConditions) : '');

    $stmt = $conn->prepare($query);
    $stmt->execute($params);

    $foodItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}