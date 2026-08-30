<?php
/**
 * Harihar Ratna Emporium - Interactive Database Setup & Seeder
 * Supports both Browser Web GUI and CLI Execution
 */

$is_cli = (php_sapi_name() === 'cli');
$success = false;
$error_message = '';
$logs = [];

// Default suggestions
$default_host = 'localhost';
$default_name = 'harihar_ratna';
$default_user = 'root';
$default_pass = '';
$default_admin_user = 'admin';
$default_admin_pass = 'admin123';

// Load existing config if available
$config_file = __DIR__ . '/includes/db_config.php';
if (file_exists($config_file)) {
    @include $config_file;
    if (isset($host)) $default_host = $host;
    if (isset($dbname)) $default_name = $dbname;
    if (isset($username)) $default_user = $username;
    if (isset($password)) $default_pass = $password;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' || $is_cli) {
    $db_host = trim($_POST['db_host'] ?? $default_host);
    $db_name = trim($_POST['db_name'] ?? $default_name);
    $db_user = trim($_POST['db_user'] ?? $default_user);
    $db_pass = $_POST['db_pass'] ?? $default_pass;
    $admin_user = trim($_POST['admin_user'] ?? $default_admin_user);
    $admin_pass = trim($_POST['admin_pass'] ?? $default_admin_pass);

    try {
        // Step 1: Connect to MySQL
        $pdo = null;
        try {
            // First attempt: Connect directly with dbname (standard for shared hosts like Hostinger)
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $logs[] = "Connected to existing database: <code>" . htmlspecialchars($db_name) . "</code>";
        } catch (PDOException $e) {
            // Second attempt: Connect without dbname and create it (local XAMPP / Dedicated server)
            try {
                $pdo_root = new PDO("mysql:host=$db_host;charset=utf8mb4", $db_user, $db_pass);
                $pdo_root->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo_root->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                $pdo_root->exec("USE `$db_name`");
                $pdo = $pdo_root;
                $logs[] = "Created and switched to database: <code>" . htmlspecialchars($db_name) . "</code>";
            } catch (PDOException $e2) {
                throw new Exception("Could not connect to database '$db_name'. Please ensure you created this database in your Hostinger/cPanel MySQL menu. Error: " . $e->getMessage());
            }
        }

        // Step 2: Create users table
        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        $logs[] = "Table <code>users</code> created / verified.";

        // Step 3: Create products table
        $pdo->exec("DROP TABLE IF EXISTS products");
        $pdo->exec("CREATE TABLE products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            category VARCHAR(100) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            original_price DECIMAL(10, 2) DEFAULT NULL,
            image_url VARCHAR(255),
            ruling_planet VARCHAR(100) DEFAULT NULL,
            ruling_deity VARCHAR(100) DEFAULT NULL,
            benefits TEXT DEFAULT NULL,
            certified TINYINT(1) DEFAULT 1,
            stock_status VARCHAR(50) DEFAULT 'In Stock',
            is_featured TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        $logs[] = "Table <code>products</code> created.";

        // Step 4: Seed Admin user
        $hashed_admin_pass = password_hash($admin_pass, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$admin_user]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
            $stmt->execute([$hashed_admin_pass, $admin_user]);
            $logs[] = "Admin user updated: <code>" . htmlspecialchars($admin_user) . "</code>";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$admin_user, $hashed_admin_pass]);
            $logs[] = "Admin user created: <code>" . htmlspecialchars($admin_user) . "</code>";
        }

        // Step 5: Seed catalog of spiritual items
        $catalog = [
            [
                'name' => '1 Mukhi Nepali Rudraksha (Pure Silver Capped)',
                'category' => 'Rudraksha',
                'price' => 5100.00,
                'original_price' => 7500.00,
                'image_url' => 'rudraksha_1mukhi.jpg',
                'ruling_planet' => 'Sun (Surya)',
                'ruling_deity' => 'Lord Shiva',
                'benefits' => 'Grants supreme consciousness, leadership, removes all sins, bestows peace and spiritual enlightenment.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => 'Original rare 1 Mukhi natural Nepali Rudraksha with 100% purity lab certificate, Haridwar Ganga Jal energized and capped in 925 pure silver.'
            ],
            [
                'name' => 'Original 5 Mukhi Nepali Rudraksha Mala (108+1 Beads)',
                'category' => 'Rudraksha',
                'price' => 1250.00,
                'original_price' => 1800.00,
                'image_url' => 'cat_rudraksha.jpg',
                'ruling_planet' => 'Jupiter (Brihaspati)',
                'ruling_deity' => 'Lord Kalagni Rudra',
                'benefits' => 'Destroys negative energy, regulates blood pressure, brings mental tranquility, health and divine protection.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => 'Certified 108+1 natural 5 Mukhi Nepali Rudraksha Japa Mala, energized in holy Haridwar Vedic rituals.'
            ],
            [
                'name' => 'Certified Natural Ceylon Yellow Sapphire (Pukhraj Ratna)',
                'category' => 'Ratna (Gemstones)',
                'price' => 11500.00,
                'original_price' => 15000.00,
                'image_url' => 'pukhraj_stone.jpg',
                'ruling_planet' => 'Jupiter (Guru)',
                'ruling_deity' => 'Lord Vishnu / Brihaspati',
                'benefits' => 'Attracts immense wealth, career wisdom, academic success, marital bliss, and spiritual prosperity.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => '100% Untreated and unheated natural Ceylon Pukhraj gemstone with authorized gemological lab certificate & purity guarantee.'
            ],
            [
                'name' => 'Natural Zambian Emerald (Panna Ratna)',
                'category' => 'Ratna (Gemstones)',
                'price' => 8500.00,
                'original_price' => 11000.00,
                'image_url' => 'panna_emerald.jpg',
                'ruling_planet' => 'Mercury (Budh)',
                'ruling_deity' => 'Lord Ganesha / Budh Dev',
                'benefits' => 'Sharpens intellect, enhances business communication, memory, public speaking, and trade growth.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => 'Deep emerald green natural Zambian Panna with certified Vedic purity, energized according to your birth chart.'
            ],
            [
                'name' => 'Certified Royal Blue Sapphire (Neelam Ratna)',
                'category' => 'Ratna (Gemstones)',
                'price' => 14500.00,
                'original_price' => 19000.00,
                'image_url' => 'neelam_sapphire.jpg',
                'ruling_planet' => 'Saturn (Shani)',
                'ruling_deity' => 'Lord Shani Dev',
                'benefits' => 'Instantly unlocks luck, dispels misfortune, protects against hidden enemies and evil eyes, brings sudden fortune.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => 'Unheated pure royal Blue Sapphire (Neelam) with high clarity, accompanied by laboratory test certificate.'
            ],
            [
                'name' => 'Authentic Haridwar Vrindavan Tulsi Japa Mala (108 Beads)',
                'category' => 'Malas & Rosaries',
                'price' => 250.00,
                'original_price' => 450.00,
                'image_url' => 'tulsi_mala.jpg',
                'ruling_planet' => 'Mercury & Jupiter',
                'ruling_deity' => 'Lord Vishnu & Tulsi Devi',
                'benefits' => 'Purifies body and soul, protects against negative aura, ideal for Gayatri and Vishnu mantra chanting.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => '100% natural sacred Tulsi wood hand-knotted 108 beads Japa Mala dipped in holy Haridwar Ganga Jal.'
            ],
            [
                'name' => 'Pure Himalayan Sphatik Crystal Mala (Diamond Cut)',
                'category' => 'Malas & Rosaries',
                'price' => 650.00,
                'original_price' => 999.00,
                'image_url' => 'sphatik_mala.jpg',
                'ruling_planet' => 'Venus (Shukra)',
                'ruling_deity' => 'Maa Saraswati & Lord Shiva',
                'benefits' => 'Cools mind, balances temper, improves focus and intuition, removes chronic stress and negative vibes.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => 'Natural transparent cold Sphatik quartz crystal mala with certified clarity, ideal for chanting Lakshmi and Saraswati mantras.'
            ],
            [
                'name' => 'Original Bajne Wala Dakshinavarti Shankh (Blowing & Puja)',
                'category' => 'Sacred Shankh',
                'price' => 2100.00,
                'original_price' => 3200.00,
                'image_url' => 'shankh_original.jpg',
                'ruling_planet' => 'Moon (Chandra)',
                'ruling_deity' => 'Maha Lakshmi & Lord Vishnu',
                'benefits' => 'Its sacred resonant sound dispels Vastu doshas, eradicates negative spirits, and brings divine wealth into the home.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => 'Authentic ocean-born right-handed blowing Shankh engraved with pure brass Vedic motifs, tested for acoustic clarity.'
            ],
            [
                'name' => 'Pran Pratishthit Siddh Golden Shri Yantra & Kuber Set',
                'category' => 'Siddh Yantras',
                'price' => 1850.00,
                'original_price' => 2800.00,
                'image_url' => 'shree_yantra.jpg',
                'ruling_planet' => 'All 9 Planets',
                'ruling_deity' => 'Maa Tripurasundari & Lord Kuber',
                'benefits' => 'Magnetizes unending wealth, prosperity, business expansion, and cosmic harmony in home or office temple.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => 'Heavy pure brass Ashtadhatu 3D Meru Shri Yantra with Maha Lakshmi Kuber Plate energized with 1,00,008 Vedic Beej Mantras.'
            ],
            [
                'name' => 'Pure 925 Silver Vedic Navratna Ring (Adjustable)',
                'category' => 'Navratna Jewelry',
                'price' => 3200.00,
                'original_price' => 4500.00,
                'image_url' => 'navratna_ring.jpg',
                'ruling_planet' => 'All 9 Navagrahas',
                'ruling_deity' => 'Navagraha Devatas',
                'benefits' => 'Balances all nine planetary doshas simultaneously, provides complete aura shield and harmonious fortune.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => 'Hallmarked 925 sterling silver ring studded with 9 natural astrological gemstones, energized as per Vedic rituals.'
            ],
            [
                'name' => 'Original Red Sandalwood (Rakt Chandan) Japa Mala',
                'category' => 'Malas & Rosaries',
                'price' => 450.00,
                'original_price' => 700.00,
                'image_url' => 'cat_malas.jpg',
                'ruling_planet' => 'Mars (Mangal)',
                'ruling_deity' => 'Lord Hanuman & Maa Durga',
                'benefits' => 'Pacifies Mangal Dosha, boosts courage, protects from black magic and jealousy, removes lethargy.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => 'Authentic fragrant red sandalwood 108 beads rosary with red silk tassel, energized in Haridwar.'
            ],
            [
                'name' => '7 Mukhi Nepali Rudraksha (Maa Mahalakshmi Swaroop)',
                'category' => 'Rudraksha',
                'price' => 1650.00,
                'original_price' => 2400.00,
                'image_url' => 'cat_rudraksha.jpg',
                'ruling_planet' => 'Venus (Shukra)',
                'ruling_deity' => 'Goddess Mahalakshmi',
                'benefits' => 'Overcomes financial hardship, brings unexpected monetary gains, health recovery, and career elevation.',
                'certified' => 1,
                'stock_status' => 'In Stock',
                'is_featured' => 1,
                'description' => 'Natural 7 Mukhi Nepali bead certified with lab X-ray report and Haridwar Ganga Jal sanctification.'
            ]
        ];

        $stmt = $pdo->prepare("INSERT INTO products (
            name, category, price, original_price, image_url, ruling_planet, ruling_deity, benefits, certified, stock_status, is_featured, description
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        foreach ($catalog as $item) {
            $stmt->execute([
                $item['name'],
                $item['category'],
                $item['price'],
                $item['original_price'],
                $item['image_url'],
                $item['ruling_planet'],
                $item['ruling_deity'],
                $item['benefits'],
                $item['certified'],
                $item['stock_status'],
                $item['is_featured'],
                $item['description']
            ]);
        }
        $logs[] = "Seeded " . count($catalog) . " certified products with high-resolution imagery.";

        // Step 6: Save db_config.php
        $config_code = "<?php\n"
                     . "// Auto-generated database configuration\n"
                     . "\$host = " . var_export($db_host, true) . ";\n"
                     . "\$dbname = " . var_export($db_name, true) . ";\n"
                     . "\$username = " . var_export($db_user, true) . ";\n"
                     . "\$password = " . var_export($db_pass, true) . ";\n";

        if (!is_dir(__DIR__ . '/includes')) {
            mkdir(__DIR__ . '/includes', 0755, true);
        }
        file_put_contents($config_file, $config_code);
        $logs[] = "Saved configuration file to <code>includes/db_config.php</code>";

        $success = true;

        if ($is_cli) {
            echo "SUCCESS: Database installed and seeded successfully!\n";
            exit(0);
        }
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        if ($is_cli) {
            echo "ERROR: " . $error_message . "\n";
            exit(1);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup & Installer - Harihar Ratna Emporium</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: radial-gradient(circle at top, #1c160c 0%, #09090c 100%);
            color: #f1f5f9;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            padding: 2.5rem 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .installer-card {
            background: rgba(18, 20, 28, 0.95);
            border: 1px solid rgba(212, 175, 55, 0.35);
            border-radius: 16px;
            max-width: 620px;
            width: 100%;
            padding: 2.5rem;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8), 0 0 35px rgba(212, 175, 55, 0.08);
        }
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .om {
            font-size: 2.5rem;
            color: #d4af37;
            margin-bottom: 0.3rem;
        }
        h1 {
            font-family: 'Cinzel', serif;
            color: #d4af37;
            font-size: 1.6rem;
            letter-spacing: 1px;
            margin-bottom: 0.4rem;
        }
        .header p {
            color: #94a3b8;
            font-size: 0.92rem;
        }
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        .alert-danger {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
        }
        .log-box {
            background: #0d0f14;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            padding: 1rem;
            font-family: monospace;
            font-size: 0.85rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
            max-height: 180px;
            overflow-y: auto;
        }
        .log-box div { margin-bottom: 0.4rem; }
        .form-group {
            margin-bottom: 1.2rem;
        }
        label {
            display: block;
            color: #e2e8f0;
            font-weight: 600;
            font-size: 0.88rem;
            margin-bottom: 0.4rem;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background: #0e1117;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            color: #ffffff;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.2);
        }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #d4af37 0%, #b8860b 100%);
            color: #0c0d12;
            border: none;
            padding: 0.9rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1.05rem;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.35);
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 0.5rem;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(212, 175, 55, 0.5);
        }
        .btn-link {
            display: inline-block;
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid #d4af37;
            color: #d4af37;
            text-decoration: none;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 0.95rem;
            margin: 0.5rem 0.3rem 0;
            transition: background 0.2s;
        }
        .btn-link:hover {
            background: #d4af37;
            color: #0c0d12;
        }
        .hostinger-hint {
            margin-top: 1.5rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 8px;
            font-size: 0.84rem;
            color: #94a3b8;
        }
        .hostinger-hint strong { color: #d4af37; }
    </style>
</head>
<body>

<div class="installer-card">
    <div class="header">
        <div class="om">ॐ</div>
        <h1>Harihar Ratna Emporium</h1>
        <p>1-Click Database Installer & Setup Wizard</p>
    </div>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <strong>🎉 Installation Successful!</strong><br>
            Database tables created and initialized with certified spiritual products & admin user!
        </div>

        <div class="log-box">
            <?php foreach ($logs as $log): ?>
                <div>✔️ <?php echo $log; ?></div>
            <?php endforeach; ?>
        </div>

        <div style="background: rgba(255,255,255,0.04); border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; font-size: 0.9rem;">
            <div><b>Admin Username:</b> <code style="color: #d4af37;"><?php echo htmlspecialchars($admin_user); ?></code></div>
            <div><b>Admin Password:</b> <code style="color: #d4af37;"><?php echo htmlspecialchars($admin_pass); ?></code></div>
        </div>

        <div style="text-align: center;">
            <a href="index.php" class="btn-link">🛍️ Open Storefront</a>
            <a href="admin/index.php" class="btn-link">🔐 Open Admin Portal</a>
        </div>

    <?php else: ?>

        <?php if ($error_message): ?>
            <div class="alert alert-danger">
                <strong>Installation Error:</strong><br>
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="grid-2">
                <div class="form-group">
                    <label>Database Host</label>
                    <input type="text" name="db_host" class="form-control" value="<?php echo htmlspecialchars($default_host); ?>" required>
                </div>
                <div class="form-group">
                    <label>Database Name</label>
                    <input type="text" name="db_name" class="form-control" value="<?php echo htmlspecialchars($default_name); ?>" placeholder="e.g. u123456789_harihar" required>
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Database Username</label>
                    <input type="text" name="db_user" class="form-control" value="<?php echo htmlspecialchars($default_user); ?>" placeholder="e.g. u123456789_admin" required>
                </div>
                <div class="form-group">
                    <label>Database Password</label>
                    <input type="password" name="db_pass" class="form-control" value="<?php echo htmlspecialchars($default_pass); ?>" placeholder="Hostinger DB Password">
                </div>
            </div>

            <div style="margin: 1.25rem 0 0.75rem; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1rem;">
                <span style="color: #d4af37; font-weight: 600; font-size: 0.9rem;">👑 Admin Portal Credentials:</span>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Admin Username</label>
                    <input type="text" name="admin_user" class="form-control" value="<?php echo htmlspecialchars($default_admin_user); ?>" required>
                </div>
                <div class="form-group">
                    <label>Admin Password</label>
                    <input type="password" name="admin_pass" class="form-control" value="<?php echo htmlspecialchars($default_admin_pass); ?>" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                ⚡ Install & Seed Database Now
            </button>
        </form>

        <div class="hostinger-hint">
            <strong>Hostinger Tip:</strong> In Hostinger hPanel &rarr; <b>Databases</b> &rarr; <b>MySQL Databases</b>, create a new database. Copy the generated <b>Database Name</b>, <b>Username</b>, and <b>Password</b> into the fields above and hit install!
        </div>
    <?php endif; ?>
</div>

</body>
</html>
