<?php
require_once 'includes/db.php';
header('Content-Type: text/plain');
echo "PDO Connection: " . ($pdo ? "SUCCESS\n" : "FAILED\n");
if ($pdo) {
    echo "Driver: " . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . "\n";
    $count = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    echo "Total Products: " . $count . "\n";
    $cats = $pdo->query("SELECT DISTINCT category FROM products")->fetchAll(PDO::FETCH_COLUMN);
    echo "Categories: " . implode(', ', $cats) . "\n";
}

