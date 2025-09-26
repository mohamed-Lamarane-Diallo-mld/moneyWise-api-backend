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
        cursor: pointer;
    }
    .section-content {
        display: none;
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
    code {
        background: #f1f2f6;
        padding: 2px 5px;
        border-radius: 3px;
        font-family: monospace;
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
<header>
    <h1>MoneyWise API</h1>
    <p>Gestion de portefeuilles et suivi des transactions personnelles</p>
</header>
<main>

<h2 onclick="toggleSection('auth')">Authentication</h2>
<div id="auth" class="section-content">
    <div class="route">
        <span class="method method-POST">POST</span> <code>/api/register</code> - Créer un compte
        <button class="copy-btn" onclick="copyText('/api/register')">Copier</button>
    </div>
    <div class="route">
        <span class="method method-POST">POST</span> <code>/api/login</code> - Connexion
        <button class="copy-btn" onclick="copyText('/api/login')">Copier</button>
    </div>
</div>

<h2 onclick="toggleSection('user')">Utilisateur (JWT requis)</h2>
<div id="user" class="section-content">
    <div class="route">
        <span class="method method-GET">GET</span> <code>/api/me</code>
        <button class="copy-btn" onclick="copyText('/api/me')">Copier</button>
    </div>
    <div class="route">
        <span class="method method-POST">POST</span> <code>/api/logout</code>
        <button class="copy-btn" onclick="copyText('/api/logout')">Copier</button>
    </div>
    <div class="route">
        <span class="method method-POST">POST</span> <code>/api/refresh</code>
        <button class="copy-btn" onclick="copyText('/api/refresh')">Copier</button>
    </div>
</div>

<h2 onclick="toggleSection('categories')">Catégories (JWT requis)</h2>
<div id="categories" class="section-content">
    <div class="route">
        <span class="method method-GET">GET</span> <code>/api/categories</code>
        <button class="copy-btn" onclick="copyText('/api/categories')">Copier</button>
    </div>
    <div class="route">
        <span class="method method-POST">POST</span> <code>/api/categories</code>
        <button class="copy-btn" onclick="copyText('/api/categories')">Copier</button>
    </div>
    <div class="route">
        <span class="method method-PUT">PUT</span> <code>/api/categories/{id}</code>
        <button class="copy-btn" onclick="copyText('/api/categories/{id}')">Copier</button>
    </div>
    <div class="route">
        <span class="method method-DELETE">DELETE</span> <code>/api/categories/{id}</code>
        <button class="copy-btn" onclick="copyText('/api/categories/{id}')">Copier</button>
    </div>
</div>

<h2 onclick="toggleSection('transactions')">Transactions (JWT requis)</h2>
<div id="transactions" class="section-content">
    <div class="route">
        <span class="method method-GET">GET</span> <code>/api/transactions</code>
        <button class="copy-btn" onclick="copyText('/api/transactions')">Copier</button>
    </div>
    <div class="route">
        <span class="method method-POST">POST</span> <code>/api/transactions</code>
        <button class="copy-btn" onclick="copyText('/api/transactions')">Copier</button>
    </div>
    <div class="route">
        <span class="method method-PUT">PUT</span> <code>/api/transactions/{id}</code>
        <button class="copy-btn" onclick="copyText('/api/transactions/{id}')">Copier</button>
    </div>
    <div class="route">
        <span class="method method-DELETE">DELETE</span> <code>/api/transactions/{id}</code>
        <button class="copy-btn" onclick="copyText('/api/transactions/{id}')">Copier</button>
    </div>
</div>

<h2 onclick="toggleSection('stats')">Statistiques (JWT requis)</h2>
<div id="stats" class="section-content">
    <div class="route">
        <span class="method method-GET">GET</span> <code>/api/stats/categories</code>
        <button class="copy-btn" onclick="copyText('/api/stats/categories')">Copier</button>
    </div>
    <div class="route">
        <span class="method method-GET">GET</span> <code>/api/stats/monthly</code>
        <button class="copy-btn" onclick="copyText('/api/stats/monthly')">Copier</button>
    </div>
</div>

</main>
<footer>
    &copy; 2025 MoneyWise API
</footer>

<script>
function toggleSection(id) {
    const section = document.getElementById(id);
    section.style.display = (section.style.display === "block") ? "none" : "block";
}

function copyText(text) {
    navigator.clipboard.writeText("https://moneywise-api-backend.onrender.com/api" + text)
    .then(() => alert("URL copiée !"))
    .catch(err => alert("Erreur copie : " + err));
}
</script>
</body>
</html>
