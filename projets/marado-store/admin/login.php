<?php
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/includes/auth.php';

if (isAdminLoggedIn()) {
    redirect('/admin/index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfCheck()) {
        $error = 'Session expiree, merci de reessayer.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        if (attemptAdminLogin($username, $password)) {
            redirect('/admin/index.php');
        } else {
            $error = 'Identifiants incorrects.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connexion admin | <?= e(SITE_NAME) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="admin-login-body">
    <div class="login-card">
        <img src="/assets/images/site/logo.svg" alt="<?= e(SITE_NAME) ?>" class="login-logo">
        <h1>Espace administrateur</h1>
        <p class="login-sub">Connecte-toi pour gerer la boutique.</p>

        <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>

        <form method="post" action="/admin/login.php">
            <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
            <div class="form-field">
                <label>Identifiant</label>
                <input type="text" name="username" required autofocus value="<?= e($_POST['username'] ?? '') ?>">
            </div>
            <div class="form-field">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
        </form>
        <a href="/index.php" class="back-link">&larr; Retour au site</a>
    </div>
</body>
</html>
