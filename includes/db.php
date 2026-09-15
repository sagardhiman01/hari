<?php
// Database configuration and PDO connection handler
$config_file = __DIR__ . '/db_config.php';

if (file_exists($config_file)) {
    require_once $config_file;
} else {
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_NAME') ?: 'harihar_ratna';
    $username = getenv('DB_USER') ?: 'root';
    $password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_TIMEOUT => 2
    ]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    // Fallback to local SQLite database if available
    $sqlite_file = __DIR__ . '/harihar.sqlite';
    if (file_exists($sqlite_file)) {
        try {
            $pdo = new PDO("sqlite:" . $sqlite_file);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Throwable $sqle) {
            $pdo = null;
        }
    }
    
    if (!$pdo) {
        if (php_sapi_name() !== 'cli') {
            $setup_path = (strpos($_SERVER['REQUEST_URI'] ?? '', '/admin') !== false) ? '../setup.php' : 'setup.php';
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Database Setup Required - Harihar Ratna Emporium</title>
            <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
            <style>
                * { box-sizing: border-box; margin: 0; padding: 0; }
                body {
                    background: radial-gradient(circle at top, #1a150c 0%, #0a0a0d 100%);
                    color: #e2e8f0;
                    font-family: 'Plus Jakarta Sans', sans-serif;
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 1.5rem;
                }
                .setup-container {
                    background: rgba(18, 18, 24, 0.95);
                    border: 1px solid rgba(212, 175, 55, 0.35);
                    border-radius: 16px;
                    max-width: 580px;
                    width: 100%;
                    padding: 2.5rem;
                    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8), 0 0 40px rgba(212, 175, 55, 0.1);
                    text-align: center;
                }
                .om-symbol {
                    font-size: 2.5rem;
                    color: #d4af37;
                    margin-bottom: 0.5rem;
                }
                h1 {
                    font-family: 'Cinzel', serif;
                    color: #d4af37;
                    font-size: 1.6rem;
                    margin-bottom: 0.5rem;
                    letter-spacing: 1px;
                }
                .subtitle {
                    color: #94a3b8;
                    font-size: 0.95rem;
                    margin-bottom: 1.5rem;
                    line-height: 1.5;
                }
                .error-pill {
                    background: rgba(239, 68, 68, 0.12);
                    border: 1px solid rgba(239, 68, 68, 0.3);
                    color: #fca5a5;
                    border-radius: 8px;
                    padding: 0.85rem 1rem;
                    font-size: 0.85rem;
                    text-align: left;
                    margin-bottom: 1.75rem;
                    word-break: break-all;
                    font-family: monospace;
                }
                .btn-setup {
                    display: inline-block;
                    background: linear-gradient(135deg, #d4af37 0%, #b8860b 100%);
                    color: #0b0b0e;
                    font-weight: 700;
                    text-decoration: none;
                    padding: 0.9rem 2.2rem;
                    border-radius: 8px;
                    font-size: 1rem;
                    letter-spacing: 0.5px;
                    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.35);
                    transition: transform 0.2s, box-shadow 0.2s;
                }
                .btn-setup:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 12px 30px rgba(212, 175, 55, 0.5);
                }
                .help-box {
                    margin-top: 2rem;
                    background: rgba(255, 255, 255, 0.03);
                    border: 1px solid rgba(255, 255, 255, 0.07);
                    border-radius: 10px;
                    padding: 1.25rem;
                    text-align: left;
                    font-size: 0.88rem;
                }
                .help-box h3 {
                    color: #d4af37;
                    font-size: 0.95rem;
                    margin-bottom: 0.6rem;
                }
                .help-box ol {
                    padding-left: 1.2rem;
                    color: #cbd5e1;
                    line-height: 1.6;
                }
            </style>
        </head>
        <body>
            <div class="setup-container">
                <div class="om-symbol">ॐ</div>
                <h1>Database Connection Required</h1>
                <p class="subtitle">Harihar Ratna Emporium has been deployed, but your hosting database credentials need to be configured.</p>

                <div class="error-pill">
                    <strong>Status:</strong> <?php echo htmlspecialchars($e->getMessage()); ?>
                </div>

                <a href="<?php echo htmlspecialchars($setup_path); ?>" class="btn-setup">
                    ⚡ Open 1-Click Database Setup (/setup.php)
                </a>

                <div class="help-box">
                    <h3>Hostinger Setup Instructions:</h3>
                    <ol>
                        <li>Log in to your <b>Hostinger hPanel</b>.</li>
                        <li>Go to <b>Databases</b> &rarr; <b>MySQL Databases</b>.</li>
                        <li>Create a Database & note your <b>Database Name</b>, <b>Username</b>, and <b>Password</b>.</li>
                        <li>Click the golden button above to run <b>setup.php</b> and enter those details.</li>
                    </ol>
                </div>
            </div>
        </body>
        </html>
        <?php
            exit;
        } else {
            die("Database connection failed: " . $e->getMessage() . "\n");
        }
    }
}
?>
