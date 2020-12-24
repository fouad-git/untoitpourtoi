# Application de gestion Centre Accueil pour les personnes sans domicile fixe.

Dans le cadre de mon stage de fin formation de développeur web et web mobile, je dois développer une application de gestion pour un centre d'hébergement pour sans domicile fixe.
## Preview

[![SB Admin 2 Preview](https://startbootstrap.com/assets/img/screenshots/themes/sb-admin-2.png)](https://startbootstrap.github.io/startbootstrap-sb-admin-2/)

**Démo à venir**

## Technologie de développement
Voici quelques technologies de développement et leurs dépendances.
* Php natif POO (altorouter/phpMailer/)
* Twig
* SCSS
* Javascript

## Les besoins de l'application

QD Consulting a un client pour lequel il assure une mission de conseils dans le domaine des outils numériques.
Ce client assure l’accueil et le suivi de personnes en difficultés : hébergement, démarches administratives etc
Actuellement, le client utilise des process métiers manuels sous forme de fichier Excel et support papier.
Le but du stage est de créer une application de gestion des personnes accueillies et suivies.


### Les fonctionnalités de l'application

* L’application doit permettre de suivre les personnes.
* L’application doit permettre de suivre les nuitées
* L’application doit permettre de suivre les démarches
* L’application doit permettre de suivre le personnel. Chaque membre aura un accès nominatif. 
* L’application doit permettre de suivre les sites

## A propos de QDconsulting

QD Consulting est une société ligérienne crée en 2011 qui œuvre dans le domaine de la Business Intelligence, le BIG DATA et l’interopérabilité des systèmes.
Depuis bientôt 10 ans, nous accompagnons nos clients dans le cadre de l’urbanisation de leurs systèmes d’informations sur des projets tels que la mise en place d’ERP/CRM et de solutions d’aide à la décision.
QD Consulting est une TPE avec de nombreuses références dont certains grands groupes.



### Installation du projet en local
1. Installation de wampserver
    * WampServer est une plateforme de développement Web sous Windows qui permet de créer des applications Web dynamiques avec Apache2, PHP, MySQL et MariaDB.
    * Lien de téléchargement : `https://sourceforge.net/projects/wampserver/files/latest/download`
    * L'installation s'execute à la racine dans le `disque Local C` sous le nom `wamp64`, dans ce répértoire il y a un autre dossier qui s'apelle `www`qui accueil les répértoires de projet.
    * Créer un dossier dans le répértoire `www` pour cloner le projet.
    * ouvrir ce dossier avec VScode
2. Installation de Composer 
    * Composer est un outil de gestion des dépendances en PHP. Il permet de déclarer les bibliothèques dont dépend le projet et il les gérera (installera / mettra à jour) pour nous.
    * Le programme d'installation - qui nécessite que PHP soit déjà installé - téléchargera Composer pour nous et configurera votre variable d'environnement PATH afin que tu puisse simplement appeler  composer à partir de n'importe quel répertoire.
    * Voici le lien pour télécharger composer : `https://getcomposer.org/download/`
    * Une fois l'éxecutable de composer exécuter aller dans le terminal de vscode et vérifier qu'il est bien installer en faisant la commande suivante `composer -v` s'il est bien installer, il affiche la version de composer et quelques informations.
3. Installation du projet 
    * Le répertoire vide créer dans `www` et ouvert dans vscode
    * Créer la base de donnée avec `PHPmyadmin` et `mysql` grâce au fichier `DUMP.sql` situé dans le dossier `artefact`.
    * Ouvrir le terminal 
    * cloner le projet : `git clone https://qd-consulting.visualstudio.com/GestionCentre/_git/GestionCentre ./`
    * exécuter la commande suivante `composer update`.
    * créer un virtualhost en allant sur l'adresse suivante `http://localhost/add_vhost.php` sous le nom de gestioncentre.local

    * Pour l'afficher taper `http://gestioncentre.local/`