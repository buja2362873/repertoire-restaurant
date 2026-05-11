<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$showImg = false;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OUPS</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/404.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Share+Tech+Mono&display=swap" rel="stylesheet">
</head>

<body class="page-404-body">

    <?php include 'components/menu.php'; ?>

    <main class="page-404" aria-label="Erreur 404">

        <div class="scanlines" aria-hidden="true"></div>

        <div class="erreur-container">

            <div class="erreur-code" aria-label="Erreur 404">
                <span class="glitch" data-text="404">404</span>
            </div>

            <h1 class="erreur-titre">
                <span class="typed-text">Connexion à la page impossible.</span>
            </h1>

            <div class="terminal-box" role="log" aria-label="Console système">

                <p class="terminal-line">
                    <span class="prompt">system@hiroshi:~$</span>
                    accès page demandée
                </p>

                <p class="terminal-line delay-1">
                    <span class="output">[INFO]</span>
                    Analyse des routes réseau...
                </p>

                <p class="terminal-line delay-2">
                    <span class="output">[INFO]</span>
                    Recherche dans les archives du serveur...
                </p>

                <p class="terminal-line delay-3">
                    <span class="output">[AVERTISSEMENT]</span>
                    Paquet de données introuvable.
                </p>

                <p class="terminal-line delay-4">
                    <span class="output">[ERREUR]</span>
                    La ressource demandée n'existe pas ou a été déplacée.
                </p>

                <p class="terminal-line delay-5">
                    <span class="prompt">system@hiroshi:~$</span>
                    statut --page
                </p>

                <p class="terminal-line delay-6">
                    <span class="output neon-text">
                        CODE : 404_NOT_FOUND
                    </span>
                </p>

                <p class="terminal-line delay-7">
                    <span class="prompt">system@hiroshi:~$</span>
                    _
                </p>

            </div>

            <blockquote class="haiku">
                <p>Signal interrompu.</p>
                <p>Les néons s'éteignent.</p>
                <p>Aucune trace trouvée.</p>
                <footer>— Terminal central</footer>
            </blockquote>

            <div class="btn-group">
                <a href="index.php" class="btn-retour">
                    <span class="btn-icon">⌂</span>
                    Retour à l'accueil
                </a>
            </div>

        </div>

        <div class="deco-side" aria-hidden="true">
            <div class="neon-kanji">
                <span>迷</span>
                <span>子</span>
                <span>の</span>
                <span>道</span>
            </div>
        </div>

    </main>

    <script src="js/scripts.js"></script>
    <script src="js/404.js"></script>

</body>

</html>