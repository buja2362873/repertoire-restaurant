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
                        ?>
                        <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
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