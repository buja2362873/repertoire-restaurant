<?php include 'components/nav_items.php'; ?>

<nav id="nav--primary" class="nav-menu">
    <span id="nav-close" class="material-symbols-outlined nav-close">close</span>
    <ul>
        <?php foreach ($itemsNav as $urlLien => $nomLien) : ?>
            <li><a href="<?= $urlLien ?>" class="<?= ($currentPage === $urlLien) ? 'active' : '' ?>"><?= $nomLien ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>