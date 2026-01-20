# TDL - Système de Gestion de parc Automobile

<img width="1891" height="887" alt="image" src="https://github.com/user-attachments/assets/16d9ad06-aa5a-4470-892d-023715485478" />

Application web permettant la gestion et la réservation de véhicules d’entreprise.
Ce projet a été réalisé dans le cadre d’un test pratique de recrutement afin de démontrer la capacité à concevoir une application web fonctionnelle, structurée et respectant des règles métier essentielles.

Contexte de l’application

Dans un environnement professionnel, la gestion des déplacements nécessite une organisation rigoureuse afin d’éviter les conflits d’utilisation des ressources.
Cette application vise à centraliser et automatiser la gestion du parc automobile de l’entreprise.

Objectifs principaux

Remplacer les processus manuels (Excel, emails) par une solution web.

Éviter les conflits de réservation grâce à des règles métier strictes.

Offrir une visibilité claire sur la disponibilité des véhicules.

Fournir un espace administrateur pour la gestion du parc automobile.

Choix techniques

Le projet repose sur une architecture MVC (Modèle – Vue – Contrôleur) sans framework, afin de garantir une bonne lisibilité du code et une maîtrise complète de la logique applicative.

Backend

Langage : PHP 7.4+ (natif)

Base de données : MySQL

Accès aux données : PDO (protection contre les injections SQL)

Architecture : MVC simplifié

Frontend

HTML5

Bootstrap 5 pour le responsive et les composants UI

CSS personnalisé

Font Awesome pour les icônes

Google Fonts (Inter)

Fonctionnalités spécifiques

Upload d’images pour les véhicules

Gestion des sessions pour l’authentification

Fonctionnalités principales
Espace Utilisateur

Consultation du catalogue des véhicules (photos, modèles, immatriculations)

Recherche par marque ou modèle

Réservation d’un véhicule sur une période donnée

Consultation de ses réservations (passées, en cours, à venir)

Gestion du profil utilisateur

Espace Administrateur

Ajout, modification et suppression des véhicules

Upload d’images des véhicules

Visualisation de toutes les réservations

Tableau de bord avec statistiques globales

Règles métier implémentées
Prévention des conflits de réservation

Avant la création d’une réservation, le système vérifie qu’aucune réservation existante pour le même véhicule ne chevauche la période demandée.

Une réservation est refusée si la condition suivante est vraie :

nouvelle_date_debut < date_fin_existante
ET
nouvelle_date_fin > date_debut_existante


Cette logique garantit l’intégrité des réservations et empêche toute double réservation.

Intégrité des données

Suppression en cascade des réservations associées à un utilisateur ou un véhicule supprimé.

Instructions de lancement
Prérequis

Serveur local (XAMPP, WAMP, MAMP ou serveur PHP)

PHP 7.4 ou supérieur

MySQL

Installation

Cloner ou copier le projet dans le dossier htdocs (XAMPP) ou équivalent.

Base de données

Créer une base nommée vehicle_reservation

Importer le fichier sql/setup.sql

Configuration
Modifier le fichier app/config/database.php si nécessaire :

$host = 'localhost';
$dbname = 'vehicle_reservation';
$username = 'root';
$password = '';


Lancement

php -S localhost:8000 -t public


Accès : http://localhost:8000

Comptes de test
Administrateur

Email : admin@example.com

Mot de passe : admin123

Utilisateur

Email : r@g.com

Mot de passe : 123456

Limites et améliorations possibles

Mise en place d’un système de rôles plus avancé

Validation côté client (JavaScript)

Notifications de réservation

API REST pour une future application mobile

© 2026 – TDL | Réalisé par Abdoul-Rachid BAWA (Rach_Code)
