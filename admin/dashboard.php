<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Get statistics
$stmt = $pdo->query("SELECT COUNT(*) FROM products");
$totalProducts = $stmt->fetchColumn();

$stmtCats = $pdo->query("SELECT COUNT(DISTINCT category) FROM products");
$totalCategories = $stmtCats->fetchColumn();

// Get recent products
$stmtRecent = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 5");
$recentProducts = $stmtRecent->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Harihar Ratna Emporium</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>

<header class="admin-header">
    <div class="admin-nav-inner">
        <a href="dashboard.php" class="admin-logo">
            <span>ॐ</span> Harihar Ratna Admin
        </a>
        <nav class="admin-links">
            <a href="dashboard.php" class="admin-link active">Dashboard</a>
            <a href="manage_products.php" class="admin-link">Manage Products</a>
            <a href="../" target="_blank" class="admin-link">View Live Website</a>
            <a href="dashboard.php?logout=1" class="admin-link logout">Logout</a>
        </nav>
    </div>
</header>

<div class="admin-wrap">
    <div class="admin-card">
        <h2 class="admin-title">Welcome to Harihar Ratna Portal</h2>
        <p style="color: var(--admin-muted); margin-bottom: 2rem;">Manage certified Rudrakshas, Vedic gemstones, Japa malas, and holy temple products directly from Haridwar.</p>

        <div class="stats-grid-admin">
            <div class="stat-box-admin">
                <div class="stat-num-admin"><?php echo $totalProducts; ?></div>
                <div class="stat-lbl-admin">Total Live Products</div>
            </div>
            <div class="stat-box-admin">
                <div class="stat-num-admin"><?php echo $totalCategories; ?></div>
                <div class="stat-lbl-admin">Active Categories</div>
            </div>
            <div class="stat-box-admin">
                <div class="stat-num-admin">100+</div>
                <div class="stat-lbl-admin">Years Haridwar Legacy</div>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="manage_products.php?action=add" class="btn-admin btn-admin-gold">
                <span>Add New Product</span>
            </a>
            <a href="manage_products.php" class="btn-admin btn-admin-edit">
                <span>View Full Catalog</span>
            </a>
        </div>
    </div>

    <div class="admin-card">
        <h3 style="font-family: 'Cinzel', serif; font-size: 1.25rem; color: var(--admin-gold); margin-bottom: 1.25rem;">
            Recently Added Products
        </h3>
        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Planet</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentProducts as $p): ?>
                    <tr>
                        <td>
                            <img src="../uploads/<?php echo htmlspecialchars($p['image_url'] ?: 'cat_rudraksha.jpg'); ?>" class="table-img" alt="thumb">
                        </td>
                        <td><strong><?php echo htmlspecialchars($p['name']); ?></strong></td>
                        <td><span style="color: var(--admin-gold);"><?php echo htmlspecialchars($p['category']); ?></span></td>
                        <td>₹<?php echo number_format($p['price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($p['ruling_planet'] ?: '-'); ?></td>
                        <td>
                            <a href="manage_products.php?edit=<?php echo $p['id']; ?>" class="btn-admin btn-admin-edit">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
