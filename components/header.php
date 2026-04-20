<header class="hero">
    <span id="menu-toggle" class="material-symbols-outlined menu-icon">
        menu
    </span>

    <!-- seulement >=680px -->
    <video width="320" height="240" autoplay muted loop id="hero-video">
        <source src="assets/video/video_restaurant_optimise.mp4" type="video/mp4">
        Votre naviguateur ne supporte pas les vidéos HTML5.
    </video>

    <?php if ($showImg ?? false): ?>
    <!-- seulement <680px -->
    <img id="img--background" src="assets/images/png/header_image.jpg" alt="Arrière-plan" />
    <?php endif; ?>
</header>