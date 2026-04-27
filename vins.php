<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$showImg = false;

// Charger les données du menu depuis la base de données
require_once 'functions/menu_loader.php';
$sakeEtShoshu = getWinesByType('sake_et_shoshu');
$vinBlanc = getWinesByType('vin_blanc');
$vinRouge = getWinesByType('vin_rouge');
$bieresEtSakePetillant = getWinesByType('bieres_japonaise_et_sake_petillant');
?>

<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=360, initial-scale=1.0">
    <title>Cave à vin - Izakaya Hiroshi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>

    <?php include 'components/menu.php'; ?>

    <?php include 'components/header.php'; ?>

    <main class="menu-section">

        <h2>Cave à vin</h2>

        <div class="menu-categorie">
            <h3 class="categorie-titre">Notre sélection</h3>

            <div class="menu-list">
                <?php if (!empty($vins)): ?>
                    <?php foreach ($vins as $item): ?>
                        <div class="menu-item">
                            <?php if (!empty($item['image_url'])): ?>
                                <?php
                                    $wineImage = $item['image_url'];
                                    if (!preg_match('/^(https?:\/\/|data:|\/)/', $wineImage)) {
                                        $wineImage = $wineImage;
                                    }
                                ?>
                                <img src="<?php echo htmlspecialchars($wineImage); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <?php endif; ?>
                            <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                            <?php if (!empty($item['type'])): ?>
                                <p><?php echo htmlspecialchars($item['type']); ?></p>
                            <?php endif; ?>
                            <p><?php echo htmlspecialchars($item['country']); ?></p>
                            <span><?php echo htmlspecialchars($item['price']); ?> $</span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun vin trouvé.</p>
                <?php endif; ?>
            </div>
        </div>

    </main>

    <?php include 'components/footer.php'; ?>

    <script src="js/scripts.js"></script>

</body>

</html>