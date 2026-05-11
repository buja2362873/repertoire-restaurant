(function () {
    'use strict';

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

                        if (index < iteration) {
                            return texteOriginal[index];
                        }

                        if (lettre === ' ') {
                            return ' ';
                        }

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

        setTimeout(glitchTexte, 1000);
        setInterval(glitchTexte, 8000);
    }

    const terminal = document.querySelector('.terminal-box');
    const haiku = document.querySelector('.haiku');

    if (!terminal) return;

    if (haiku) {
        haiku.style.opacity = '0';
        haiku.style.transform = 'translateY(20px)';
        haiku.style.transition = 'all 1s ease';
    }

    terminal.innerHTML = '';

    const lignes = [
        'system@hiroshi:~$ accès page demandée',
        '[INFO] Analyse des routes réseau...',
        '[INFO] Recherche dans les archives du serveur...',
        '[AVERTISSEMENT] Paquet de données introuvable.',
        '[ERREUR] La ressource demandée n\'existe pas.',
        'system@hiroshi:~$ statut --page',
        'CODE : 404_NOT_FOUND',
        'system@hiroshi:~$ _'
    ];

    let ligneIndex = 0;

    // Écriture caractère par caractère
    function ecrireLigne(texte, callback) {

        const ligne = document.createElement('p');
        ligne.classList.add('terminal-line');

        terminal.appendChild(ligne);

        let caractere = 0;

        const interval = setInterval(() => {

            ligne.textContent += texte.charAt(caractere);

            caractere++;

            // Scroll automatique
            terminal.scrollTop = terminal.scrollHeight;

            if (caractere >= texte.length) {

                clearInterval(interval);

                if (callback) {
                    setTimeout(callback, 400);
                }
            }

        }, 28);
    }

    // Lance les lignes une par une
    function lancerConsole() {

        if (ligneIndex < lignes.length) {

            ecrireLigne(lignes[ligneIndex], () => {

                ligneIndex++;
                lancerConsole();

            });

        } else {

            // Animation de la citation après la console
            if (haiku) {

                setTimeout(() => {

                    haiku.style.opacity = '1';
                    haiku.style.transform = 'translateY(0)';

                }, 600);

            }

        }
    }

    // Démarrage
    setTimeout(lancerConsole, 1200);

})();