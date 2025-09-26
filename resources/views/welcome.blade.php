<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyWise API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f6fa;
            color: #333;
        }
        header {
            background-color: #2f3640;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2rem;
        }
        main {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }
        h2 {
            color: #2f3640;
            margin-top: 40px;
        }
        .route {
            background-color: #fff;
            border-left: 5px solid #44bd32;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .route span.method {
            font-weight: bold;
            color: #273c75;
            display: inline-block;
            width: 80px;
        }
        code {
            background-color: #f1f2f6;
            padding: 2px 5px;
            border-radius: 3px;
            font-family: monospace;
        }
        footer {
            text-align: center;
            padding: 20px 0;
            color: #888;
        }
    </style>
</head>
<body>
    <header>
        <h1>MoneyWise API</h1>
        <p>Gestion de transactions et catégories personnelles</p>
    </header>
    <main>
        <h2>Authentication</h2>
        <div class="route">
            <span class="method">POST</span> <code>/api/register</code> - Créer un compte utilisateur
        </div>
        <div class="route">
            <span class="method">POST</span> <code>/api/login</code> - Connexion et récupération du token JWT
        </div>

        <h2>Utilisateur (JWT requis)</h2>
        <div class="route">
            <span class="method">GET</span> <code>/api/me</code> - Récupérer le profil connecté
        </div>
        <div class="route">
            <span class="method">POST</span> <code>/api/logout</code> - Déconnexion
        </div>
        <div class="route">
            <span class="method">POST</span> <code>/api/refresh</code> - Rafraîchir le token JWT
        </div>

        <h2>Catégories (JWT requis)</h2>
        <div class="route">
            <span class="method">GET</span> <code>/api/categories</code> - Lister les catégories
        </div>
        <div class="route">
            <span class="method">POST</span> <code>/api/categories</code> - Créer une catégorie
        </div>
        <div class="route">
            <span class="method">PUT</span> <code>/api/categories/{id}</code> - Mettre à jour une catégorie
        </div>
        <div class="route">
            <span class="method">DELETE</span> <code>/api/categories/{id}</code> - Supprimer une catégorie
        </div>

        <h2>Transactions (JWT requis)</h2>
        <div class="route">
            <span class="method">GET</span> <code>/api/transactions</code> - Lister les transactions
        </div>
        <div class="route">
            <span class="method">POST</span> <code>/api/transactions</code> - Créer une transaction
        </div>
        <div class="route">
            <span class="method">PUT</span> <code>/api/transactions/{id}</code> - Mettre à jour une transaction
        </div>
        <div class="route">
            <span class="method">DELETE</span> <code>/api/transactions/{id}</code> - Supprimer une transaction
        </div>

        <h2>Statistiques (JWT requis)</h2>
        <div class="route">
            <span class="method">GET</span> <code>/api/stats/categories</code> - Statistiques par catégorie
        </div>
        <div class="route">
            <span class="method">GET</span> <code>/api/stats/monthly</code> - Statistiques mensuelles
        </div>
    </main>
    <footer>
        &copy; 2025 MoneyWise API
    </footer>
</body>
</html>
