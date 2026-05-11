<?php
/**
 * Database Data Loader
 * Récupère les données depuis la base de données (menu, vins, heures d'ouverture, etc.)
 * 
 * Usage:
 * $entrees = getMenuByType('entrees');
 * $plats = getMenuByType('plats');
 * $desserts = getMenuByType('desserts');
 * $vins = getAllWines();
 * $heures = getHeuresOuverture();
 */

require_once __DIR__ . '/../admin/db_connection.php';

/**
 * Récupère les heures d'ouverture depuis la base de données
 * 
 * @return array Tableau des heures d'ouverture
 */
function getHeuresOuverture() {
    try {
        global $pdo;
        
        $sql = "SELECT jour, heure_ouverture, heure_fermeture FROM heures_ouverture ORDER BY id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error in getHeuresOuverture: " . $e->getMessage());
        return [];
    }
}

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

/**
 * Récupère toutes les réservations (admin)
 * 
 * @return array Tableau des réservations
 */
function getAllReservations() {
    try {
        global $pdo;
        
        $sql = "SELECT id, name, email, phone, time, guests 
                FROM reservations 
                ORDER BY time ASC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error in getAllReservations: " . $e->getMessage());
        return [];
    }
}

/**
 * Récupère les réservations pour une date spécifique
 * 
 * @param string $date La date au format YYYY-MM-DD
 * @return array Tableau des réservations pour cette date
 */
function getReservationsByDate($date) {
    try {
        global $pdo;
        
        $sql = "SELECT id, name, email, phone, time, guests 
                FROM reservations 
                WHERE DATE(time) = ? 
                ORDER BY time ASC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$date]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error in getReservationsByDate: " . $e->getMessage());
        return [];
    }
}
?>
