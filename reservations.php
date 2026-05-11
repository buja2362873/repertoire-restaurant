<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$showImg = false;

require_once 'functions/db_loader.php';

$message = '';
$messageType = '';

// Traiter le formulaire de réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Valider les données
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $time = trim($_POST['time'] ?? '');
        $guests = intval($_POST['guests'] ?? 0);

        // Validation basique
        if (empty($name) || empty($email) || empty($phone) || empty($time) || $guests < 1) {
            throw new Exception('Veuillez remplir tous les champs requis.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Veuillez entrer une adresse email valide.');
        }

        if ($guests > 20) {
            throw new Exception('Le nombre de personnes ne peut pas dépasser 20. Veuillez nous contacter directement pour les grands groupes.');
        }

        // Insérer la réservation
        global $pdo;
        $stmt = $pdo->prepare("
            INSERT INTO reservations (name, email, phone, time, guests)
            VALUES (?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $name,
            $email,
            $phone,
            $time,
            $guests
        ]);

        $message = 'Réservation confirmée ! Nous vous enverrons un email de confirmation dans les prochaines heures.';
        $messageType = 'success';

        // Réinitialiser le formulaire
        $_POST = [];

    } catch (Exception $e) {
        $message = 'Erreur : ' . $e->getMessage();
        $messageType = 'error';
    }
}

?>

<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=360, initial-scale=1.0">
    <title>Réservations - Izakaya Hiroshi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/composants/reservations.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>

    <?php include 'components/menu.php'; ?>

    <?php include 'components/header.php'; ?>

    <main class="reservations-section">
        <div class="reservations-container">
            <h2>Réservation</h2>
            <p class="reservations-subtitle">Réservez votre table à l'Izakaya Hiroshi</p>

            <?php if ($message): ?>
                <div class="reservation-message reservation-message--<?php echo htmlspecialchars($messageType); ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="reservation-form">
                <div class="form-group">
                    <label for="name">Nom complet *</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        required
                        value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                        placeholder="Votre nom"
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required
                        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                        placeholder="votre@email.com"
                    >
                </div>

                <div class="form-group">
                    <label for="phone">Téléphone *</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        required
                        value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                        placeholder="(450) 438-3439"
                    >
                </div>

                <div class="form-group">
                    <label for="time">Date et heure *</label>
                    <input 
                        type="datetime-local" 
                        id="time" 
                        name="time" 
                        required
                        value="<?php echo htmlspecialchars($_POST['time'] ?? ''); ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="guests">Nombre de personnes *</label>
                    <select id="guests" name="guests" required>
                        <option value="">-- Sélectionner --</option>
                        <?php for ($i = 1; $i <= 20; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo (isset($_POST['guests']) && $_POST['guests'] == $i) ? 'selected' : ''; ?>>
                                <?php echo $i . ($i === 1 ? ' personne' : ' personnes'); ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <button type="submit" class="btn-reservation">Réserver une table</button>
            </form>

            <div class="reservation-info">
                <h3>Informations importantes</h3>
                <ul>
                    <li>Les réservations doivent être effectuées au moins 24 heures à l'avance</li>
                    <li>Un email de confirmation vous sera envoyé après votre réservation</li>
                    <li>Pour les groupes de plus de 20 personnes, veuillez nous contacter directement</li>
                    <li>Téléphone : <a href="tel:+14504383439">(450) 438-3439</a></li>
                </ul>
            </div>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>

    <script src="js/scripts.js"></script>

</body>

</html>
