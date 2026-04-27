<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$showImg = false;

// Charger les données du menu depuis la base de données
require_once 'functions/menu_loader.php';
$sushis = getMenuByType('plats_principaux_sushis');
$grillades = getMenuByType('plats_principaux_grillades');
$vegetarien = getMenuByType('plats_vegetarien');
?>

<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=360, initial-scale=1.0">
    <title>Plats - Izakaya Hiroshi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>

    <?php include 'components/menu.php'; ?>

    <?php include 'components/header.php'; ?>

    <main class="menu-section">

        <h2>Plats principaux</h2>

        <!-- SUSHIS -->
        <div class="menu-categorie">
            <h3 class="categorie-titre">Sushis et sashimis</h3>

            <div class="menu-list">
                <?php if (!empty($sushis)): ?>
                    <?php foreach ($sushis as $item): ?>
                        <div class="menu-item">
                            <?php
                            ?>
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                            <p><?php echo htmlspecialchars($item['description']); ?></p>
                            <span><?php echo htmlspecialchars($item['price']); ?>$</span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun sushi trouvé.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- GRILLADES -->
        <div class="menu-categorie">
            <h3 class="categorie-titre">Grillades</h3>

            <div class="menu-list">
                <?php if (!empty($grillades)): ?>
                    <?php foreach ($grillades as $item): ?>
                        <div class="menu-item">
                            <?php
                            ?>
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                            <p><?php echo htmlspecialchars($item['description']); ?></p>
                            <span><?php echo htmlspecialchars($item['price']); ?>$</span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune grillade trouvée.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- VÉGÉTARIEN -->
        <div class="menu-categorie">
            <h3 class="categorie-titre">Végétarien</h3>

            <div class="menu-list">
                <?php if (!empty($vegetarien)): ?>
                    <?php foreach ($vegetarien as $item): ?>
                        <div class="menu-item">
                            <?php
                        ?>
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                            <p><?php echo htmlspecialchars($item['description']); ?></p>
                            <span><?php echo htmlspecialchars($item['price']); ?>$</span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun plat végétarien trouvé.</p>
                <?php endif; ?>
            </div>
        </div>

    </main>

    <?php include 'components/footer.php'; ?>

    <script src="js/scripts.js"></script>

</body>

</html>