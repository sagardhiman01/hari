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

<!-- Top Announcement & Authenticity Bar -->
<div class="announcement-bar">
    <div class="container announcement-inner">
        <div class="announcement-left">
            <span class="heritage-pill">✦ 100+ Years Heritage</span>
            <span>Moti Bazar, opp Chat Gali, Haridwar (Uttarakhand)</span>
        </div>
        <div class="reward-challenge">
            <span>⚜ 100% Purity Guarantee | ₹50,000 Reward if Proven Inauthentic ⚜</span>
        </div>
        <div class="announcement-right">
            <a href="tel:+919927115354" class="announcement-contact-link">
                <span>📞 +91 9927115354</span>
            </a>
            <a href="https://youtube.com/@hariharjyotishhelp" target="_blank" class="announcement-contact-link">
                <span>▶ HARIHAR JYOTISH HELP</span>
            </a>
        </div>
    </div>
</div>

<!-- Sticky Main Header -->
<header class="main-header">
    <div class="container header-inner">
        <a href="index.php" class="brand-logo-wrapper">
            <div class="brand-symbol">ॐ</div>
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
            <a href="#testimonials" class="nav-link">Reviews</a>
            <a href="#contact" class="nav-link">Contact</a>
        </nav>

        <div class="header-actions">
            <a href="https://wa.me/919927115354?text=Namaste%20Pt.%20Ji,%20I%20want%20astrological%20guidance%20for%20Rudraksha%20and%20Gemstones." target="_blank" class="btn-header-wa">
                <span class="wa-icon">💬</span>
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

            <div class="hero-features-list">
                <div class="hero-feature-item">
                    <span class="feat-icon">💎</span>
                    <span>100% Certified Natural Stones</span>
                </div>
                <div class="hero-feature-item">
                    <span class="feat-icon">🔱</span>
                    <span>Haridwar Vedic Pran Pratishtha</span>
                </div>
                <div class="hero-feature-item">
                    <span class="feat-icon">📦</span>
                    <span>Cash on Delivery / VPP Pan-India</span>
                </div>
                <div class="hero-feature-item">
                    <span class="feat-icon">📜</span>
                    <span>Pt. Akash & Gaurav Bharadwaj</span>
                </div>
            </div>

            <div class="hero-cta-group">
                <a href="#products" class="btn-primary-gold">
                    <span>✦ Explore Sacred Collection</span>
                </a>
                <a href="https://wa.me/919927115354?text=Namaste,%20I%20need%20free%20gemstone%20recommendation%20as%20per%20my%20Kundali." target="_blank" class="btn-secondary-gold">
                    <span>✨ Free Kundali Astro Guidance</span>
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
                            <span>👁 Quick View</span>
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
                                <span class="spec-chip"><span class="chip-symbol">🪐</span> <?php echo htmlspecialchars($product['ruling_planet']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($product['ruling_deity'])): ?>
                                <span class="spec-chip"><span class="chip-symbol">🔱</span> <?php echo htmlspecialchars($product['ruling_deity']); ?></span>
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
                                <span class="wa-btn-icon">💬</span>
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
            <div class="trust-card">
                <div class="trust-icon-badge">🏛️</div>
                <h3 class="trust-title">100+ Years Heritage</h3>
                <p class="trust-desc">Operating in Moti Bazar, Haridwar for over a century. Known for authentic gemstones and rare Rudrakshas across India.</p>
            </div>

            <div class="trust-card">
                <div class="trust-icon-badge">🔬</div>
                <h3 class="trust-title">Lab Certified Purity</h3>
                <p class="trust-desc">Every gemstone and high-mukhi Rudraksha comes with authorized gemological laboratory test reports & X-ray verification.</p>
            </div>

            <div class="trust-card">
                <div class="trust-icon-badge">🕉️</div>
                <h3 class="trust-title">Vedic Pran Pratishtha</h3>
                <p class="trust-desc">Sanctified with holy Ganga Jal, panchamrit, and energized with Vedic Beej Mantras according to your Rashi and Nakshatra.</p>
            </div>

            <div class="trust-card">
                <div class="trust-icon-badge">📦</div>
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
<section class="testimonials-section" id="reviews">
    <div class="container">
        <div class="section-header">
            <span class="section-pretitle">Devotee Experiences</span>
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">Thousands of devotees and patrons across India have experienced life-transforming blessings.</p>
            <div class="section-divider"><span class="divider-symbol">✦ ॐ ✦</span></div>
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
                <a href="https://wa.me/919927115354?text=Namaste%20Pandit%20Ji,%20I%20want%20astrological%20consultation%20for%20my%20Kundali%20and%20Gemstone%20recommendation." target="_blank" class="btn-primary-gold">
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
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
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
                <span>Buy via WhatsApp</span>
            </a>
        </div>
    </div>
</div>

<!-- Floating Action Call & WhatsApp Buttons -->
<div class="floating-actions">
    <a href="https://wa.me/919927115354?text=Namaste%20Pt.%20Ji,%20I%20need%20assistance%20with%20Harihar%20Ratna%20products." target="_blank" class="floating-btn floating-btn-wa" data-tooltip="Chat on WhatsApp" aria-label="WhatsApp Us">
        WA
    </a>
    <a href="tel:+919927115354" class="floating-btn floating-btn-call" data-tooltip="Call Pt. Akash Bharadwaj" aria-label="Call Store">
        Call
    </a>
</div>

<script src="script.js"></script>
</body>
</html>
