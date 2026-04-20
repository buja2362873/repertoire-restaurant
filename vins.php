<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$showImg = false;
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

        <!-- SAKÉ & SHOCHU -->
        <div class="menu-categorie">
            <h3 class="categorie-titre">Saké et Shochu</h3>

            <div class="menu-list">

                <div class="menu-item">
                    <h4>Dassai 23 Junmai Daiginjo</h4>
                    <p>Japon</p>
                    <span>140 $</span>
                </div>

                <div class="menu-item">
                    <h4>Hakkaisan Tokubetsu Junmai</h4>
                    <p>Japon</p>
                    <span>95 $</span>
                </div>

                <div class="menu-item">
                    <h4>Born Gold Junmai Daiginjo</h4>
                    <p>Japon</p>
                    <span>125 $</span>
                </div>

                <div class="menu-item">
                    <h4>Taketsuru Shochu 25 ans</h4>
                    <p>Japon</p>
                    <span>320 $</span>
                </div>

                <div class="menu-item">
                    <h4>Iichiko Barley Shochu</h4>
                    <p>Japon</p>
                    <span>85 $</span>
                </div>

            </div>
        </div>

        <!-- VIN BLANC -->
        <div class="menu-categorie">
            <h3 class="categorie-titre">Vin blanc</h3>

            <div class="menu-list">

                <div class="menu-item">
                    <h4>Domaine Ostertag, Gewurztraminer Fronholz 2020</h4>
                    <p>Alsace</p>
                    <span>92 $</span>
                </div>

                <div class="menu-item">
                    <h4>Château Ste. Michelle, Eroica Riesling 2021</h4>
                    <p>États-Unis</p>
                    <span>78 $</span>
                </div>

                <div class="menu-item">
                    <h4>Domaine des Terres Dorées, Beaujolais Blanc 2020</h4>
                    <p>France</p>
                    <span>66 $</span>
                </div>

                <div class="menu-item">
                    <h4>Pazo Señorans, Albariño 2021</h4>
                    <p>Espagne</p>
                    <span>70 $</span>
                </div>

                <div class="menu-item">
                    <h4>Weingut Knoll, Grüner Veltliner 2021</h4>
                    <p>Autriche</p>
                    <span>88 $</span>
                </div>

            </div>
        </div>

        <!-- VIN ROUGE -->
        <div class="menu-categorie">
            <h3 class="categorie-titre">Vin rouge</h3>

            <div class="menu-list">

                <div class="menu-item">
                    <h4>Domaine Jean Foillard, Morgon 2021</h4>
                    <p>France</p>
                    <span>85 $</span>
                </div>

                <div class="menu-item">
                    <h4>Château Musar, Gaston Hochar 2016</h4>
                    <p>Liban</p>
                    <span>110 $</span>
                </div>

                <div class="menu-item">
                    <h4>Radikon, Slatnik 2019</h4>
                    <p>Italie</p>
                    <span>140 $</span>
                </div>

                <div class="menu-item">
                    <h4>Yohan Lardy, Moulin-à-Vent 2021</h4>
                    <p>Beaujolais</p>
                    <span>70 $</span>
                </div>

                <div class="menu-item">
                    <h4>Domaine de la Tournelle, Uva Arbosiana</h4>
                    <p>France</p>
                    <span>92 $</span>
                </div>

            </div>
        </div>

        <!-- BIÈRES & SAKÉ PÉTILLANT -->
        <div class="menu-categorie">
            <h3 class="categorie-titre">Bières & Saké pétillant</h3>

            <div class="menu-list">

                <div class="menu-item">
                    <h4>Hitachino Nest White Ale</h4>
                    <p>Japon</p>
                    <span>18 $</span>
                </div>

                <div class="menu-item">
                    <h4>Sapporo Premium Reserve</h4>
                    <p>Japon</p>
                    <span>14 $</span>
                </div>

                <div class="menu-item">
                    <h4>Kikusui Funaguchi Nama Genshu</h4>
                    <p>Saké pétillant, Japon</p>
                    <span>55 $</span>
                </div>

                <div class="menu-item">
                    <h4>Asahi Super Dry Black</h4>
                    <p>Japon</p>
                    <span>16 $</span>
                </div>

                <div class="menu-item">
                    <h4>Gekkeikan Sparkling Saké Zipang</h4>
                    <p>Japon</p>
                    <span>45 $</span>
                </div>

            </div>
        </div>

    </main>

    <?php include 'components/footer.php'; ?>

    <script src="js/scripts.js"></script>

</body>

</html>