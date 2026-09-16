<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}

$message = '';
$error = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    $stmt = $pdo->prepare("SELECT image_url FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    
    // Don't unlink base category stock images if shared, but unlink unique uploads
    if ($product && !empty($product['image_url'])) {
        $imgPath = '../uploads/' . $product['image_url'];
        if (file_exists($imgPath) && strpos($product['image_url'], 'cat_') === false && strpos($product['image_url'], 'hero_') === false) {
            @unlink($imgPath);
        }
    }
    
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    if ($stmt->execute([$id])) {
        $message = "Product deleted successfully from catalog.";
    }
}

// Handle Add / Edit Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = !empty($_POST['id']) ? intval($_POST['id']) : null;
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? 'Rudraksha');
    $price = floatval($_POST['price'] ?? 0);
    $original_price = !empty($_POST['original_price']) ? floatval($_POST['original_price']) : null;
    $ruling_planet = trim($_POST['ruling_planet'] ?? '');
    $ruling_deity = trim($_POST['ruling_deity'] ?? '');
    $benefits = trim($_POST['benefits'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $stock_status = trim($_POST['stock_status'] ?? 'In Stock');
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    
    $image_url = $_POST['existing_image'] ?? 'cat_rudraksha.jpg';
    
    // Image file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        
        if (in_array($ext, $allowed)) {
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', pathinfo($_FILES['image']['name'], PATHINFO_FILENAME)) . '.' . $ext;
            $upload_dir = '../uploads/';
            
            if (move_uploaded_file($tmp_name, $upload_dir . $filename)) {
                $image_url = $filename;
            } else {
                $error = "Failed to upload image.";
            }
        } else {
            $error = "Invalid image file format. Allowed: JPG, PNG, WEBP.";
        }
    }

    if (empty($error)) {
        if ($id) {
            // Update
            $stmt = $pdo->prepare("UPDATE products SET 
                name = ?, category = ?, price = ?, original_price = ?, image_url = ?, 
                ruling_planet = ?, ruling_deity = ?, benefits = ?, description = ?, 
                stock_status = ?, is_featured = ? 
                WHERE id = ?");
            $stmt->execute([
                $name, $category, $price, $original_price, $image_url, 
                $ruling_planet, $ruling_deity, $benefits, $description, 
                $stock_status, $is_featured, $id
            ]);
            $message = "Product #{$id} updated successfully!";
        } else {
            // Insert
            $stmt = $pdo->prepare("INSERT INTO products (
                name, category, price, original_price, image_url, 
                ruling_planet, ruling_deity, benefits, description, 
                stock_status, is_featured
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $name, $category, $price, $original_price, $image_url, 
                $ruling_planet, $ruling_deity, $benefits, $description, 
                $stock_status, $is_featured
            ]);
            $message = "New sacred product added successfully to catalog!";
        }
    }
}

// Fetch all products
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();

// Edit product lookup
$editProduct = null;
if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$editId]);
    $editProduct = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Catalog - Harihar Ratna Emporium Admin</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>

<header class="admin-header">
    <div class="admin-nav-inner">
        <a href="dashboard.php" class="admin-logo">
            <span>ॐ</span> Harihar Ratna Admin
        </a>
        <nav class="admin-links">
            <a href="dashboard.php" class="admin-link">Dashboard</a>
            <a href="manage_products.php" class="admin-link active">Manage Products</a>
            <a href="settings.php" class="admin-link">Logo & Settings</a>
            <a href="../" target="_blank" class="admin-link">View Live Website</a>
            <a href="dashboard.php?logout=1" class="admin-link logout">Logout</a>
        </nav>
    </div>
</header>

<div class="admin-wrap">

    <?php if ($message): ?>
        <div class="alert-admin success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert-admin error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- Add / Edit Form Card -->
    <div class="admin-card">
        <h3 class="admin-title">
            <?php echo $editProduct ? 'Edit Product: ' . htmlspecialchars($editProduct['name']) : 'Add Sacred Product'; ?>
        </h3>

        <form method="POST" action="manage_products.php" enctype="multipart/form-data">
            <?php if ($editProduct): ?>
                <input type="hidden" name="id" value="<?php echo $editProduct['id']; ?>">
                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editProduct['image_url']); ?>">
            <?php endif; ?>

            <div class="form-grid">
                <div class="form-group">
                    <label>Product Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. 1 Mukhi Nepali Rudraksha" required value="<?php echo $editProduct ? htmlspecialchars($editProduct['name']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Category *</label>
                    <select name="category" class="form-control" required>
                        <?php 
                        $cats = ['Rudraksha', 'Ratna (Gemstones)', 'Malas & Rosaries', 'Sacred Shankh', 'Siddh Yantras', 'Navratna Jewelry'];
                        foreach ($cats as $c): 
                            $sel = ($editProduct && $editProduct['category'] === $c) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $c; ?>" <?php echo $sel; ?>><?php echo $c; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Selling Price (₹) *</label>
                    <input type="number" step="0.01" name="price" class="form-control" placeholder="5100.00" required value="<?php echo $editProduct ? htmlspecialchars($editProduct['price']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Original / MRP Price (₹)</label>
                    <input type="number" step="0.01" name="original_price" class="form-control" placeholder="7500.00" value="<?php echo $editProduct ? htmlspecialchars($editProduct['original_price']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Ruling Planet</label>
                    <input type="text" name="ruling_planet" class="form-control" placeholder="e.g. Sun (Surya) / Jupiter" value="<?php echo $editProduct ? htmlspecialchars($editProduct['ruling_planet']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Ruling Deity</label>
                    <input type="text" name="ruling_deity" class="form-control" placeholder="e.g. Lord Shiva / Lord Vishnu" value="<?php echo $editProduct ? htmlspecialchars($editProduct['ruling_deity']) : ''; ?>">
                </div>

                <div class="form-group full">
                    <label>Vedic Astrological Benefits</label>
                    <input type="text" name="benefits" class="form-control" placeholder="e.g. Bestows supreme peace, health and removes all sins." value="<?php echo $editProduct ? htmlspecialchars($editProduct['benefits']) : ''; ?>">
                </div>

                <div class="form-group full">
                    <label>Product Detailed Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter complete details, energization process, purity certification details..."><?php echo $editProduct ? htmlspecialchars($editProduct['description']) : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <?php if ($editProduct && $editProduct['image_url']): ?>
                        <div style="margin-top: 8px; display: flex; align-items: center; gap: 10px;">
                            <img src="../uploads/<?php echo htmlspecialchars($editProduct['image_url']); ?>" style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px;" alt="Current">
                            <span style="font-size: 0.85rem; color: var(--admin-muted);"><?php echo htmlspecialchars($editProduct['image_url']); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Stock Status</label>
                    <select name="stock_status" class="form-control">
                        <option value="In Stock" <?php echo ($editProduct && $editProduct['stock_status'] === 'In Stock') ? 'selected' : ''; ?>>In Stock</option>
                        <option value="Out of Stock" <?php echo ($editProduct && $editProduct['stock_status'] === 'Out of Stock') ? 'selected' : ''; ?>>Out of Stock</option>
                    </select>
                </div>
            </div>

            <div style="margin-top: 1.5rem; display: flex; gap: 1rem; align-items: center;">
                <button type="submit" class="btn-admin btn-admin-gold">
                    <?php echo $editProduct ? 'Save Changes' : 'Add Product to Store'; ?>
                </button>
                <?php if ($editProduct): ?>
                    <a href="manage_products.php" class="btn-admin btn-admin-edit">Cancel Edit</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Product Catalog Table -->
    <div class="admin-card">
        <h3 class="admin-title">Live Product Inventory (<?php echo count($products); ?> Items)</h3>

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
                    <?php foreach ($products as $p): ?>
                    <tr>
                        <td>
                            <img src="../uploads/<?php echo htmlspecialchars($p['image_url'] ?: 'cat_rudraksha.jpg'); ?>" class="table-img" alt="product">
                        </td>
                        <td>
                            <strong><?php echo htmlspecialchars($p['name']); ?></strong>
                            <?php if (!empty($p['original_price'])): ?>
                                <div style="font-size: 0.78rem; color: var(--admin-muted);">MRP: ₹<?php echo number_format($p['original_price'], 2); ?></div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span style="color: var(--admin-gold);"><?php echo htmlspecialchars($p['category']); ?></span>
                        </td>
                        <td>
                            <strong>₹<?php echo number_format($p['price'], 2); ?></strong>
                        </td>
                        <td><?php echo htmlspecialchars($p['ruling_planet'] ?: '-'); ?></td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="manage_products.php?edit=<?php echo $p['id']; ?>" class="btn-admin btn-admin-edit">Edit</a>
                                <a href="manage_products.php?delete=<?php echo $p['id']; ?>" class="btn-admin btn-admin-delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                            </div>
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
