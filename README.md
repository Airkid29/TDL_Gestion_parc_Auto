# TDL - Système de Gestion de parc Automobile

Application web moderne permettant la gestion et la réservation de véhicules d'entreprise. Conçue pour simplifier les déplacements professionnels grâce à une interface intuitive et un système de réservation robuste.


# Contexte de l'application
Dans un environnement professionnel dynamique, la mobilité des collaborateurs est essentielle. Ce projet répond au besoin de centraliser et d'automatiser la gestion du parc automobile de l'entreprise.

**Objectifs principaux :**
- Remplacer les processus manuels (Excel, emails) par une solution digitale.
- Éviter les conflits de réservation grâce à des règles métier strictes.
- Offrir une visibilité en temps réel sur la disponibilité des véhicules.
- Fournir un outil d'administration pour gérer la flotte (ajout, modification, suppression).

---

## Choix Techniques

Le projet repose sur une architecture **MVC (Modèle-Vue-Contrôleur)** sans framework lourd, garantissant performance et maîtrise du code.

### Backend
- **Langage** : PHP 7.4 ou plus (Natif)
- **Base de données** : MySQL
- **Accès aux données** : PDO (PHP Data Objects) pour une sécurité accrue contre les injections SQL.
- **Architecture** : MVC pur pour séparer la logique métier, l'accès aux données et l'affichage.

### Frontend
- **Structure** : HTML5
- **Styles** : 
  - **Bootstrap 5** pour la grille et les composants réactifs.
  - **CSS Custom** (`assets/css/styles.css`)
- **Police** : 'Inter' via Google Fonts
- **Icônes** : Font Awesome

### Fonctionnalités Spécifiques
- **Upload d'images** : Gestion native des fichiers pour illustrer le catalogue de véhicules.

## Principales Fonctionnalités

### Espace Utilisateur
- **Catalogue Visuel** : Consultation des véhicules avec photos, modèles et immatriculations.
- **Recherche** : Filtrage des véhicules par marque ou modèle.
- **Réservation Facile** : Formulaire simple avec sélection de dates.
- **Mes Réservations** : Suivi des réservations passées, en cours et à venir, avec classification par statut couleur.
- **Profil** : Gestion des informations personnelles.

### Espace Administrateur
- **Gestion du Parc** : 
  - Ajout de nouveaux véhicules avec **upload de photos**.
  - Modification et suppression de véhicules existants.
- **Vue d'ensemble** : Tableau de bord avec statistiques clés (nombre d'utilisateurs, réservations actives).
- **Contrôle des Réservations** : Liste complète de toutes les réservations de l'entreprise.

### Règles Métier
- **Anti-Conflit** : Une vérification stricte empêche la réservation d'un véhicule déjà réservé sur la période demandée.
- **Intégrité** : Suppression en cascade des réservations si un véhicule ou un utilisateur est supprimé.

---

## Instructions de Lancement

### Prérequis
- Vous devez disposer d'un serveur web local (XAMPP, WAMP, MAMP ou PHP built-in server).
- PHP 7.4 ou supérieur activé.
- MySQL comme base de données.

### Installation Pas à Pas

1.  **Récupérer le projet**
    Placez les fichiers dans le répertoire racine de votre serveur (ex: `htdocs` pour XAMPP) ou dans un dossier dédié.

2.  **Base de Données**
    - Ouvrez votre gestionnaire de base de données (ex: phpMyAdmin).
    - Créez une nouvelle base de données nommée `vehicle_reservation`.
    - Importez le fichier `sql/setup.sql`.

3.  **Configuration**
    - Ouvrez le fichier `app/config/database.php`.
    - Vérifiez vos identifiants (par défaut `root` sans mot de passe sur XAMPP). A mettre a jour si nécessaire :
      ```php
      $host = 'localhost';
      $dbname = 'vehicle_reservation';
      $username = 'root';
      $password = '';
      ```

4.  **Lancement Rapide (CLI)**
    Si vous avez PHP installé en ligne de commande, vous pouvez lancer un serveur temporaire :
    ```bash
    cd c:\xampp\htdocs\TDL
    php -S localhost:8000 -t public
    ```
    Accédez ensuite à : `http://localhost:8000/`

    *Sinon, via XAMPP : `http://localhost/TDL/public/`*

### Identifiants par défaut
- **Administrateur**
  - Email : `admin@example.com`
  - Mot de passe : `admin123`
- **Utilisateur Test**
  - Email : `r@g.com`
  - Mot de passe : `123456`



© 2026 TDL3 - By Rach_Code.