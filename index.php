<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$showImg = true;
?>

<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=360, initial-scale=1.0">
    <title>Restaurant Japonais</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>
    <?php include 'components/menu.php'; ?>

    <?php include 'components/header.php'; ?>

    <?php include 'components/specialites.php'; ?>

    <?php include 'components/presentation.php'; ?>

    <?php include 'components/suivez.php'; ?>

    <?php include 'components/promo.php'; ?>

    <?php include 'components/contact.php'; ?>

    <?php include 'components/footer.php'; ?>

    <script src="js/scripts.js"></script>

</body>

</html>