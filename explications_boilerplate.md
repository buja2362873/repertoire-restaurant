# Explications du boilerplate

## OBJECTIFS DE L'EXERCICE
- Comprendre le rôle d'un boilerplate en développement
- Comprendre sa structure
- Se repérer facilement dans la structure dans un éventuel développement d'un projet

## LE BOILERPLATE
Un `boilerplate`, c'est comme une base toute prête pour démarrer un projet sans repartir de zéro à chaque fois. Il contient déjà les fichiers, le code et la structure nécessaires pour éviter de perdre du temps sur les réglages de base.

Imagine que tu veux construire une maison : au lieu de poser chaque brique une par une, tu commences avec une structure déjà montée où tu n'as plus qu'à ajouter les finitions selon tes besoins. 

En développement, un `boilerplate` fait la même chose en fournissant un cadre de travail avec les configurations essentielles, ce qui permet de se concentrer directement sur le développement du projet.

## LA STRUCTURE
Pour garantir une organisation efficace et une maintenance simplifiée du projet, la structure des fichiers sera conçue de manière logique et modulaire. Cette approche permet de séparer clairement les ressources, les styles, les scripts et les composants afin de faciliter le développement, la collaboration et l'évolutivité du projet. En structurant le projet de façon méthodique, il devient plus simple de retrouver et de modifier des éléments spécifiques sans impacter l'ensemble du code.

L'architecture repose sur plusieurs dossiers distincts : 
- **assets** -> les médias et typos
- **components** -> les fichiers php des composants de l'interface
- **css** -> les fichiers css des composants de l'interface
- **js** -> les scripts Javascript nécessaires au bon fonctionnement du site
- **pages** -> les différentes pages nécessaire

En utilisant l'extension de VS Code `vscode-icons`, les icones de l'explorateur s'adapte aux noms des dossiers afin d'y ajouter l'icône associés. 

## LE DOSSIER ASSETS
Le dossier _assets regroupe toutes les ressources essentielles au bon fonctionnement et à l'apparence du projet. Il contient les fichiers statiques nécessaires, comme les images, les icônes, les polices, les vidéos et autres éléments multimédias. En centralisant ces ressources dans un seul emplacement, il devient plus facile de les organiser et de les réutiliser à travers le projet sans duplication inutile.

Pour une meilleure gestion, ce dossier peut être subdivisé en sous-dossiers selon le type de contenu, par exemple :
- **images** -> pour les illustrations, photos et icônes
- **fonts** -> pour les polices personnalisées utilisées dans le projet
- **video** -> pour les fichiers multimédias intégrés

>Note : Dans le dossier svg, une image est disponible en tant que placeholder en attendant la réception des médias officiels du projet. Elle vous permet de commencer le développement sans avoir à attendre les fichiers définitifs.

## LE DOSSIER COMPONENTS
Le dossier components regroupe les fichiers PHP des différents éléments réutilisables du projet. Il permet de structurer le code en fragments modulaires, facilitant ainsi la maintenance et la réutilisation des composants dans plusieurs pages. Pour le cours, ce dossier contiendra notamment les éléments d'interface comme les en-têtes, les pieds de page, les cartes ou encore les boutons, assurant une meilleure organisation et une séparation claire entre la logique et la mise en page.

## LE DOSSIER CSS
Le dossier css contient l'ensemble des styles du projet, organisé de manière modulaire pour assurer une meilleure lisibilité et maintenance du code. Il est structuré en trois sous-dossiers :

- base : regroupe les styles fondamentaux tels que le fichier de reset, la définition des typographies et les variables globales utilisées dans le projet.
- composants : inclut les styles des éléments réutilisables, ainsi que ceux issus d'une décomposition de l'interface, permettant une cohérence visuelle à travers le site.
- layout : gère la mise en page globale et les structures spécifiques basées sur une grille, garantissant une organisation harmonieuse et adaptable sur différentes résolutions d'écran.

Cette structure facilite l'évolution du projet et permet une gestion efficace des styles en fonction des besoins.

## LE DOSSIER JS
Le dossier js contient l'ensemble des fichiers JavaScript nécessaires au bon fonctionnement du site. Il est structuré de manière à garantir une gestion claire et évolutive du code. 

On y trouve les scripts principaux qui gèrent l'interactivité du site, ainsi que les fonctions spécifiques aux fonctionnalités de la page. Ce dossier peut être divisé en sous-dossiers pour mieux organiser le code, par exemple, en séparant les modules par fonctionnalité ou par page spécifique (par exemple, header.js, footer.js, formulaire.js).

L'objectif de cette structure est de maintenir le code modulaire, réutilisable et facile à maintenir.

## LES PAGES
Les pages resteront à la racine du dossier du boilerplate afin de faciliter l'accès lorsque viendra le moment de créer le composant de navigation. Cette approche permet de standardiser l'accès aux pages en utilisant une référence unique : la racine du dossier. Cela simplifie la gestion des liens internes et assure une cohérence dans la structure du projet, notamment lors de l'intégration de la navigation. En maintenant cette organisation, nous optimisons la flexibilité et la clarté du projet à mesure qu'il évolue.

## NETTOYAGE DU DOSSIER
Il est essentiel de ne laisser aucun dossier vide dans la structure du projet. Si un dossier n'est pas applicable ou n'est pas utilisé dans le développement, il doit être supprimé. L'objectif est de maintenir une organisation claire et efficace, sans surplus inutile. Une structure de fichiers propre facilite la gestion du projet, améliore sa lisibilité et permet une meilleure collaboration entre les développeurs.