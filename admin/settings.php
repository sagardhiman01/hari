<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}

$message = '';
$error = '';

// Fetch all settings
$settings = [];
try {
    $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
} catch (Exception $e) {
    $error = "Settings table error: " . $e->getMessage();
}

// Handle Logo Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_logo') {
    if (isset($_FILES['logo_file']) && $_FILES['logo_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['logo_file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['png', 'jpg', 'jpeg', 'webp', 'svg'];
        
        if (in_array($ext, $allowed)) {
            $filename = 'logo_' . time() . '.' . $ext;
            $targetDir = '../uploads/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $targetPath = $targetDir . $filename;
            
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $dbVal = 'uploads/' . $filename;
                
                // Remove old logo if custom
                if (!empty($settings['site_logo']) && file_exists('../' . $settings['site_logo'])) {
                    @unlink('../' . $settings['site_logo']);
                }
                
                $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES ('site_logo', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
                try {
                    $stmt->execute([$dbVal, $dbVal]);
                } catch (Exception $e) {
                    // Fallback for SQLite
                    $stmtSqlite = $pdo->prepare("INSERT OR REPLACE INTO site_settings (setting_key, setting_value) VALUES ('site_logo', ?)");
                    $stmtSqlite->execute([$dbVal]);
                }
                
                $settings['site_logo'] = $dbVal;
                $message = "Logo uploaded successfully! It is now active across the entire website.";
            } else {
                $error = "Failed to save the uploaded logo file. Check directory permissions.";
            }
        } else {
            $error = "Invalid file type. Please upload PNG, JPG, WEBP, or SVG.";
        }
    } else {
        $error = "Please select a valid image file to upload.";
    }
}

// Handle Remove Logo
if (isset($_GET['remove_logo'])) {
    if (!empty($settings['site_logo']) && file_exists('../' . $settings['site_logo'])) {
        @unlink('../' . $settings['site_logo']);
    }
    
    try {
        $stmt = $pdo->prepare("UPDATE site_settings SET setting_value = '' WHERE setting_key = 'site_logo'");
        $stmt->execute();
    } catch (Exception $e) {
        $stmt = $pdo->prepare("DELETE FROM site_settings WHERE setting_key = 'site_logo'");
        $stmt->execute();
    }
    
    $settings['site_logo'] = '';
    $message = "Custom logo removed. The website will now use the sacred ॐ emblem.";
}

// Handle General Store Info Save
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_info') {
    $keys = [
        'store_phone' => trim($_POST['store_phone'] ?? '9927115354'),
        'store_phone_alt' => trim($_POST['store_phone_alt'] ?? '9927141732'),
        'store_address' => trim($_POST['store_address'] ?? 'Moti Bazar, opp Chat Gali, Haridwar (Uttarakhand)'),
        'youtube_url' => trim($_POST['youtube_url'] ?? 'https://youtube.com/@hariharjyotishhelp'),
        'purity_guarantee' => trim($_POST['purity_guarantee'] ?? '100% Purity Guarantee | ₹50,000 Reward if Proven Inauthentic')
    ];
    
    foreach ($keys as $k => $v) {
        try {
            $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
            $stmt->execute([$k, $v, $v]);
        } catch (Exception $e) {
            $stmt = $pdo->prepare("INSERT OR REPLACE INTO site_settings (setting_key, setting_value) VALUES (?, ?)");
            $stmt->execute([$k, $v]);
        }
        $settings[$k] = $v;
    }
    $message = "Store settings and contact details updated successfully!";
}

$currentLogo = !empty($settings['site_logo']) ? '../' . $settings['site_logo'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Logo & Settings — Harihar Ratna Emporium Admin</title>
    <link rel="stylesheet" href="admin_style.css">
    <style>
        .logo-preview-box {
            display: flex;
            align-items: center;
            gap: 2rem;
            background: rgba(25, 20, 15, 0.6);
            border: 1px solid rgba(197, 160, 89, 0.25);
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }
        .preview-circle-wrap {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 2px solid #d4af37;
            background: #110d0a;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.35);
            flex-shrink: 0;
        }
        .preview-circle-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .preview-om {
            font-size: 2.5rem;
            color: #d4af37;
            line-height: 1;
        }
        .logo-meta {
            flex-grow: 1;
        }
        .logo-meta h4 {
            font-family: 'Cinzel', serif;
            color: #ffd700;
            margin-bottom: 0.35rem;
            font-size: 1.1rem;
        }
        .logo-meta p {
            color: #a89f91;
            font-size: 0.9rem;
            margin-bottom: 0.85rem;
        }
        .file-upload-drop {
            border: 2px dashed rgba(197, 160, 89, 0.4);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background: rgba(20, 16, 12, 0.5);
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 1.25rem;
        }
        .file-upload-drop:hover {
            border-color: #d4af37;
            background: rgba(30, 24, 18, 0.7);
        }
        .file-upload-drop input[type="file"] {
            display: none;
        }
        .upload-icon {
            font-size: 2.2rem;
            color: #d4af37;
            display: block;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

<header class="admin-header">
    <div class="admin-nav-inner">
        <a href="dashboard.php" class="admin-logo">
            <?php if ($currentLogo && file_exists($currentLogo)): ?>
                <img src="<?php echo htmlspecialchars($currentLogo); ?>" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; vertical-align: middle; margin-right: 8px; border: 1px solid #d4af37;">
            <?php else: ?>
                <span>ॐ</span>
            <?php endif; ?>
            Harihar Ratna Admin
        </a>
        <nav class="admin-links">
            <a href="dashboard.php" class="admin-link">Dashboard</a>
            <a href="manage_products.php" class="admin-link">Manage Products</a>
            <a href="settings.php" class="admin-link active">Logo & Settings</a>
            <a href="../" target="_blank" class="admin-link">View Live Website</a>
            <a href="dashboard.php?logout=1" class="admin-link logout">Logout</a>
        </nav>
    </div>
</header>

<div class="admin-wrap">
    <?php if ($message): ?>
        <div class="admin-alert success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="admin-alert error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="admin-card">
        <h2 class="admin-title">Store Logo Management</h2>
        <p style="color: var(--admin-muted); margin-bottom: 1.5rem;">
            Upload your shop's official logo. It will automatically fit into the circular emblem shape and update in the header, footer, and admin panel across the whole site.
        </p>

        <div class="logo-preview-box">
            <div class="preview-circle-wrap">
                <?php if ($currentLogo && file_exists($currentLogo)): ?>
                    <img id="previewImg" src="<?php echo htmlspecialchars($currentLogo); ?>" alt="Store Logo Preview">
                <?php else: ?>
                    <div class="preview-om" id="previewOm">ॐ</div>
                    <img id="previewImg" src="" alt="Store Logo Preview" style="display: none;">
                <?php endif; ?>
            </div>
            <div class="logo-meta">
                <h4><?php echo $currentLogo ? 'Custom Logo Active' : 'Default Vedic Emblem Active'; ?></h4>
                <p>
                    <?php if ($currentLogo): ?>
                        Displaying your custom emblem. The website automatically frames and illuminates this logo.
                    <?php else: ?>
                        No custom logo uploaded yet. The sacred golden ॐ emblem is being displayed.
                    <?php endif; ?>
                </p>
                <?php if ($currentLogo): ?>
                    <a href="settings.php?remove_logo=1" class="btn-admin btn-admin-delete" onclick="return confirm('Reset to default sacred ॐ symbol?');">
                        Remove Custom Logo
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <form method="POST" enctype="multipart/form-data" action="settings.php">
            <input type="hidden" name="action" value="save_logo">
            <label class="file-upload-drop" for="logoInput">
                <span class="upload-icon">⚡</span>
                <strong style="color: #ffd700; font-size: 1.05rem; display: block;">Click to choose or drop logo image here</strong>
                <span style="color: #a89f91; font-size: 0.85rem;">Supports PNG, JPG, JPEG, WEBP, or SVG (Recommended: Square 500x500 px)</span>
                <input type="file" name="logo_file" id="logoInput" accept="image/*" onchange="previewSelectedLogo(this)">
            </label>

            <button type="submit" class="btn-admin btn-admin-gold" style="width: 100%; justify-content: center; padding: 0.85rem;">
                Upload & Apply Logo Everywhere
            </button>
        </form>
    </div>

    <div class="admin-card">
        <h2 class="admin-title">Store Information & Contact Details</h2>
        <p style="color: var(--admin-muted); margin-bottom: 1.5rem;">
            Update address, consultation numbers, and guarantees displayed on the website and footer.
        </p>

        <form method="POST" action="settings.php">
            <input type="hidden" name="action" value="save_info">
            <div class="form-grid">
                <div class="form-group">
                    <label>Primary WhatsApp / Call Number (Pt. Akash Bharadwaj)</label>
                    <input type="text" name="store_phone" class="form-input" value="<?php echo htmlspecialchars($settings['store_phone'] ?? '9927115354'); ?>" required>
                </div>
                <div class="form-group">
                    <label>Secondary Phone Number (Gaurav Bharadwaj)</label>
                    <input type="text" name="store_phone_alt" class="form-input" value="<?php echo htmlspecialchars($settings['store_phone_alt'] ?? '9927141732'); ?>" required>
                </div>
                <div class="form-group full-width">
                    <label>Physical Store Address (Haridwar)</label>
                    <input type="text" name="store_address" class="form-input" value="<?php echo htmlspecialchars($settings['store_address'] ?? 'Moti Bazar, opp Chat Gali, Haridwar (Uttarakhand) 249401'); ?>" required>
                </div>
                <div class="form-group full-width">
                    <label>YouTube Channel URL</label>
                    <input type="text" name="youtube_url" class="form-input" value="<?php echo htmlspecialchars($settings['youtube_url'] ?? 'https://youtube.com/@hariharjyotishhelp'); ?>" required>
                </div>
                <div class="form-group full-width">
                    <label>Purity Guarantee Notice</label>
                    <input type="text" name="purity_guarantee" class="form-input" value="<?php echo htmlspecialchars($settings['purity_guarantee'] ?? '100% Purity Guarantee | ₹50,000 Reward if Proven Inauthentic'); ?>" required>
                </div>
            </div>
            <button type="submit" class="btn-admin btn-admin-gold" style="margin-top: 1.5rem;">
                Save Store Information
            </button>
        </form>
    </div>
</div>

<script>
function previewSelectedLogo(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewImg = document.getElementById('previewImg');
            const previewOm = document.getElementById('previewOm');
            if (previewImg) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
            }
            if (previewOm) {
                previewOm.style.display = 'none';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>
