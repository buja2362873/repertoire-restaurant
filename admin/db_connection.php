<?php
/**
 * Database connection file
 */

$dbPath = __DIR__ . '/../database/db.sqlite';
try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lightweight schema migration for wines table
    $alchoolExistsStmt = $pdo->query("SELECT name FROM sqlite_master WHERE type = 'table' AND name = 'alchool'");
    $alchoolExists = $alchoolExistsStmt && $alchoolExistsStmt->fetchColumn();

    if ($alchoolExists) {
        $wineColumns = $pdo->query("PRAGMA table_info(alchool)")->fetchAll(PDO::FETCH_ASSOC);
        $columnNames = array_column($wineColumns, 'name');

        if (!in_array('type', $columnNames, true)) {
            $pdo->exec("ALTER TABLE alchool ADD COLUMN type TEXT DEFAULT 'vin'");
        }

        if (!in_array('image_url', $columnNames, true)) {
            $pdo->exec("ALTER TABLE alchool ADD COLUMN image_url TEXT");
        }
    }
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>
