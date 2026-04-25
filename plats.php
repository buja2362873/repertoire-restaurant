<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$showImg = false;

// Charger les données du menu depuis la base de données
require_once 'functions/menu_loader.php';
$plats = getMenuByType('plats');
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

                <div class="menu-item">
                    <h4>Assortiment makis & nigiris (12 morceaux)</h4>
                    <p>Sélection du chef, soupe miso et salade de wakame</p>
                    <span>42$</span>
                </div>

                <div class="menu-item">
                    <h4>Assortiment de sashimis (10 morceaux)</h4>
                    <p>Sélection du chef, soupe miso et salade de wakame</p>
                    <span>48$</span>
                </div>

                <div class="menu-item">
                    <h4>Makis, hosomakis et nigiris (12 morceaux)</h4>
                    <p>Sélection du chef, soupe miso et salade de wakame</p>
                    <span>34$</span>
                </div>

                <div class="menu-item">
                    <h4>Chirashi sushi</h4>
                    <p>Bol de riz vinaigré, sashimis et légumes marinés</p>
                    <span>35$</span>
                </div>

                <div class="menu-item">
                    <h4>Plateau Omakase (2 personnes)</h4>
                    <p>Sélection exclusive du chef, soupe miso et salade</p>
                    <span>88$</span>
                </div>

            </div>
        </div>

        <!-- GRILLADES -->
        <div class="menu-categorie">
            <h3 class="categorie-titre">Grillades</h3>

            <div class="menu-list">

                <div class="menu-item">
                    <h4>Saumon teriyaki</h4>
                    <p>Légumes sautés au shoyu, riz vapeur</p>
                    <span>32$</span>
                </div>

                <div class="menu-item">
                    <h4>Bœuf wagyu grillé</h4>
                    <p>Wagyu A5, sauce yakiniku, légumes au sésame</p>
                    <span>48$</span>
                </div>

                <div class="menu-item">
                    <h4>Poulet karaage</h4>
                    <p>Poulet frit, mayonnaise au yuzu</p>
                    <span>38$</span>
                </div>

                <div class="menu-item">
                    <h4>Ramen miso maison</h4>
                    <p>Porc chashu, œuf mariné, nouilles fraîches</p>
                    <span>44$</span>
                </div>

                <div class="menu-item">
                    <h4>Assortiment yakitori (10 morceaux)</h4>
                    <p>Poulet, bœuf, crevettes + riz et Sapporo</p>
                    <span>40$</span>
                </div>

            </div>
        </div>

        <!-- VÉGÉTARIEN -->
        <div class="menu-categorie">
            <h3 class="categorie-titre">Végétarien</h3>

            <div class="menu-list">

                <div class="menu-item">
                    <h4>Ramen shiitake</h4>
                    <p>Bouillon miso, tofu grillé, nouilles udon</p>
                    <span>28$</span>
                </div>

                <div class="menu-item">
                    <h4>Donburi tofu caramélisé</h4>
                    <p>Riz japonais, légumes sautés, sésame</p>
                    <span>32$</span>
                </div>

                <div class="menu-item">
                    <h4>Sushis végétariens (10 morceaux)</h4>
                    <p>Avocat, concombre, mangue, radis</p>
                    <span>30$</span>
                </div>

                <div class="menu-item">
                    <h4>Tempura de légumes</h4>
                    <p>Légumes racines, sauce tentsuyu</p>
                    <span>24$</span>
                </div>

                <div class="menu-item">
                    <h4>Gyoza aux légumes</h4>
                    <p>Sauce ponzu et gingembre</p>
                    <span>32$</span>
                </div>

            </div>
        </div>

    </main>

    <?php include 'components/footer.php'; ?>

    <script src="js/scripts.js"></script>

</body>

</html>