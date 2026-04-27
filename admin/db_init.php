<?php
/**
 * Database initialization
 * Creates admin table if it doesn't exist
 */

$dbPath = __DIR__ . '/../database/db.sqlite';
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Create admin table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS admin (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Check if Samuel user exists, if not create one
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admin WHERE username = ?");
    $stmt->execute(['Samuel']);
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        $stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
        // Admin credentials: Samuel / Password123 (plain text)
        $stmt->execute(['Samuel', 'Password123']);
    }

    echo "Database initialized successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
