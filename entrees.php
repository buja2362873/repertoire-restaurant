<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$showImg = false;

// Charger les données du menu depuis la base de données
require_once 'functions/menu_loader.php';
$entrees = getMenuByType('entrees');
?>

<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=360, initial-scale=1.0">
    <title>Entrées - Izakaya Hiroshi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>

    <?php include 'components/menu.php'; ?>

    <?php include 'components/header.php'; ?>

    <main class="menu-section">

        <h2>Entrées</h2>

        <div class="menu-list">
            <?php if (!empty($entrees)): ?>
                <?php foreach ($entrees as $item): ?>
                    <div class="menu-item">
                        <?php
                        // Construire le chemin de l'image basé sur l'ID
                        $imagePath = "assets/images/jpg/" . $item['id'] . "_";
                        // Simplifier le nom pour le fichier image
                        $imageName = strtolower(str_replace([' ', 'é', 'è', 'à', 'ç'], ['_', 'e', 'e', 'a', 'c'], $item['name']));
                        $imageName = preg_replace('/[^a-z0-9_]/', '', $imageName);
                        $imagePath .= $imageName . ".jpg";
                        
                        // Vérifier si l'image existe, sinon utiliser une image par défaut
                        if (!file_exists($imagePath)) {
                            $imagePath = "assets/images/jpg/1_edamame.jpg"; // image par défaut
                        }
                        ?>
                        <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="menu-content">
                            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p><?php echo htmlspecialchars($item['description']); ?></p>
                            <span><?php echo htmlspecialchars($item['price']); ?>$</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun élément trouvé dans le menu.</p>
            <?php endif; ?>
        </div>

    </main>

    <?php include 'components/footer.php'; ?>

    <script src="js/scripts.js"></script>

</body>

</html>