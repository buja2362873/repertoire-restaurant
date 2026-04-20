<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$showImg = false;
?>

<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=360, initial-scale=1.0">
    <title>Desserts - Izakaya Hiroshi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>

    <?php include 'components/menu.php'; ?>

    <?php include 'components/header.php'; ?>

    <main class="menu-section">

        <h2>Desserts</h2>

        <div class="menu-categorie">
            <h3 class="categorie-titre">Nos douceurs japonaises</h3>

            <div class="menu-list">

                <div class="menu-item">
                    <h4>Mochis glacés assortis</h4>
                    <p>Matcha, mangue, sésame noir</p>
                    <span>12$</span>
                </div>

                <div class="menu-item">
                    <h4>Dorayaki au haricot rouge</h4>
                    <p>Pancakes japonais, pâte de haricot azuki</p>
                    <span>10$</span>
                </div>

                <div class="menu-item">
                    <h4>Cheesecake au yuzu</h4>
                    <p>Crémeux et acidulé, coulis de fruits rouges</p>
                    <span>12$</span>
                </div>

                <div class="menu-item">
                    <h4>Gâteau matcha & chocolat blanc</h4>
                    <p>Fondant, sauce caramel miso</p>
                    <span>12$</span>
                </div>

                <div class="menu-item">
                    <h4>Glace artisanale au sésame noir</h4>
                    <p>Crémeuse et légèrement sucrée</p>
                    <span>10$</span>
                </div>

                <div class="menu-item">
                    <h4>Taiyaki à la crème pâtissière</h4>
                    <p>Gaufre japonaise en forme de poisson</p>
                    <span>10$</span>
                </div>

            </div>
        </div>

    </main>

    <?php include 'components/footer.php'; ?>

    <script src="js/scripts.js"></script>

</body>

</html>