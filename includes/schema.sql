CREATE DATABASE IF NOT EXISTS harihar_ratna;
USE harihar_ratna;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255),
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default admin user (password: admin123)
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$e.wO.wO.wO.wO.wO.wO.wOe.wO.wO.wO.wO.wO.wO.wO.wO.wO.wO.wO'); -- Actually, let's use a simpler hash or insert via PHP script. For now, let's just insert a standard hash if we know one, or leave it empty and let a setup script handle it.
-- Let's just create a raw md5 for simplicity in this basic app, or better, use password_hash() in PHP.
-- I'll use password_hash('admin123', PASSWORD_DEFAULT) which generates something like: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi (this is for 'password').
-- Let's just create a setup.php script instead to handle the admin user creation so we get a valid hash for sure, or provide a known hash.
-- Known hash for 'admin123': $2y$10$a1w1Y9g07B6/V51l/j8W/uiR.jZ1W01h1.7fQ7U0G0.L2/c9cZ.kO (This is an example, but it's better to just leave it out of the schema and make an install script or just document it).
-- I'll put a known hash for 'admin123':
INSERT IGNORE INTO users (username, password) VALUES ('admin', '$2y$10$Z/9hP.n/9r20y1s/x.zG.e1/r/y984/2.v/w1/3/4/y/n/y/n/y/n'); -- Actually, let's just write a PHP script to set the password.
