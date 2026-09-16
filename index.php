<?php
require_once 'includes/db.php';

// Fetch categories
$stmtCats = $pdo->query("SELECT DISTINCT category FROM products ORDER BY category ASC");
$categories = $stmtCats->fetchAll(PDO::FETCH_COLUMN);

// Fetch all active products
$stmt = $pdo->query("SELECT * FROM products ORDER BY is_featured DESC, id ASC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harihar Ratna Emporium — 100+ Years Heritage | Certified Rudraksha & Gemstones | Haridwar</title>
    <meta name="description" content="Harihar Ratna Emporium - 100+ Years trusted spiritual store, Moti Bazar, Haridwar. 100% certified 1 to 14 Mukhi Nepali Rudraksha, Vedic astrological gemstones, holy Tulsi & Sphatik Malas, Dakshinavarti Shankh & Siddh Yantras.">
    <!-- Canonical & SEO Domain Path -->
    <link rel="canonical" href="https://hariharratnaemporium.in/100/">
    
    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://hariharratnaemporium.in/100/">
    <meta property="og:title" content="Harihar Ratna Emporium — 100+ Years Heritage | Haridwar">
    <meta property="og:description" content="100% Certified 1 to 14 Mukhi Nepali Rudraksha, Lab-Certified Vedic Gemstones & Sacred Malas from Haridwar. 100+ Years Legacy.">
    <meta property="og:image" content="https://hariharratnaemporium.in/100/uploads/cat_rudraksha.jpg">
    <meta property="og:site_name" content="Harihar Ratna Emporium">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://hariharratnaemporium.in/100/">
    <meta name="twitter:title" content="Harihar Ratna Emporium — 100+ Years Heritage | Haridwar">
    <meta name="twitter:description" content="100% Certified 1 to 14 Mukhi Nepali Rudraksha, Lab-Certified Vedic Gemstones & Sacred Malas from Haridwar.">
    <meta name="twitter:image" content="https://hariharratnaemporium.in/100/uploads/cat_rudraksha.jpg">

    <!-- Structured Data (JSON-LD) for LocalBusiness & Store -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "JewelryStore",
      "name": "Harihar Ratna Emporium",
      "image": "https://hariharratnaemporium.in/100/uploads/cat_rudraksha.jpg",
      "@id": "https://hariharratnaemporium.in/100/#store",
      "url": "https://hariharratnaemporium.in/100/",
      "telephone": "+919927115354",
      "priceRange": "₹₹",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Moti Bazar, opp. Chat Gali",
        "addressLocality": "Haridwar",
        "addressRegion": "Uttarakhand",
        "postalCode": "249401",
        "addressCountry": "IN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 29.9566,
        "longitude": 78.1706
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday"
        ],
        "opens": "09:00",
        "closes": "21:00"
      },
      "sameAs": [
        "https://youtube.com/@hariharjyotishhelp"
      ]
    }
    </script>

    <!-- Google Fonts Preconnect for Instant Luxury Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Rozha+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css?v=<?php echo filemtime(__DIR__ . '/style.css'); ?>">
    <link rel="icon" href="uploads/cat_rudraksha.jpg" type="image/jpeg">
</head>
<body>

<!-- Sticky Main Header -->
<header class="main-header">
    <div class="container header-inner">
        <a href="index.php" class="brand-logo-wrapper">
            <?php
            // Try to load custom logo from settings
            $siteLogoSrc = null;
            try {
                $logoStmt = $pdo->query("SELECT setting_value FROM site_settings WHERE setting_key = 'site_logo' LIMIT 1");
                if ($logoStmt) {
                    $logoRow = $logoStmt->fetch(PDO::FETCH_ASSOC);
                    if ($logoRow && !empty($logoRow['setting_value'])) {
                        $siteLogoSrc = $logoRow['setting_value'];
                    }
                }
            } catch (Exception $e) { }
            ?>
            <?php if ($siteLogoSrc): ?>
            <div class="brand-logo-img-wrap">
                <img src="<?php echo htmlspecialchars($siteLogoSrc); ?>" alt="Harihar Ratna Emporium Logo" class="brand-logo-img">
            </div>
            <?php else: ?>
            <div class="brand-symbol">ॐ</div>
            <?php endif; ?>
            <div class="brand-names">
                <h1 class="brand-title">Harihar Ratna Emporium</h1>
                <p class="brand-tagline">ESTD. HARIDWAR • 100+ YEARS OF VEDIC TRUST</p>
            </div>
        </a>

        <nav class="main-nav" id="mainNav">
            <a href="#hero" class="nav-link">Home</a>
            <a href="#categories" class="nav-link">Categories</a>
            <a href="#products" class="nav-link">Catalog</a>
            <a href="#heritage" class="nav-link">Our Heritage</a>
            <a href="#assurance" class="nav-link">Purity Guarantee</a>
            <a href="#reviews" class="nav-link">Reviews</a>
            <a href="#contact" class="nav-link">Contact</a>
        </nav>

        <div class="header-actions">
            <a href="https://wa.me/919927115354?text=Namaste%20Pt.%20Ji,%20I%20want%20astrological%20guidance%20for%20Rudraksha%20and%20Gemstones." target="_blank" class="btn-header-wa" aria-label="WhatsApp Consultation">
                <svg class="wa-svg-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                <span>WhatsApp Consultation</span>
            </a>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">☰</button>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero-section" id="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-star">✦</span>
                <span>100+ Years Legacy — Haridwar's Most Trusted Spiritual Landmark</span>
            </div>
            <h2 class="hero-title">
                Authentic, Energized <span class="gold-gradient-text">Rudraksha & Gemstones</span> from Holy Haridwar
            </h2>
            <p class="hero-subtitle">
                100% genuine 1 to 14 Mukhi Nepali Rudraksha, laboratory certified Vedic gemstones, original Dakshinavarti blowing Shankh, and sanctified Japa Malas energized with sacred Ganga Jal & Vedic mantras.
            </p>

            <div class="hero-features-list" data-animate="fade-up">
                <div class="hero-feature-item">
                    <span>100% Certified Natural Stones</span>
                </div>
                <div class="hero-feature-item">
                    <span>Haridwar Vedic Pran Pratishtha</span>
                </div>
                <div class="hero-feature-item">
                    <span>Cash on Delivery / VPP Pan-India</span>
                </div>
                <div class="hero-feature-item">
                    <span>Pt. Akash & Gaurav Bharadwaj</span>
                </div>
            </div>

            <div class="hero-cta-group">
                <a href="#products" class="btn-primary-gold">
                    <span>✦ Explore Sacred Collection</span>
                </a>
                <a href="https://wa.me/919927115354?text=Namaste,%20I%20need%20free%20gemstone%20recommendation%20as%20per%20my%20Kundali." target="_blank" class="btn-secondary-gold btn-wa-glow">
                    <svg class="wa-svg-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    <span>Free Kundali Astro Guidance</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<section class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">100+</div>
                <div class="stat-label">Years of Holy Heritage</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">50,000+</div>
                <div class="stat-label">Satisfied Devotees</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">100%</div>
                <div class="stat-label">Lab Certified Purity</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">1–14</div>
                <div class="stat-label">Mukhi Original Rudraksha</div>
            </div>
        </div>
    </div>
</section>

<!-- Sacred Categories Section -->
<section class="categories-section" id="categories">
    <div class="container">
        <div class="section-header">
            <span class="section-pretitle">Divine Offerings</span>
            <h2 class="section-title">Explore Sacred Categories</h2>
            <p class="section-subtitle">Discover handpicked, purified, and energized spiritual treasures directly from the holy city of Haridwar.</p>
            <div class="section-divider"><span class="divider-symbol">✦ ॐ ✦</span></div>
        </div>

        <div class="categories-grid">
            <div class="category-card" onclick="filterByCategory('Rudraksha')">
                <div class="category-img-wrap">
                    <img src="uploads/cat_rudraksha.jpg" alt="Original Nepali Rudraksha" loading="lazy">
                    <div class="category-overlay">
                        <h3 class="category-title">Sacred Rudraksha</h3>
                        <p class="category-desc">1 to 14 Mukhi Nepali beads, Gauri Shankar & Mala sets with silver capping.</p>
                        <span class="category-link-text">View Products</span>
                    </div>
                </div>
            </div>

            <div class="category-card" onclick="filterByCategory('Ratna (Gemstones)')">
                <div class="category-img-wrap">
                    <img src="uploads/cat_gemstones.jpg" alt="Certified Vedic Astrological Gemstones" loading="lazy">
                    <div class="category-overlay">
                        <h3 class="category-title">Vedic Gemstones</h3>
                        <p class="category-desc">Certified Yellow Sapphire (Pukhraj), Blue Sapphire (Neelam), Emerald (Panna), Ruby.</p>
                        <span class="category-link-text">View Products</span>
                    </div>
                </div>
            </div>

            <div class="category-card" onclick="filterByCategory('Malas & Rosaries')">
                <div class="category-img-wrap">
                    <img src="uploads/cat_malas.jpg" alt="Tulsi and Sphatik Japa Malas" loading="lazy">
                    <div class="category-overlay">
                        <h3 class="category-title">Japa Malas & Rosaries</h3>
                        <p class="category-desc">Authentic 108 beads Tulsi, Sphatik Quartz, Chandan and Vaijayanti Malas.</p>
                        <span class="category-link-text">View Products</span>
                    </div>
                </div>
            </div>

            <div class="category-card" onclick="filterByCategory('Sacred Shankh')">
                <div class="category-img-wrap">
                    <img src="uploads/cat_shankh.jpg" alt="Original Dakshinavarti Shankh" loading="lazy">
                    <div class="category-overlay">
                        <h3 class="category-title">Dakshinavarti Shankh</h3>
                        <p class="category-desc">Pure acoustic blowing & Lakshmi Puja Shankh for prosperity and Vastu shuddhi.</p>
                        <span class="category-link-text">View Products</span>
                    </div>
                </div>
            </div>

            <div class="category-card" onclick="filterByCategory('Siddh Yantras')">
                <div class="category-img-wrap">
                    <img src="uploads/cat_yantras.jpg" alt="Pran Pratishthit Shri Yantra" loading="lazy">
                    <div class="category-overlay">
                        <h3 class="category-title">Siddh Shri Yantras</h3>
                        <p class="category-desc">Ashtadhatu 3D Meru Shri Yantra, Kuber Yantra energized with 1,00,008 Vedic Mantras.</p>
                        <span class="category-link-text">View Products</span>
                    </div>
                </div>
            </div>

            <div class="category-card" onclick="filterByCategory('Navratna Jewelry')">
                <div class="category-img-wrap">
                    <img src="uploads/cat_navratna.jpg" alt="Navratna Silver Ring & Pendant" loading="lazy">
                    <div class="category-overlay">
                        <h3 class="category-title">Navratna Jewelry</h3>
                        <p class="category-desc">Pure 925 sterling silver rings and pendants with 9 astrological certified stones.</p>
                        <span class="category-link-text">View Products</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Catalog Section -->
<section class="products-section" id="products">
    <div class="container">
        <div class="section-header">
            <span class="section-pretitle">Handpicked & Certified</span>
            <h2 class="section-title">Our Sacred Catalog</h2>
            <p class="section-subtitle">Every single item is laboratory tested and personally sanctified in Haridwar before dispatch.</p>
            <div class="section-divider"><span class="divider-symbol">✦ ॐ ✦</span></div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="filter-toolbar">
            <div class="category-pills-list">
                <button class="filter-pill active" onclick="filterProducts('all', this)">All Items</button>
                <button class="filter-pill" onclick="filterProducts('Rudraksha', this)">Rudraksha</button>
                <button class="filter-pill" onclick="filterProducts('Ratna (Gemstones)', this)">Vedic Gemstones</button>
                <button class="filter-pill" onclick="filterProducts('Malas & Rosaries', this)">Japa Malas</button>
                <button class="filter-pill" onclick="filterProducts('Sacred Shankh', this)">Shankh</button>
                <button class="filter-pill" onclick="filterProducts('Siddh Yantras', this)">Yantras</button>
                <button class="filter-pill" onclick="filterProducts('Navratna Jewelry', this)">Navratna</button>
            </div>

            <div class="search-input-wrap">
                <input type="text" id="productSearch" class="search-input" placeholder="Search by name, planet, stone..." oninput="handleSearch()">
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid" id="productsGrid">
            <?php foreach ($products as $product): ?>
                <?php 
                    $discount = '';
                    if (!empty($product['original_price']) && $product['original_price'] > $product['price']) {
                        $pct = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                        $discount = "{$pct}% OFF";
                    }
                    $waMsg = "Namaste Pt. Ji, I want to order *" . $product['name'] . "* (₹" . number_format($product['price'], 2) . ") from Harihar Ratna Emporium. Please share details.";
                ?>
                <div class="product-card" data-category="<?php echo htmlspecialchars($product['category']); ?>" data-name="<?php echo htmlspecialchars(strtolower($product['name'] . ' ' . $product['ruling_planet'] . ' ' . $product['description'])); ?>">
                    <div class="product-img-box">
                        <span class="product-badge-ribbon">✦ 100% Certified ✦</span>
                        <img src="uploads/<?php echo htmlspecialchars($product['image_url'] ?: 'cat_rudraksha.jpg'); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" loading="lazy">
                        <button class="btn-quick-view" onclick="openQuickView(<?php echo htmlspecialchars(json_encode($product)); ?>)">
                            <span>Quick View</span>
                        </button>
                    </div>

                    <div class="product-info">
                        <div class="product-meta-row">
                            <span class="product-category-tag"><?php echo htmlspecialchars($product['category']); ?></span>
                            <span class="product-origin-tag">Haridwar Sanctified</span>
                        </div>
                        <h3 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h3>
                        
                        <div class="product-specs-compact">
                            <?php if (!empty($product['ruling_planet'])): ?>
                                <span class="spec-chip">Planet: <?php echo htmlspecialchars($product['ruling_planet']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($product['ruling_deity'])): ?>
                                <span class="spec-chip">Deity: <?php echo htmlspecialchars($product['ruling_deity']); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="product-price-box">
                            <div class="price-wrap">
                                <span class="current-price">₹<?php echo number_format($product['price'], 2); ?></span>
                                <?php if (!empty($product['original_price'])): ?>
                                    <span class="original-price">₹<?php echo number_format($product['original_price'], 2); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if ($discount): ?>
                                <span class="discount-badge"><?php echo $discount; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="product-actions">
                            <a href="https://wa.me/919927115354?text=<?php echo urlencode($waMsg); ?>" target="_blank" class="btn-buy-wa">
                                <svg class="wa-svg-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                <span>Order via WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Trust Pillars / Divine Assurance Section -->
<section class="trust-section" id="assurance">
    <div class="container">
        <div class="section-header">
            <span class="section-pretitle">Divine Assurance</span>
            <h2 class="section-title">The Harihar Purity Promise</h2>
            <p class="section-subtitle">Rooted in 100 years of unbroken trust in the sanctified ghats of Haridwar.</p>
            <div class="section-divider"><span class="divider-symbol">✦ ॐ ✦</span></div>
        </div>

        <div class="trust-grid">
            <div class="trust-card" data-animate="fade-up" data-delay="0">
                <div class="trust-icon-badge trust-icon-heritage"><span>100+</span></div>
                <h3 class="trust-title">100+ Years Heritage</h3>
                <p class="trust-desc">Operating in Moti Bazar, Haridwar for over a century. Known for authentic gemstones and rare Rudrakshas across India.</p>
            </div>

            <div class="trust-card" data-animate="fade-up" data-delay="100">
                <div class="trust-icon-badge trust-icon-lab"><span>Lab</span></div>
                <h3 class="trust-title">Lab Certified Purity</h3>
                <p class="trust-desc">Every gemstone and high-mukhi Rudraksha comes with authorized gemological laboratory test reports & X-ray verification.</p>
            </div>

            <div class="trust-card" data-animate="fade-up" data-delay="200">
                <div class="trust-icon-badge trust-icon-vedic"><span>ॐ</span></div>
                <h3 class="trust-title">Vedic Pran Pratishtha</h3>
                <p class="trust-desc">Sanctified with holy Ganga Jal, panchamrit, and energized with Vedic Beej Mantras according to your Rashi and Nakshatra.</p>
            </div>

            <div class="trust-card" data-animate="fade-up" data-delay="300">
                <div class="trust-icon-badge trust-icon-cod"><span>VPP</span></div>
                <h3 class="trust-title">Pan-India V.P.P (Postal COD)</h3>
                <p class="trust-desc">Safe doorstep delivery through Indian Postal V.P.P service anywhere in India. Cash on delivery accepted.</p>
            </div>
        </div>
    </div>
</section>

<!-- Haridwar Heritage & Story Section -->
<section class="heritage-section" id="heritage">
    <div class="container">
        <div class="heritage-wrapper">
            <div class="heritage-image-box">
                <img src="uploads/hero_banner.jpg" alt="Harihar Ratna Emporium Haridwar Heritage" loading="lazy">
                <div class="heritage-floating-badge">
                    <strong>100+ Years Heritage</strong>
                    <span>Moti Bazar, Haridwar (Uttarakhand)</span>
                </div>
            </div>

            <div class="heritage-text">
                <span class="section-pretitle">Our Sacred Legacy</span>
                <h2>100 Years of Vedic Purity in Holy Haridwar</h2>
                <p>
                    <strong>Harihar Ratna Emporium</strong> is one of the oldest and most revered spiritual landmarks in holy Haridwar, carrying forward a centenary of unbroken Vedic tradition. We provide genuine astrological gemstones, rare 1 to 14 Mukhi certified Nepali Rudraksha, sacred sandalwood, Tulsi and Sphatik Japa Malas, hallmarked Navratna silver jewelry, and acoustic Dakshinavarti blowing Shankh with a 100% authenticity guarantee.
                </p>
                <p>
                    We firmly believe that sacred items must be pure and properly energized to bestow their divine cosmic blessings. Every single item in our collection undergoes <strong>purification with holy Ganga Jal and authentic Vedic Pran Pratishtha rituals</strong> by learned priests before dispatch.
                </p>

                <div class="proprietors-card">
                    <h4>Pt. Akash Bharadwaj & Gaurav Bharadwaj</h4>
                    <p>Moti Bazar, opp Chat Gali, Haridwar (Uttarakhand) 249401 | Phone: 9927115354, 9927141732</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Devotee Testimonials Section -->
<div id="testimonials" style="position: relative; top: -70px;"></div>
<section class="testimonials-section" id="reviews">
    <div class="container">
        <div class="section-header">
            <span class="section-pretitle">Devotee Experiences</span>
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">Thousands of devotees and patrons across India have experienced life-transforming blessings.</p>
            <div class="section-divider"><span class="divider-symbol">✦ ॐ ✦</span></div>
            <div style="margin-top: 1.25rem;">
                <button type="button" class="btn-primary-gold btn-write-review" onclick="openReviewModal()" id="btnWriteReview">
                    <span>✍ Write a Devotee Review</span>
                </button>
            </div>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="stars-rating">★★★★★</div>
                <p class="review-quote">"I ordered a 1 Mukhi Nepali Rudraksha from Harihar Ratna Emporium. The silver work and lab certification were 100% genuine. After wearing it with Pandit Ji's guidance, I feel immense peace and positivity."</p>
                <div class="reviewer-meta">
                    <div class="reviewer-avatar">RK</div>
                    <div>
                        <div class="reviewer-name">Rajesh Kumar Sharma</div>
                        <div class="reviewer-location">New Delhi</div>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="stars-rating">★★★★★</div>
                <p class="review-quote">"Purchased a certified Ceylon Yellow Sapphire (Pukhraj) ring. Pandit Akash Ji calculated the perfect muhurta and energized the stone. Outstanding quality and prompt VPP postal delivery to Pune."</p>
                <div class="reviewer-meta">
                    <div class="reviewer-avatar">AG</div>
                    <div>
                        <div class="reviewer-name">Anand Gupta</div>
                        <div class="reviewer-location">Pune, Maharashtra</div>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="stars-rating">★★★★★</div>
                <p class="review-quote">"The original Dakshinavarti blowing Shankh and Tulsi Mala are unmatched in purity. Whenever I visit Haridwar, Harihar Ratna Emporium in Moti Bazar is my first stop for spiritual items."</p>
                <div class="reviewer-meta">
                    <div class="reviewer-avatar">MS</div>
                    <div>
                        <div class="reviewer-name">Meenakshi Sundaram</div>
                        <div class="reviewer-location">Bengaluru, Karnataka</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Astrology Guidance & Consultation CTA Banner -->
<section class="consultation-section" id="contact">
    <div class="container">
        <div class="consultation-box">
            <h2>Need Free Astrological Gemstone & Rudraksha Guidance?</h2>
            <p>
                Not sure which Mukhi Rudraksha or Rashi Ratna suits your birth chart? Speak directly with Pt. Akash Bharadwaj & Gaurav Bharadwaj for free Kundali analysis and customized recommendation.
            </p>
            <div class="consultation-btns">
                <a href="https://wa.me/919927115354?text=Namaste%20Pandit%20Ji,%20I%20want%20astrological%20consultation%20for%20my%20Kundali%20and%20Gemstone%20recommendation." target="_blank" class="btn-primary-gold btn-wa-glow">
                    <svg class="wa-svg-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    <span>WhatsApp Pt. Akash Bharadwaj</span>
                </a>
                <a href="tel:+919927115354" class="btn-secondary-outline">
                    <span>Call: +91 9927115354</span>
                </a>
                <a href="tel:+919927141732" class="btn-secondary-outline">
                    <span>Call: +91 9927141732</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Rich Vedic Footer -->
<footer class="main-footer">
    <!-- Purity Guarantee Strip -->
    <div class="footer-purity-bar">
        <div class="container">
            <div class="footer-purity-inner">
                <span class="footer-purity-item">✦ 100+ Years Heritage</span>
                <span class="footer-purity-sep">|</span>
                <span class="footer-purity-item">Moti Bazar, opp Chat Gali, Haridwar (Uttarakhand)</span>
                <span class="footer-purity-sep">|</span>
                <span class="footer-purity-item">⚜ 100% Purity Guarantee | ₹50,000 Reward if Proven Inauthentic ⚜</span>
                <span class="footer-purity-sep">|</span>
                <a href="tel:+919927115354" class="footer-purity-item footer-purity-link">📞 +91 9927115354</a>
                <span class="footer-purity-sep">|</span>
                <a href="https://youtube.com/@hariharjyotishhelp" target="_blank" class="footer-purity-item footer-purity-link">▶ HARIHAR JYOTISH HELP</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <?php if ($siteLogoSrc): ?>
                <img src="<?php echo htmlspecialchars($siteLogoSrc); ?>" alt="Harihar Ratna Emporium" class="footer-logo-img">
                <?php else: ?>
                <div class="footer-brand-symbol">ॐ</div>
                <?php endif; ?>
                <h3>Harihar Ratna Emporium</h3>
                <p>
                    Haridwar's premier 100+ years old institution for certified Vedic gemstones, authentic 1 to 14 Mukhi Nepali Rudraksha, sacred Japa Malas, Siddh Yantras, and acoustic Dakshinavarti Shankh with 100% purity guarantee.
                </p>
                <p style="color: var(--gold-400); font-size: 0.9rem; font-style: italic;">
                    "Truth, Purity & Sanctity — Serving Devotees Since Generations from Holy Haridwar."
                </p>
            </div>

            <div class="footer-col">
                <h4>Sacred Categories</h4>
                <ul class="footer-links">
                    <li><a href="#products" onclick="filterByCategory('Rudraksha')">Nepali Rudraksha</a></li>
                    <li><a href="#products" onclick="filterByCategory('Ratna (Gemstones)')">Vedic Gemstones</a></li>
                    <li><a href="#products" onclick="filterByCategory('Malas & Rosaries')">Japa Malas</a></li>
                    <li><a href="#products" onclick="filterByCategory('Sacred Shankh')">Dakshinavarti Shankh</a></li>
                    <li><a href="#products" onclick="filterByCategory('Siddh Yantras')">Shri & Kuber Yantras</a></li>
                    <li><a href="#products" onclick="filterByCategory('Navratna Jewelry')">Navratna Silver Jewelry</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#heritage">100 Years Legacy</a></li>
                    <li><a href="#assurance">Purity Guarantee</a></li>
                    <li><a href="#testimonials">Devotee Reviews</a></li>
                    <li><a href="https://youtube.com/@hariharjyotishhelp" target="_blank">YouTube Channel</a></li>
                </ul>
            </div>

            <div class="footer-col footer-contact-info">
                <h4>Store Location</h4>
                <p><strong>Address:</strong> Moti Bazar, opp Chat Gali, Haridwar (Uttarakhand) 249401</p>
                <p><strong>Proprietors:</strong> Pt Akash Bharadwaj & Gaurav Bharadwaj</p>
                <p><strong>Phone:</strong> 9927115354 | 9927141732</p>
                <p><strong>Delivery:</strong> Pan-India V.P.P (Postal COD Service)</p>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                &copy; <?php echo date('Y'); ?> Harihar Ratna Emporium, Haridwar. All Rights Reserved.
            </div>
            <div>
                Crafted with Vedic Devotion
            </div>
        </div>
    </div>
</footer>

<!-- Product Quick View Modal -->
<div class="modal-backdrop" id="quickViewModal">
    <div class="modal-card">
        <button class="modal-close-btn" onclick="closeQuickView()">✕</button>
        <div class="modal-img-box">
            <img id="modalImg" src="" alt="Product Image">
        </div>
        <div class="modal-details-box">
            <span class="modal-cat-tag" id="modalCategory">Rudraksha</span>
            <h3 class="modal-title" id="modalTitle">Product Name</h3>
            
            <div class="modal-price-wrap">
                <span class="current-price" id="modalPrice">₹0.00</span>
                <span class="original-price" id="modalOriginalPrice"></span>
            </div>

            <table class="modal-specs-table">
                <tr id="rowPlanet">
                    <td>Ruling Planet:</td>
                    <td id="modalPlanet">-</td>
                </tr>
                <tr id="rowDeity">
                    <td>Ruling Deity:</td>
                    <td id="modalDeity">-</td>
                </tr>
                <tr id="rowBenefits">
                    <td>Vedic Benefits:</td>
                    <td id="modalBenefits">-</td>
                </tr>
                <tr>
                    <td>Certification:</td>
                    <td>100% Lab Tested & Haridwar Sanctified</td>
                </tr>
                <tr>
                    <td>Shipping:</td>
                    <td>Pan-India V.P.P (Postal COD Available)</td>
                </tr>
            </table>

            <p class="modal-desc" id="modalDesc"></p>

            <a href="#" id="modalWaBtn" target="_blank" class="btn-buy-wa" style="margin-top: auto;">
                <svg class="wa-svg-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                <span>Buy via WhatsApp</span>
            </a>
        </div>
    </div>
</div>

<!-- Devotee Review Modal -->
<div class="modal-backdrop" id="reviewModal">
    <div class="modal-card review-modal-card">
        <button class="modal-close-btn" onclick="closeReviewModal()">✕</button>
        <div class="review-modal-header">
            <span class="review-om-badge">ॐ</span>
            <h3 class="review-modal-title">Share Your Devotee Experience</h3>
            <p class="review-modal-sub">Your genuine feedback helps fellow seekers choose authenticated, energized Vedic treasures.</p>
        </div>
        <form id="devoteeReviewForm" onsubmit="handleReviewSubmit(event)">
            <div class="review-rating-select">
                <label>Your Divine Rating:</label>
                <div class="star-rating-picker" id="starPicker">
                    <span class="star-pick active" data-val="1" onclick="setStarRating(1)">★</span>
                    <span class="star-pick active" data-val="2" onclick="setStarRating(2)">★</span>
                    <span class="star-pick active" data-val="3" onclick="setStarRating(3)">★</span>
                    <span class="star-pick active" data-val="4" onclick="setStarRating(4)">★</span>
                    <span class="star-pick active" data-val="5" onclick="setStarRating(5)">★</span>
                </div>
                <input type="hidden" id="reviewRatingVal" value="5">
            </div>
            <div class="review-form-field">
                <label>Your Name *</label>
                <input type="text" id="reviewerName" class="review-input" placeholder="e.g. Ramesh Chandra Sharma" required>
            </div>
            <div class="review-form-field">
                <label>City & State *</label>
                <input type="text" id="reviewerLocation" class="review-input" placeholder="e.g. Jaipur, Rajasthan" required>
            </div>
            <div class="review-form-field">
                <label>Item Purchased / Purpose</label>
                <input type="text" id="reviewerProduct" class="review-input" placeholder="e.g. 7 Mukhi Nepali Rudraksha / Ceylon Pukhraj">
            </div>
            <div class="review-form-field">
                <label>Your Experience / Review *</label>
                <textarea id="reviewerQuote" class="review-textarea" rows="4" placeholder="How did the Rudraksha or Gemstone benefit you? Experience with Pandit Ji's guidance..." required></textarea>
            </div>
            <button type="submit" class="btn-primary-gold" style="width: 100%; justify-content: center; margin-top: 1rem;">
                <span>✦ Submit Devotee Review</span>
            </button>
        </form>
        <div id="reviewSuccessMsg" style="display: none; text-align: center; padding: 2rem 1rem;">
            <div style="font-size: 2.8rem; color: #ffd700; margin-bottom: 0.5rem; line-height: 1;">ॐ</div>
            <h4 style="font-family: 'Cinzel', serif; color: #ffd700; font-size: 1.35rem; margin-bottom: 0.6rem;">Har Har Mahadev! Dhanyavaad</h4>
            <p style="color: #e6dfd5; font-size: 0.95rem; line-height: 1.6;">Your heartfelt review has been recorded with deep reverence and added to Devotee Experiences. May Lord Shiva and mother Ganga bestow immense health and prosperity upon your family!</p>
            <button class="btn-secondary-gold" onclick="closeReviewModal()" style="margin-top: 1.5rem;">Continue Browsing</button>
        </div>
    </div>
</div>

<!-- Floating Action Call & WhatsApp Buttons -->
<div class="floating-actions">
    <a href="https://wa.me/919927115354?text=Namaste%20Pt.%20Ji,%20I%20need%20assistance%20with%20Harihar%20Ratna%20products." target="_blank" class="floating-btn floating-btn-wa" data-tooltip="Chat on WhatsApp" aria-label="WhatsApp Us">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
    </a>
    <a href="tel:+919927115354" class="floating-btn floating-btn-call" data-tooltip="Call Pt. Akash Bharadwaj" aria-label="Call Store">
        <svg viewBox="0 0 24 24" fill="white" width="22" height="22" xmlns="http://www.w3.org/2000/svg"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
    </a>
</div>

<script src="script.js"></script>
</body>
</html>
