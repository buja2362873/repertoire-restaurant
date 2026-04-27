<?php
/**
 * Menu Data Loader
 * Récupère les données du menu depuis la base de données
 * 
 * Usage:
 * $entrees = getMenuByType('entrees');
 * $plats = getMenuByType('plats');
 * $desserts = getMenuByType('desserts');
 * $vins = getAllWines();
 */

require_once __DIR__ . '/../admin/db_connection.php';

/**
 * Récupère tous les items du menu par type (avec LIKE pour les patterns)
 * 
 * @param string $type Le type de plat (entrees, plats%, desserts)
 * @return array Tableau des items du menu
 */
function getMenuByType($type) {
    try {
        global $pdo;
        
        // Chercher les items qui commencent par ce type (ex: "plats%" pour "plats_principaux_sushis")
        $sql = "SELECT id, name, description, type, price, image_url, created_at, updated_at 
                FROM repas 
                WHERE type LIKE ? 
                ORDER BY name ASC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$type . '%']);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error in getMenuByType: " . $e->getMessage());
        return [];
    }
}

/**
 * Récupère tous les vins filtrés par type
 * 
 * @param string $type Le type de vin (ex: 'Vin rouge', 'Vin blanc', 'Saké et shoshu', 'Bières japonaise et saké pétillant')
 * @return array Tableau des vins du type spécifié
 */
function getWinesByType($type) {
    try {
        global $pdo;
        
        $sql = "SELECT id, name, country, type, price, image_url, created_at, updated_at 
                FROM alchool 
                WHERE type LIKE ? 
                ORDER BY name ASC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$type . '%']);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error in getWinesByType: " . $e->getMessage());
        return [];
    }
}

/**
 * Récupère tous les vins
 * 
 * @return array Tableau des vins
 */
function getAllWines() {
    try {
        global $pdo;
        
        $sql = "SELECT id, name, country, type, price, image_url, created_at, updated_at 
                FROM alchool 
                ORDER BY type ASC, name ASC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error in getAllWines: " . $e->getMessage());
        return [];
    }
}

/**
 * Récupère tous les items du menu avec toutes les catégories
 * 
 * @return array Tableau associatif avec les clés 'entrees', 'plats', 'desserts', 'vins'
 */
function getAllMenuItems() {
    return [
        'entrees' => getMenuByType('entrees'),
        'plats' => getMenuByType('plats'),
        'desserts' => getMenuByType('desserts'),
        'vins' => getAllWines()
    ];
}

/**
 * Récupère un item spécifique par son ID
 * 
 * @param int $id L'ID de l'item
 * @param string $table La table ('repas' ou 'alchool')
 * @return array|null L'item ou null si non trouvé
 */
function getMenuItemById($id, $table = 'repas') {
    try {
        global $pdo;
        
        $sql = "SELECT * FROM $table WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error in getMenuItemById: " . $e->getMessage());
        return null;
    }
}
?>
