<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## A propos 

**CarburantExpress** est un projet développé sur le temps d'une semaine de hackathon durant la deuxième année du BTS SIO. Il s'agit d'un prototype de site développé en Laravel qui permet, à partir des données ouvertes sur les prix des carburants en France, de trouver les stations-service les plus proches en fonction d'un emplacement / position géographique donnée et de comparer les prix des carburants pour trouver le moins cher.

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

- **PHP** 7.4+ (recommandé : PHP 8.0+)
- **Composer** pour la gestion des dépendances PHP.
- **Node.js** et **NPM** pour gérer les assets front-end.
- **MySQL** ou un autre SGBD pour la base de données (si nécessaire).
- **Laravel** (version spécifiée dans `composer.json`).

## Installation

- Clôner le repository Github.
- Effectuer l'installation de composer (composer install).
- Installer les dépendences nodes (npm install).
- Configurer le .env avec les informations de base de données (si fichier non présent).
- Générer la clé d'application (php key generate).
- Lancez le serveur de développement (php artisan serve).
- Lancez le serveur NPM de build (npm run dev).

## Outils 

- Laravel Breeze version 11 (avec PHP 8.4 - Structure MVC - Moteur de template Blade - Breeze - ORM Eloquent). 
- Tailwind CSS 
- Git/Github (outil de versionning)
- Base de données Mysql 

## Choix techniques 

Pour ce projet, j'ai décidé d'utiliser Laravel avec Breeze et Blade en tant que moteur de template non seulement pour pouvoir utiliser la librairie JS (Leaflet.js) et avoir une certaine cohérence des technologies mais aussi car Laravel, en tant que framework, facilite grandement le traitement des données en base de données, la gestion des vues et du MVC et offre directement un espace de connexion. Leaflet.JS permet de créer rapidement et de façon qualitative des cartes du monde.  

## License

[Auteur] Bryan Guerin (https://github.com/bguerin1).

# CarburantExpress
