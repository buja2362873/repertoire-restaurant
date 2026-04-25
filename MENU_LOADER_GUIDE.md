# 📊 Menu Data Loader - Documentation

## Vue d'ensemble

Tous les menus de restaurant sont maintenant alimentés directement depuis la base de données SQLite. Cela facilite la gestion et la maintenance des menus sans modifier le HTML.

## 📁 Structure

- **Fichier principal:** `functions/menu_loader.php`
- **Base de données:** `database/db.sqlite`
- **Tables:** 
  - `repas` (Entrées, Plats, Desserts)
  - `alchool` (Boissons/Vins)

## 🚀 Utilisation

### 1. Importer la fonction
```php
<?php
require_once 'functions/menu_loader.php';
?>
```

### 2. Récupérer les données

**Récupérer un type de plat spécifique:**
```php
$entrees = getMenuByType('entrees');
$plats = getMenuByType('plats');
$desserts = getMenuByType('desserts');
```

**Récupérer tous les vins:**
```php
$vins = getAllWines();
```

**Récupérer tous les menus à la fois:**
```php
$menus = getAllMenuItems();
// Résultat: ['entrees' => [...], 'plats' => [...], 'desserts' => [...], 'vins' => [...]]
```

**Récupérer un item spécifique:**
```php
$item = getMenuItemById(1, 'repas');  // Récupère le plat avec ID 1
$wine = getMenuItemById(5, 'alchool'); // Récupère le vin avec ID 5
```

### 3. Afficher les données

```php
<?php foreach ($entrees as $item): ?>
    <div class="menu-item">
        <h4><?php echo htmlspecialchars($item['name']); ?></h4>
        <p><?php echo htmlspecialchars($item['description']); ?></p>
        <span><?php echo htmlspecialchars($item['price']); ?>$</span>
    </div>
<?php endforeach; ?>
```

## 📋 Structure des données

### Table `repas` (Entrées, Plats, Desserts)
```
- id           (INT, clé primaire)
- name         (TEXT, nom du plat)
- description  (TEXT, description)
- type         (TEXT, valeur: 'entrees', 'plats', 'desserts')
- price        (TEXT, prix)
- image_url    (TEXT, URL de l'image, peut être vide)
- created_at   (DATETIME)
- updated_at   (DATETIME)
```

### Table `alchool` (Boissons/Vins)
```
- id           (INT, clé primaire)
- name         (TEXT, nom du vin)
- country      (TEXT, pays d'origine)
- price        (TEXT, prix)
- created_at   (DATETIME)
- updated_at   (DATETIME)
```

## 🔧 Configuration de la base de données

La connexion PDO est automatiquement établie lors de l'inclusion de `menu_loader.php`.

**Fichier de connexion:** `admin/db_connection.php`
- DSN: `sqlite://database/db.sqlite`
- Mode erreur: PDO::ERRMODE_EXCEPTION

## ✨ Pages mises à jour

Les pages suivantes utilisent maintenant le système:
- ✅ `entrees.php` - Entrées dynamiques
- ✅ `plats.php` - Plats dynamiques  
- ✅ `desserts.php` - Desserts dynamiques
- ✅ `vins.php` - Vins/Boissons dynamiques

## 🛡️ Sécurité

- **Sanitization:** `htmlspecialchars()` est utilisé pour échapper les données
- **Requêtes:** Toutes les requêtes utilisent les prepared statements (PDO)
- **Gestion erreurs:** Les erreurs sont loggées sans afficher les détails aux utilisateurs

## 📝 Exemple complet

```php
<?php
require_once 'functions/menu_loader.php';
$entrees = getMenuByType('entrees');
?>

<div class="menu">
    <?php foreach ($entrees as $item): ?>
        <div class="dish">
            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
            <p><?php echo htmlspecialchars($item['description']); ?></p>
            <span><?php echo htmlspecialchars($item['price']); ?>$</span>
        </div>
    <?php endforeach; ?>
</div>
```

## 🆘 Dépannage

**Erreur: "No rows found"**
- Vérifiez que la base de données existe: `database/db.sqlite`
- Vérifiez que les tables `repas` et `alchool` sont créées
- Vérifiez que le type spécifié existe ('entrees', 'plats', 'desserts')

**Erreur: "PDOException"**
- Vérifiez le chemin de la base de données
- Vérifiez les permissions de lecture du fichier `.sqlite`
- Vérifiez la connexion PDO dans `admin/db_connection.php`

## 🔄 Ajouter/Modifier/Supprimer des éléments

Allez à: `http://localhost:8000/admin/dashboard.php`
- Username: `Samuel`
- Password: `Password123`

Le dashboard vous permet de gérer tous les éléments du menu directement!

---
**Créé pour:** Resto Izakaya Hiroshi  
**Dernière mise à jour:** Avril 2026
