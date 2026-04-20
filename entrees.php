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
                <img src="assets/images/jpg/1_edamame.jpg" alt="Edamame au sel de mer fumé">
                <div class="menu-content">
                    <h3>Edamame au sel de mer fumé</h3>
                    <p>Fèves de soja vapeur, sel fumé et zeste de yuzu</p>
                    <span>10$</span>
                </div>
            </div>

            <div class="menu-item">
                <img src="assets/images/jpg/2_tataki_thon_rouge.jpg" alt="Tataki de thon rouge">
                <div class="menu-content">
                    <h3>Tataki de thon rouge</h3>
                    <p>Thon saisi, sauce ponzu, gingembre mariné</p>
                    <span>16$</span>
                </div>
            </div>

            <div class="menu-item">
                <img src="assets/images/jpg/3_gyoza_porc_crevettes.jpg" alt="Gyoza de porc et crevettes">
                <div class="menu-content">
                    <h3>Gyoza de porc et crevettes</h3>
                    <p>Raviolis grillés, sauce miso épicée</p>
                    <span>14$</span>
                </div>
            </div>

            <div class="menu-item">
                <img src="assets/images/jpg/4_salade_wakame.jpg" alt="Salade wakame et sésame noir">
                <div class="menu-content">
                    <h3>Salade wakame et sésame noir</h3>
                    <p>Algues marinées, vinaigrette soja-sésame</p>
                    <span>15$</span>
                </div>
            </div>

            <div class="menu-item">
                <img src="assets/images/jpg/5_soupe_miso.jpg" alt="Soupe miso traditionnelle">
                <div class="menu-content">
                    <h3>Soupe miso traditionnelle</h3>
                    <p>Bouillon miso, tofu, algues wakame, oignons verts</p>
                    <span>8$</span>
                </div>
            </div>

            <div class="menu-item">
                <img src="assets/images/jpg/6_tempura_crevettes.jpg" alt="Tempura de crevettes">
                <div class="menu-content">
                    <h3>Tempura de crevettes</h3>
                    <p>Pâte croustillante, sauce tentsuyu</p>
                    <span>14$</span>
                </div>
            </div>

            <div class="menu-item">
                <img src="assets/images/jpg/7_tartare_saumon.jpg" alt="Tartare de saumon façon japonaise">
                <div class="menu-content">
                    <h3>Tartare de saumon façon japonaise</h3>
                    <p>Saumon, huile de sésame, shiso, tobiko</p>
                    <span>18$</span>
                </div>
            </div>

            <div class="menu-item">
                <img src="assets/images/jpg/8_yakitori_poulet.jpg" alt="Yakitori de poulet">
                <div class="menu-content">
                    <h3>Yakitori de poulet</h3>
                    <p>Brochettes de poulet laqué, sauce tare maison</p>
                    <span>16$</span>
                </div>
            </div>

        </div>

    </main>

    <?php include 'components/footer.php'; ?>

    <script src="js/scripts.js"></script>

</body>

</html>