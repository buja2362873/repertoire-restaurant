<?php
/**
 * Export CSV
 * Exporte les réservations en CSV
 */

require_once 'check_session.php';
require_once 'db_connection.php';

try {
    $table = $_GET['table'] ?? '';
    
    // Sécurité: vérifier que la table existe et est autorisée
    $allowedTables = ['reservations', 'admin', 'heures_ouverture', 'repas', 'alchool'];
    
    if (!in_array($table, $allowedTables)) {
        throw new Exception('Table non autorisée');
    }
    
    // Récupérer les données
    $stmt = $pdo->query("SELECT * FROM $table");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($data)) {
        throw new Exception('Aucune donnée à exporter');
    }
    
    // Récupérer les en-têtes
    $headers = array_keys($data[0]);
    
    // Configurer les en-têtes HTTP
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $table . '_' . date('Y-m-d_H-i-s') . '.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Ouvrir le buffer en tant que fichier CSV
    $output = fopen('php://output', 'w');
    
    // Écrire BOM UTF-8 pour Excel
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    // Écrire les en-têtes
    fputcsv($output, $headers, ',', '"');
    
    // Écrire les données
    foreach ($data as $row) {
        fputcsv($output, array_values($row), ',', '"');
    }
    
    fclose($output);
    exit;
    
} catch (Exception $e) {
    http_response_code(400);
    echo 'Erreur: ' . htmlspecialchars($e->getMessage());
    exit;
}
?>
