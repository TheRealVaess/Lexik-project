# Lexik-project

Project for Lexik

Il s’agit de l’exercice de pré-entretien pour l’entreprise Lexik.

<h3>Installation du projet :</h3>

Premièrement, il est nécessaire que WAMP et Composer soient installés sur votre ordinateur.

Lien WAMP : http://www.wampserver.com/

Lien Composer : https://getcomposer.org/

1) Il faudra exécuter une console Windows (cmd.exe) et se rendre dans le répertoire de WAMP puis dans www (cd C:/wamp64/www).

2) Installez ensuite le squelette de projet Symfony avec la commande : composer create-project symfony/website-skeleton lexik-project (ici, lexik-project est le nom du projet).

3) Il faut ensuite cloner le dépôt du projet qui se trouve sur Github (https://github.com/Veisseyre/Lexik-project) dans le répertoire du projet.

4) A nouveau avec une console Windows (cmd.exe), il faut se rendre dans le répertoire du projet (cd C:/wamp64/www/lexik-project), et exécuter cette commande : composer install
Cette commande installe toutes les dépendances nécessaires.

5) A la racine du projet, dans le fichier « .env », il faut modifier la ligne « DATABASE_URL » et lui donner la valeur « sqlite:///%kernel.project_dir%/data.db ».

Le projet est maintenant installé.

<h3>Charger les fixtures :</h3>

Afin de charger des objets dans la base de données, il faut charger des fixtures. Un ensemble de 20 objets sera ajouté avec la commande suivante à rentrer dans une console Windows (dans le répertoire du projet) : php bin/console doctrine:fixtures:load

<h3>Lancer le projet :</h3>

Après avoir exécuté WAMP, le projet est accessible depuis l’URL suivante : http://localhost/lexik-exo/public/index.php/fr/products

<h3>Jouer les tests :</h3>

Les tests unitaires et fonctionnels peuvent être lancés depuis une console Windows (dans le répertoire du projet) avec la commande suivante : php bin/phpunit

<h3>Panneau d'administration</h3>

Le panneau d'administration est accessible par cette URL : http://localhost/lexik-exo/public/index.php/admin
Pour y accéder, il faut se connecté avec le nom "admin" et le mot de passe "password".