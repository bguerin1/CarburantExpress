<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## A propos 

**CarburantExpress** est un projet conçu en une semaine lors d'un hackathon durant la deuxième année de BTS SIO. Ce prototype, développé avec Laravel, exploite les données ouvertes sur les prix des carburants en France. Il permet aux utilisateurs de localiser les stations-service les plus proches selon une position géographique donnée et de comparer les prix des carburants afin de trouver les meilleures offres.

## Fonctionnalités

Côté Stations-service :

- Affichage des stations-service sur une carte (Utilisation de Leaflet.js).
- Affichage d'une version liste des stations-service avec les prix.
- Filtrage des stations-service par type de carburant.
- Filtrage des stations-service par prix.

Côté Utilisateurs :

- Inscription.
- Connexion avec interface utilisateur.
- Gestion des préférences (Type de carburant utilisé, marque préférée, position géographique).

## Prérequis

Avant de commencer, assurez-vous d'avoir installé et configuré les éléments suivants :

- **PHP** 8.3+ (recommandé : PHP 8.4+)
- **Composer** pour la gestion des dépendances PHP.
- **Node.js** et **NPM** pour gérer les assets front-end.
- **MySQL** pour la base de données.
- **Laravel** (version 11).

## Installation

- Cloner le repository Github.
- Effectuer l'installation de composer (composer install).
- Installer les dépendences nodes (npm install).
- Configurer le .env avec les informations de base de données (si fichier non présent).
- Générer la clé d'application (php key generate).
- Lancez le serveur de développement (php artisan serve).
- Lancez le serveur NPM de build (npm run dev).

## Outils 

- Laravel Breeze version 11 (avec PHP 8.4 - Structure MVC - Moteur de template Blade - Breeze - ORM Eloquent). 
- Tailwind CSS. 
- Git/Github (outil de versionning).
- Base de données Mysql.
- API : 
    Data.gouv (Api tabular) : https://www.data.gouv.fr/fr/datasets/prix-des-carburants-en-france-flux-quotidien-1/ (Utilisé au début du projet), documentation : https://www.data.gouv.fr/fr/dataservices/api-tabulaire-data-gouv-fr-beta/ 
    OpenDataSoft : https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-des-carburants-en-france-flux-instantane-v2/records, documentation : https://help.opendatasoft.com/apis/ods-explore-v2/#section/Introduction
- IA : ChatGPT (utilisation principale pour le visuel et la compréhension de comment requêter une API).
- Leaflet.JS ainsi que sa documentation.

## Choix techniques 

Pour ce projet, j'ai décidé d'utiliser Laravel avec Breeze et Blade en tant que moteur de template non seulement pour pouvoir utiliser la librairie JS (Leaflet.js) et avoir une certaine cohérence des technologies mais aussi car Laravel, en tant que framework, facilite grandement le traitement des données en base de données, la gestion des vues et du MVC et offre directement un espace de connexion. Leaflet.JS permet de créer rapidement et de façon qualitative des cartes du monde.  

N'étant pas le plus à l'aise à l'idée d'utiliser uniquement du Javascript pour gérer les requêtes à l'API et voulant en plus de cela séparer correctement les différentes parties du code en MVC, j'ai traité la partie API en php dans un Controller dédié.


## Améliorations 

Par manque de temps (celui-ci étant restreint) et en raison du changement soudain d'API le dernier jour du hackathon, les fonctionnalités suivantes pourraient être ajoutées / subir des modifications / être améliorées : 

- Utilisation de la géolocalisation dès l'arrivée de l'utilisateur sur le site à des fins de trouver directement les stations les plus proches sans recherche.
- Ajout de la pagination (le nombre de stations est limité à 10 par pages et 10 marqueurs maximums actuellement).
- Utilisation d'AJAX pour intégrer progressivement les stations de l'API en naviguant sur la map.
- Utilisation d'une API pour autocompléter les inputs pour renseigner sa position géographique (ville).
- Cliquez sur la carte pour ajouter un marqueur et obtenir en direct les stations les plus proches.
- La gestion des marques des stations n'a pas été possible car celles-ci ne sont pas renseignées dans l'API. 


## License

[Auteur] Bryan Guerin (https://github.com/bguerin1).

# CarburantExpress
