# Harihar Ratna Emporium (हरिहर रत्न एम्पोरियम)

> **100+ Years Heritage | Certified 100% Original Rudraksha, Rare Gemstones, energized Yantras & Sacred Items | Haridwar**

---

## 🌟 Overview

**Harihar Ratna Emporium** is a dynamic, full-featured web application designed for a heritage astrological store based in Haridwar, Uttarakhand. The platform enables customers to explore certified Vedic gemstones, authentic Nepali Rudrakshas, sacred Malas, Yantras, and divine items, complete with an interactive consultation booking system, cart/checkout simulation, WhatsApp ordering, and a secure backend administrative dashboard for inventory and product management.

---

## ✨ Features

- **Storefront & Catalog**:
  - Elegant, modern, royal Vedic aesthetics (Gold & Deep Amber accents, dark glassmorphism).
  - Categorized browsing: Rudraksha, Certified Gemstones, Navratna, Pure Malas, Yantras, Shankh.
  - Interactive product search, real-time filtering, price range slider, and sorting.
  - Dynamic Quick View modal with high-resolution imagery and specifications.
  - WhatsApp Direct Order button & quick checkout enquiry modal.
  - Kundli & Astrological Consultation booking form with automated Vedic calculator simulation.
  - Customer review submission & display.

- **Admin Management Panel**:
  - Secure session-based authentication (`/admin`).
  - Dashboard analytics: Total products, active stock value, category distribution, and recent additions.
  - Full CRUD operations: Add new products with file upload, edit pricing/descriptions, update featured status, and delete items.

- **Database Architecture**:
  - MySQL database with relational schema (`products`, `users`).
  - Automatic setup script (`setup.php`) pre-populating essential data and default administrative credentials.

---

## 🛠️ Technology Stack

- **Frontend**: HTML5, Vanilla CSS3 (Custom Design System, Responsive Flexbox/Grid), Modern Vanilla JavaScript.
- **Backend**: PHP 8+ (PDO Database abstraction layer).
- **Database**: MySQL / MariaDB (XAMPP).
- **Icons & Fonts**: Font Awesome 6, Google Fonts (Cinzel Decorative, Plus Jakarta Sans, Rozha One).

---

## 🚀 Getting Started Locally

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL / MariaDB) or PHP 8+ CLI with MySQL.

### Installation Steps

1. **Clone the repository**:
   ```bash
   git clone https://github.com/sagardhiman01/hari.git
   cd hari
   ```

2. **Start MySQL Service**:
   Ensure MySQL is running on `localhost:3306` (e.g. via XAMPP Control Panel).

3. **Initialize Database & Demo Products**:
   Run the setup script:
   ```bash
   php setup.php
   ```
   *This creates the database `harihar_ratna`, configures the schema, generates admin credentials, and creates demo products.*

4. **Start PHP Development Server**:
   ```bash
   php -S localhost:8000
   ```

5. **Access the Application**:
   - **Storefront**: Open [http://localhost:8000](http://localhost:8000) in your browser.
   - **Admin Panel**: Open [http://localhost:8000/admin](http://localhost:8000/admin)
     - **Default Username**: `admin`
     - **Default Password**: `admin123`

---

## 📁 Project Structure

```
Harihar Ratna Emporium/
├── admin/
│   ├── admin_style.css      # Admin dashboard custom styling
│   ├── dashboard.php        # Admin overview & statistics
│   ├── index.php            # Admin login gateway
│   └── manage_products.php  # Product inventory CRUD manager
├── includes/
│   ├── db.php               # PDO database connection handler
│   └── schema.sql           # Database tables structure
├── uploads/                 # Product and banner imagery
├── copy_assets.php          # Asset initialization helper
├── index.php                # Main customer-facing storefront
├── script.js                # Frontend interactive logic
├── setup.php                # Database installer & seed generator
├── style.css                # Global responsive stylesheets
└── README.md                # Project documentation
```

---

## 📜 License
Developed for Harihar Ratna Emporium, Haridwar.
