<?php
$host = 'localhost';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS harihar_ratna");
    $pdo->exec("USE harihar_ratna");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

echo "Initializing database schema...\n";

// Ensure tables exist with rich columns
$pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

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
)");

// Insert/Update Admin
$adminUser = 'admin';
$adminPass = 'admin123';
$hashed = password_hash($adminPass, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
$stmt->execute([$adminUser]);
if ($stmt->fetchColumn() == 0) {
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$adminUser, $hashed]);
    echo "Admin user created: admin / admin123\n";
} else {
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->execute([$hashed, $adminUser]);
    echo "Admin user verified.\n";
}

// Reset / Seed comprehensive spiritual catalog
$pdo->exec("TRUNCATE TABLE products");

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
        'description' => '100% Untreated and unheated natural Ceylon Pukhraj gemstone with authorized gemological lab certificate & 50,000 INR purity guarantee.'
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
        'description' => 'Unheated pure royal Blue Sapphire (Neelam) with high clarity, accompanied by government recognized laboratory test report.'
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
        'description' => 'Authentic ocean-born right-handed blowing Shankh engraved with pure brass Vedic motifs, tested for acoustic clarity and purity.'
    ],
    [
        'name' => 'Pran Pratishthit Siddh Golden Shri Yantra & Kuber Yantra Set',
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
        'description' => 'Hallmarked 925 sterling silver ring studded with 9 natural astrological gemstones, energized as per ancient Brihat Samhita rituals.'
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

echo "Database successfully reseeded with " . count($catalog) . " premium spiritual products!\n";
