<?php
$host = 'localhost';
$dbname = 'pizzeria';
$username = 'root';
$password = 'idfkPl3aseHelp...!';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $categoryStmt = $conn->prepare("SELECT id, name FROM categories");
    $categoryStmt->execute();
    $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['clearFilter'])) {
        header("Location: pizzeria.php");
        exit();
    }

    $whereConditions = [];
    $params = [];

    if (!empty($_GET['name'])) {
        $whereConditions[] = 'foods.name LIKE :name';
        $params[':name'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['category'])) {
        $whereConditions[] = 'foods.id_category = :category';
        $params[':category'] = $_GET['category'];
    }

    if (!empty($_GET['recipe'])) {
        $whereConditions[] = 'foods.recipe LIKE :recipe';
        $params[':recipe'] = '%' . $_GET['recipe'] . '%';
    }

    if (!empty($_GET['costFrom'])) {
        $whereConditions[] = 'foods.cost >= :costFrom';
        $params[':costFrom'] = (int) $_GET['costFrom'];
    }

    if (!empty($_GET['costTo'])) {
        $whereConditions[] = 'foods.cost <= :costTo';
        $params[':costTo'] = (int) $_GET['costTo'];
    }

    $whereClause = !empty($whereConditions) ? ' WHERE ' . implode(' AND ', $whereConditions) : '';
    $query = "SELECT img_path, foods.name, categories.name AS category_name, recipe, cost FROM foods 
              INNER JOIN categories ON foods.id_category = categories.id 
              $whereClause";

    $stmt = $conn->prepare($query);
    $stmt->execute($params);

    $foodItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}