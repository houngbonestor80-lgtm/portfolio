<?php
/**
 * En-tete du panneau admin. Attend $pageTitle et que auth.php ait ete inclus + requireAdmin() appele.
 */
$pageTitle = $pageTitle ?? 'Administration';
$currentScript = basename($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle) ?> | Administration <?= e(SITE_NAME) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="admin-body">
<div class="admin-layout">
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <img src="/assets/images/site/logo.svg" alt="<?= e(SITE_NAME) ?>">
        </div>
        <nav class="admin-nav">
            <a href="/admin/index.php" class="<?= $currentScript === 'index.php' ? 'active' : '' ?>">&#128202; Tableau de bord</a>
            <a href="/admin/products.php" class="<?= in_array($currentScript, ['products.php', 'product-form.php']) ? 'active' : '' ?>">&#128241; Produits</a>
            <a href="/admin/orders.php" class="<?= in_array($currentScript, ['orders.php', 'order-view.php']) ? 'active' : '' ?>">&#128230; Commandes</a>
            <a href="/admin/messages.php" class="<?= $currentScript === 'messages.php' ? 'active' : '' ?>">&#9993; Messages</a>
            <a href="/index.php" target="_blank">&#127760; Voir le site</a>
            <a href="/admin/logout.php" class="logout-link">&#8630; Deconnexion</a>
        </nav>
    </aside>
    <main class="admin-main">
        <div class="admin-topbar">
            <h1><?= e($pageTitle) ?></h1>
            <span class="admin-user">&#128100; <?= e($_SESSION['admin_name'] ?? 'Admin') ?></span>
        </div>
        <div class="admin-content">
