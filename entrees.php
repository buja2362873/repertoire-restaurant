<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$showImg = false;
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

            <div class="menu-item">
                <h3>Edamame au sel de mer fumé</h3>
                <p>Fèves de soja vapeur, sel fumé et zeste de yuzu</p>
                <span>10$</span>
            </div>

            <div class="menu-item">
                <h3>Tataki de thon rouge</h3>
                <p>Thon saisi, sauce ponzu, gingembre mariné</p>
                <span>16$</span>
            </div>

            <div class="menu-item">
                <h3>Gyoza de porc et crevettes</h3>
                <p>Raviolis grillés, sauce miso épicée</p>
                <span>14$</span>
            </div>

            <div class="menu-item">
                <h3>Salade wakame et sésame noir</h3>
                <p>Algues marinées, vinaigrette soja-sésame</p>
                <span>15$</span>
            </div>

            <div class="menu-item">
                <h3>Soupe miso traditionnelle</h3>
                <p>Bouillon miso, tofu, algues wakame, oignons verts</p>
                <span>8$</span>
            </div>

            <div class="menu-item">
                <h3>Tempura de crevettes</h3>
                <p>Pâte croustillante, sauce tentsuyu</p>
                <span>14$</span>
            </div>

            <div class="menu-item">
                <h3>Tartare de saumon façon japonaise</h3>
                <p>Saumon, huile de sésame, shiso, tobiko</p>
                <span>18$</span>
            </div>

            <div class="menu-item">
                <h3>Yakitori de poulet</h3>
                <p>Brochettes de poulet laqué, sauce tare maison</p>
                <span>16$</span>
            </div>

        </div>

    </main>

    <?php include 'components/footer.php'; ?>

    <script src="js/scripts.js"></script>

</body>

</html>