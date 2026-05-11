<?php
require_once __DIR__ . '/../functions/db_loader.php';

// Get opening hours from database
$heures = getHeuresOuverture();
?>
<footer class="footer">

    <div class="footer-contenu">

        <div class="footer-image">
            <a href="index.php">
                <img src="assets/images/png/1_logo.png" alt="Restaurant">
            </a>
        </div>

        <div class="footer-ligne"></div>

        <div class="footer-heures">
            <h3>Heure d'ouverture</h3>

            <?php foreach ($heures as $heure): ?>
                <?php if ($heure['heure_ouverture'] === 'Fermé'): ?>
                    <p><strong><?php echo htmlspecialchars($heure['jour']); ?> :</strong> <?php echo htmlspecialchars($heure['heure_ouverture']); ?></p>
                <?php else: ?>
                    <p><strong><?php echo htmlspecialchars($heure['jour']); ?> :</strong> <?php echo htmlspecialchars($heure['heure_ouverture']); ?> – <?php echo htmlspecialchars($heure['heure_fermeture']); ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="footer-ligne"></div>

        <div class="footer-newsletter">

            <h3>Infolettre</h3>

            <div class="newsletter-form">
                <input type="email" placeholder="Adresse courriel">
                <button>OK</button>
            </div>

        </div>

        <div class="footer-bas">

            <p>© 2026 Hizakaya Hiroshi • Tous droits réservés</p>

            <p class="footer-liens">
                <a href="index.php">• Accueil</a>
                <a href="reservations.php">• Réservations</a>
                <a href="#">• Politique de confidentialité</a>
            </p>

        </div>

    </div>

</footer>