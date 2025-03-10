<?php
$host = 'localhost';
$dbname = 'pizzeria';
$username = 'root';
$password = 'idfkPl3aseHelp...!';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $categoryQuery = 'SELECT id, name FROM categories';
    $categoryStmt = $conn->prepare($categoryQuery);
    $categoryStmt->execute();
    $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

    $whereClause = '';
    $params = [];

    if (!empty($_GET['name'])) {
        $whereClause .= ($whereClause ? ' AND' : ' WHERE') . ' name LIKE :name';
        $params['name'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['category'])) {
        $whereClause .= ($whereClause ? ' AND' : ' WHERE') . ' foods.id_category = :category';
        $params['category'] = (int) $_GET['category'];
    }

    if (!empty($_GET['recipe'])) {
        $whereClause .= ($whereClause ? ' AND' : ' WHERE') . ' recipe LIKE :recipe';
        $params['recipe'] = '%' . $_GET['recipe'] . '%';
    }

    if (!empty($_GET['costFrom'])) {
        $whereClause .= ($whereClause ? ' AND' : ' WHERE') . ' cost >= :costFrom';
        $params['costFrom'] = (int) $_GET['costFrom'];
    }

    if (!empty($_GET['costTo'])) {
        $whereClause .= ($whereClause ? ' AND' : ' WHERE') . ' cost <= :costTo';
        $params['costTo'] = (int) $_GET['costTo'];
    }

    if (isset($_GET['clearFilter'])) {
        $whereClause = '';
        $params = [];
    }

    $query = 'SELECT * FROM foods' . $whereClause;
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}