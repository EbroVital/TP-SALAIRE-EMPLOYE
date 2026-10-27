#  Application de Gestion des Salaires des Employés
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-terminé-vert?style=for-the-badge)

---
##  Description du projet
Cette application web développée avec Laravel permet à une entreprise de gérer efficacement les salaires de ses employés.
Elle offre un espace d’administration sécurisé qui permet de :
- Ajouter, modifier et supprimer des employés 
- Organiser les employés par département 
- Calculer automatiquement les salaires en fonction des données saisies 
- Générer et consulter les informations relatives à la paie
Ce projet a été conçu pour offrir une gestion simple, rapide et fiable des employés et de leurs rémunérations.
---

##  Fonctionnalités principales
- Authentification et espace administrateur sécurisé
- Gestion des employés (CRUD : Ajouter, Modifier, Supprimer, Consulter)
- Gestion des départements et affectation des employés
- Calcul automatique des salaires
- Interface intuitive et responsive

---
##  Technologies utilisées
- Langage backend : PHP 8.x
- Framework : Laravel 10
- Base de données : MySQL
- Frontend : Blade + Bootstrap
- Outils : Composer, Artisan, Git, GitHub

---

##  Installation et utilisation
### 1️⃣ Cloner le projet
```
git clone https://github.com/EbroVital/TP-SALAIRE-EMPLOYE.git
cd TP-SALAIRE-EMPLOYE
```
### 2️⃣ Installer les dépendances
```
composer install
npm install && npm run dev
```
### 3️⃣ Configurer l’environnement
creer un fichier .env et configurer votre base de données :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_salaire
DB_USERNAME=root
DB_PASSWORD=
```
### 4️⃣ Exécuter les migrations et seeders
```
php artisan migrate --seed
```
### 5️⃣ Lancer le serveur
```
php artisan serve
```
Accéder à l’application : http://127.0.0.1:8000

----

## Compte de test
Email : user@test.com
Password : password
