<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MoneyWise API - Documentation</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        background: #f5f7fa;
        color: #333;
    }
    header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: #fff;
        padding: 80px 20px;
        text-align: center;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        margin-bottom: 100px;
    }
    header h1 {
        margin: 0;
        font-size: 3rem;
        font-weight: 900;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
    }
    header p {
        margin-top: 15px;
        font-size: 1.5rem;
        font-weight: 500;
        text-shadow: 1px 1px 6px rgba(0,0,0,0.2);
    }
    main {
        max-width: 1000px;
        margin: -60px auto 40px auto;
        padding: 0 20px;
    }
    h2 {
        color: #2575fc;
        margin-top: 40px;
    }
    .section-content {
        display: block; /* Tout est ouvert par défaut */
        margin: 10px 0 30px 0;
    }
    .route {
        background: #fff;
        border-left: 5px solid #44bd32;
        margin: 10px 0;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .route span.method {
        font-weight: bold;
        color: #fff;
        padding: 2px 8px;
        border-radius: 4px;
        margin-right: 10px;
        font-size: 0.9rem;
        display: inline-block;
    }
    .method-GET { background: #4caf50; }
    .method-POST { background: #2196f3; }
    .method-PUT { background: #ff9800; }
    .method-DELETE { background: #f44336; }
    code, pre {
        background: #f1f2f6;
        padding: 5px;
        border-radius: 3px;
        font-family: monospace;
        overflow-x: auto;
    }
    .param, .response {
        margin-left: 20px;
        font-size: 0.9rem;
    }
    button.copy-btn {
        margin-left: 10px;
        padding: 3px 8px;
        border: none;
        background: #44bd32;
        color: #fff;
        border-radius: 3px;
        cursor: pointer;
    }
    button.copy-btn:hover {
        background: #4cd137;
    }
    footer {
        text-align: center;
        padding: 20px 0;
        color: #888;
        margin-top: 40px;
    }
</style>
</head>
<body>
    @csrf
<header>
    <h1>MoneyWise API</h1>
    <p>Gestion de portefeuilles et suivi des transactions personnelles</p>
</header>
<main>

<!-- Authentication -->
<h2>Authentication</h2>
<div class="section-content">
    <div class="route">
        <span class="method method-POST">POST</span> <code>/api/register</code> - Créer un compte
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/register')">Copier</button>
        <div class="param"><strong>Paramètres:</strong><br>name, email, password</div>
            <div class="response"><strong>Réponse exemple:</strong>
                <pre>
                    {
                        "name": "lamadialo mld",
                        "email": "lama1123@example.com",
                        "password": "122123456"
                    }
                </pre>
            </div>
        </div>
        <span class="method method-POST">POST</span> <code>/api/register</code> - Créer un compte
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/register')">Copier</button>
        <div class="param"><strong>Paramètres:</strong><br>name, email, password</div>
            <div class="response"><strong>Réponse exemple:</strong>
                <pre>
                    {
                        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
                        "user": {
                            "name": "lamadiallo mld",
                            "email": "lamadiallo1123@example.com",
                            "updated_at": "2025-09-29T07:03:04.000000Z",
                            "created_at": "2025-09-29T07:03:04.000000Z",
                            "id": 6
                        },
                        "token_type": "bearer",
                        "expires_in": 3600
                    }
                </pre>
            </div>
        </div>
</div>
<!--  -->
        <div class="route">
            <span class="method method-POST">POST</span> <code>/api/login</code> - Connexion
            <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/login')">Copier</button>
            <div class="param"><strong>Paramètres:</strong><br>name, email, password</div>
                <div class="response"><strong>Réponse exemple:</strong>
                    <pre>
                        {
                            "email": "lamadiallo1123@example.com",
                            "password": "122123456"
                        }
                    </pre>
                </div>
            </div>
            <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/login')">Copier</button>
            <div class="param"><strong>Paramètres:</strong><br>email, password</div>
            <div class="response"><strong>Réponse exemple:</strong>
            <pre>
                {
                    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
                    "user": {
                        "id": 6,
                        "name": "lamadiallo mld",
                        "email": "lamadiallo1123@example.com",
                        "budget": "0.00",
                        "profile_image": null,
                        "created_at": "2025-09-29T07:03:04.000000Z",
                        "updated_at": "2025-09-29T07:03:04.000000Z"
                    },
                    "token_type": "bearer",
                    "expires_in": 3600
                }
            </pre>
        </div>
    </div>

<
<!-- User -->
<h2>Utilisateur (JWT requis)</h2>
<div class="section-content">
    <div class="route">
        <span class="method method-GET">GET</span> <code>/api/me</code>
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/me')">Copier</button>
        <div class="response">
            <pre>
                {
                //
                }
            </pre>
        </div>
        <span class="method method-GET">GET</span> <code>/api/me</code>
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/me')">Copier</button>
        <div class="response">
            <pre>
                {
                    "id": 1,
                    "name": "lamadialo mld",
                    "email": "lama1123@example.com",
                    "budget": "0.00",
                    "profile_image": null,
                    "created_at": "2025-09-27T21:47:06.000000Z",
                    "updated_at": "2025-09-27T21:47:06.000000Z"
                }
            </pre>
        </div>
    </div>
    <!--  -->
    <div class="route">
        <span class="method method-POST">POST</span> <code>/api/logout</code>
         <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/logout')">Copier</button>
        <div class="response">
            <pre>
                {
                //
                }
            </pre>
        </div>
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/logout')">Copier</button>
        <div class="response"><pre>{"message": "Successfully logged out"}</pre></div>
    </div>
    <!--  -->
    <div class="route">
        <span class="method method-POST">POST</span> <code>/api/refresh</code>
        <span class="method method-POST">NOTE : il faut se loger avant de renouveller votre token</span> 
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/refresh')">Copier</button>
        <div class="response">
            <pre>
                {
                //
                }
            </pre>
        </div>
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/refresh')">Copier</button>
        <div class="response">
            <pre>
                {
                    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
                    "user": {
                        "id": 1,
                        "name": "lamadialo mld",
                        "email": "lama1123@example.com",
                        "budget": "0.00",
                        "profile_image": null,
                        "created_at": "2025-09-27T21:47:06.000000Z",
                        "updated_at": "2025-09-27T21:47:06.000000Z"
                    },
                    "token_type": "bearer",
                    "expires_in": 3600
                }
            </pre>
        </div>
    </div>
</div>

<!-- Categories -->
<h2>Catégories (JWT requis)</h2>
<div class="section-content">
        <div class="route">
            <span class="method method-GET">GET</span> <code>/api/categories</code> - Obtenir toutes les catégories
            <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/categories')">Copier</button>
            <div class="response">
                <pre>
                    [
                        { 
                            "id": 1, 
                            "name": "Loisir", 
                            "type": "expense", 
                            "user_id": 1 
                        }
                    ]
                </pre>
            </div>
        </div>
        <div class="route">
            <span class="method method-POST">POST</span> <code>/api/categories</code> - Créer une catégorie
            <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/categories')">Copier</button>
            <div class="param">name, type (income|expense), user_id</div>
            <div class="response">
                <strong>exemple:</strong>
                <pre>
                    {
                        "name": "Loisir",
                        "type": "expense",
                        "user_id": 1
                    }
                </pre>
            </div>
            <div>response</div>
            <div class="response">
                <pre>
                    {
                        "id": 1,
                        "name": "Loisir",
                        "type": "expense",
                        "user_id": 1
                    }
                </pre>
            </div>
        </div>
        <div class="route">
            <span class="method method-PUT">PUT</span> <code>/api/categories/{id}</code>
            <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/categories/{id}')">Copier</button>
            <div class="param">name, type, user_id</div>
            <div class="response">
                <pre>
                    {
                        "id": 2,
                        "name": "Transport Modifié",
                        "type": "expense",
                        "user_id": 1
                    }
                </pre>
            </div>
        </div>
        <div class="route">
            <span class="method method-DELETE">DELETE</span> <code>/api/categories/{id}</code>
            <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/categories/{id}')">Copier</button>
            <div class="response"><pre>{ "message": "Catégorie supprimée" }</pre></div>
        </div>
</div>

<!-- Transactions -->
<h2>Transactions (JWT requis)</h2>
<div class="section-content">
    <div class="route">
        <span class="method method-GET">GET</span> <code>/api/transactions</code>
        <span class="method method-GET">Obteension de tout les transaction</span>
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/transactions')">Copier</button>
        <div class="response">
            <pre>
                [
                    { 
                        "id": 1, 
                        "user_id": 1, 
                        "category_id": 1, 
                        "title": "Achat transport", 
                        "amount": 15.50, 
                        "type": "expense", 
                        "date": "2025-09-26" 
                    }
                    .... ici d'autres transactions ...
                ]
            </pre>
        </div>
        <span class="method method-GET">GET</span> <code>/api/transactions&limit=10</code>
        <span class="method method-GET">Obteension de tout les transaction avec la variable limit = 10 </span>
        <span class="method method-GET">NOTE : la variable c'est limit dans l'url </span>
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/transactions')">Copier</button>
        <div class="response">
            <pre>
                [
                    { 
                        "id": 1, 
                        "user_id": 1, 
                        "category_id": 1, 
                        "title": "Achat transport", 
                        "amount": 15.50, 
                        "type": "expense", 
                        "date": "2025-09-26" 
                    }
                    .... ici d'autres transactions jusqu'a limit ...
                ]
            </pre>
        </div>
    </div>
    <div class="route">
            <span class="method method-POST">POST</span> <code>/api/transactions</code> - Créer une transaction
            
            <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/transactions')">Copier</button>
            <div class="param">user_id, category_id, title, amount, type, date</div>
            <div class="response">
                <strong>exemple:</strong>
                <pre>
                    {
                        "user_id": 1,
                        "category_id": 1,
                        "title": "Salaire",
                        "amount": 15000.00,
                        "type": "income",
                        "date": "2025-09-25"
                    }
                </pre>
            </div>
            <div>response</div>
            <div class="response">
                <pre>
                    {
                        "id": 1,
                        "user_id": 1,
                        "category_id": 1,
                        "title": "Salaire",
                        "amount": 15000.00,
                        "type": "income",
                        "date": "2025-09-25"
                    }
                </pre>
            </div>
    </div>
    <div class="route">
            <span class="method method-PUT">PUT</span> <code>/api/transactions/{id}</code> - Mettre à jour une transaction
            <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/transactions/{id}')">Copier</button>
            <div class="param">user_id, category_id, title, amount, type, date</div>
            <div class="response">
                <strong>exemple:</strong>
                <pre>
                    {
                        "user_id": 1,
                        "category_id": 1,
                        "title": "Salaire Modifié",
                        "amount": 1600.00,
                        "type": "income",
                        "date": "2025-09-25"
                    }
                </pre>
            </div>
            <div>response</div>
            <div class="response">
                <pre>
                    {
                    "id": 1,
                    "title": "Salaire Modifié",
                    "amount": 1600.00
                    }
                </pre>
            </div>
    </div>
    <div class="route">
        <span class="method method-DELETE">DELETE</span> <code>/api/transactions/{id}</code>
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/transactions/{id}')">Copier</button>
        <div class="response"><pre>{ "message": "Transaction supprimée" }</pre></div>
    </div>
</div>

<!-- Stats -->
<h2>Statistiques (JWT requis)</h2>
<div class="section-content">
    <div class="route">
        <span class="method method-GET">GET</span> <code>/api/stats/categories</code> - Total par catégorie
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/stats/categories')">Copier</button>
        <div class="response">
            <pre>
                {
                    "Loisir": 150,
                    "Transport": 30
                }
            </pre>
        </div>
    </div>
    <div class="route">
        <span class="method method-GET">GET</span> <code>/api/stats/monthly</code>
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/stats/monthly')">Copier</button>
        <div class="response">
            <pre>
                {
                    "2025-09": { 
                        "income": 1500, 
                        "expense": 180 
                    }
                }
            </pre>
        </div>
    </div>
</div>

<!-- User Profile Update -->
<h2>Profil Utilisateur (JWT requis)</h2>
<div class="section-content">
    <div class="route">
        <span class="method method-POST">POST</span> <code>/api/update-profile</code> - Mettre à jour le profil
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/update-profile')">Copier</button>
        <div class="param"><strong>Paramètres:</strong><br>
            name (string, optionnel), email (string, optionnel), password (string, optionnel), profile_image (file, optionnel)
        </div>
        <div class="response">
            <strong>Réponse exemple:</strong>
            <pre>
                {
                    "success": true,
                    "message": "Profil mis à jour",
                    "user": {
                        "id": 1,
                        "name": "Nouveau Nom",
                        "email": "user@mail.com",
                        "profile_image": "https://moneywise-api-backend.onrender.com/storage/profiles/avatar.png"
                    }
                }
            </pre>
        </div>
    </div>
</div>

<div class="section-content">
    <div class="route">
        <span class="method method-POST">POST</span> <code>https://moneywise-api-backend.onrender.com/api</code> - Point d'entrée de l'API et documentation sous forme JSON
        <button class="copy-btn" onclick="navigator.clipboard.writeText('/api/update-profile')">Copier</button>
    </div>
</div>

<footer>
    &copy; 2025 MoneyWise API - Tous droits réservés
</footer>

</body>
</html>
