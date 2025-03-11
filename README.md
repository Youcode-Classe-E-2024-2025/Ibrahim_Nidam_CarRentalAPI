# Ibrahim_Nidam_CarRentalAPI

**CarRentalAPI – Développement d’une API REST pour un service de location de voitures**

**Author du Brief:** Iliass RAIHANI.

**Author de Code:** Ibrahim Nidam.

## Links

- **GitHub Repository :** [View on GitHub](https://github.com/Youcode-Classe-E-2024-2025/Ibrahim_Nidam_CarRentalAPI.git)
- **Project Presentation :** [View Presentation]()

### Créé : 10/03/25

Le projet CarRentalAPI consiste à développer une API REST en Laravel permettant la gestion d’un service de location de voitures. L’API devra permettre aux utilisateurs de consulter les véhicules disponibles, effectuer une réservation, gérer leur profil et suivre l’état de leurs locations. L’objectif principal est d’apprendre à concevoir une API en respectant les bonnes pratiques de développement avec Laravel.

# Configuration et Exécution du Projet Laravel

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les outils suivants :

- **PHP** (à partir de la version recommandée par Laravel, voir [PHP](https://www.php.net/)).
- **Composer** ([télécharger ici](https://getcomposer.org/download/)).
- **Node.js** et **npm** ([télécharger ici](https://nodejs.org/)).
- **MySQL** (ou un autre SGBD compatible, ex: PostgreSQL).
- **Laravel** installé globalement (optionnel, peut être utilisé via Composer).

## Installation du projet

### 1. Cloner le dépôt

Ouvrez un terminal et exécutez :
```bash
git clone https://github.com/Youcode-Classe-E-2024-2025/Ibrahim_Nidam_CarRentalAPI.git
cd Ibrahim_Nidam_CarRentalAPI
```

### 2. Installer les dépendances PHP

Dans le dossier du projet, exécutez :
```bash
composer install
```

### 3. Configurer le fichier `.env`

Copiez le fichier `.env.example` et renommez-le en `.env` :
```bash
cp .env.example .env  # Linux/Mac
copy .env.example .env # Windows
```

Modifiez les paramètres de la base de données dans `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_votre_bdd
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Générer la clé d'application

Exécutez la commande suivante pour générer une clé unique :
```bash
php artisan key:generate
```

### 5. Exécuter les migrations et seeders (si disponibles)

Créez la base de données et appliquez les migrations :
```bash
php artisan migrate --seed
```

### 6. Installer les dépendances front-end

Installez les dépendances npm :
```bash
npm install
```
Si votre projet utilise Vite, démarrez le build :
```bash
npm run dev
```

### 7. Démarrer le serveur local

Utilisez la commande artisan pour démarrer le serveur Laravel :
```bash
php artisan serve
```
Accédez au projet via : [http://127.0.0.1:8000](http://127.0.0.1:8000)


# Contexte du projet:

Dans l’industrie de la mobilité, les services de location de véhicules sont en forte croissance. De nombreuses entreprises cherchent à automatiser et simplifier leur gestion grâce à des solutions numériques. Ce projet propose de concevoir une API REST robuste et sécurisée qui pourra être intégrée à une application mobile ou web pour faciliter la gestion des locations.

## **Objectifs du projet :**
- L’objectif de ce projet est d’apprendre à créer une API en Laravel, en respectant les principes REST et en intégrant les bonnes pratiques de développement. Les apprenants devront :

#### **Fonctionnels :**
- Mettre en place une architecture Laravel adaptée aux API.
- Gérer l’authentification et l’autorisation avec Laravel Sanctum.
- Manipuler les requêtes CRUD avec Eloquent ORM.
- Assurer la validation des données et la gestion des erreurs.
- Implémenter la pagination et la gestion des filtres.
- Rédiger une documentation API avec Swagger (Laravel OpenAPI).
- Tester les endpoints avec Postman.

## **Modalités pédagogiques**

- Durée : 1 semaine (10/03 9:30 - 14/03 17:00)
- Travail individuel.
- Méthodologie Agile : backlog et suivi via GitHub Project.
- Utilisation d’outils adaptés : Postman pour tester l’API, GitHub pour le suivi, et Swagger pour la documentation.

## **Modalités d'évaluation**

✅ Respect des principes RESTful (ressources, verbes HTTP, statuts de réponse).
✅ Bonne structuration du code et utilisation des conventions Laravel.
✅ Gestion de l’authentification et autorisation via Laravel Sanctum.
✅ Présence d’une documentation API complète avec Swagger.
✅ Suivi du projet sur GitHub (Kanban, backlog, commits organisés).
✅ Présentation orale et démonstration en soutenance.

## **Livrables**
🔹 Configuration du projet Laravel et mise en place de l’architecture API.
🔹 Création des modèles principaux : User, Car, Rental, Payment.
🔹 Implémentation des routes et contrôleurs de base (CRUD voitures et utilisateurs).
🔹 Authentification avec Laravel Sanctum.
🔹 Dépôt GitHub initial avec documentation de l’architecture.
🔹 Finalisation des endpoints pour la gestion des locations et paiements.
🔹 Ajout de la validation, gestion des erreurs et pagination.
🔹 Documentation API avec Swagger.
🔹 Présentation finale et mise à jour complète du GitHub.


## **Critères de performance**

*Sécurité :*
- Authentification avec Laravel Sanctum.
- Validation et gestion des erreurs.
- Protection contre les injections SQL et CSRF.

*Techniques :*
- Code propre, structuré et conforme aux conventions Laravel.
- Respect du principe MVC et séparation des responsabilités.
- API REST bien conçue et respect des standards HTTP.

*Documentation :*
- Documentation API complète avec Swagger.
- README détaillé (installation, endpoints, exemples de requêtes).

*Tests :*
- Utilisation de Postman pour valider les endpoints.
- Suivi régulier sur GitHub (Kanban, backlog, commits clairs).
- Présentation finale bien structurée avec démonstration fonctionnelle.