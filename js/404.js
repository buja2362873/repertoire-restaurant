/* ============================================================
   js/404.js — Effets additionnels page 404 cyberpunk
   ============================================================ */

(function () {
    'use strict';

    // --- Glitch aléatoire sur le titre ---
    const titre = document.querySelector('.erreur-titre .typed-text');
    if (titre) {
        const texteOriginal = titre.textContent;
        const chars = 'アイウエオカキクケコ#$%&@!?エラー404';
        let glitchTimer = null;

        function glitchTexte() {
            let iteration = 0;
            clearInterval(glitchTimer);
            glitchTimer = setInterval(() => {
                titre.textContent = texteOriginal
                    .split('')
                    .map((lettre, index) => {
                        if (index < iteration) return texteOriginal[index];
                        if (lettre === ' ') return ' ';
                        return chars[Math.floor(Math.random() * chars.length)];
                    })
                    .join('');
                if (iteration >= texteOriginal.length) {
                    clearInterval(glitchTimer);
                    titre.textContent = texteOriginal;
                }
                iteration += 1.5;
            }, 35);
        }

        // Lancer au chargement, puis toutes les 8 secondes
        setTimeout(glitchTexte, 1000);
        setInterval(glitchTexte, 8000);
    }

})();