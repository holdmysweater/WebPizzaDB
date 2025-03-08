<?php
$host = 'localhost';
$dbname = 'pizzeria';
$username = 'root';
$password = 'idfkPl3aseHelp...!';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = 'SELECT img_path, foods.name, categories.name, recipe, cost FROM foods inner join categories on foods.id_category = categories.id';
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $foodItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

