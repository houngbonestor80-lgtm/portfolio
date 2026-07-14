<?php

$pageTitle = $pageTitle ?? SITE_NAME;
$brands = getAllBrands();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle) ?> | <?= e(SITE_NAME) ?></title>
<meta name="description" content="<?= e(SITE_TAGLINE) ?> - iPhone, Samsung Galaxy et Google Pixel a Cotonou, Benin.">
<link rel="icon" href="/assets/images/site/logo.svg" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="<?= e($bodyClass ?? '') ?>">

<div class="topbar">
    <div class="container">
        <div class="topbar-links">
            <a href="tel:<?= e(SITE_PHONE) ?>">&#128222; <?= e(SITE_PHONE) ?></a>
            <a href="mailto:<?= e(SITE_EMAIL) ?>">&#9993; <?= e(SITE_EMAIL) ?></a>
        </div>
        <div class="topbar-links">
            <span>&#128205; <?= e(SITE_ADDRESS) ?></span>
        </div>
    </div>
</div>

<header class="site-header">
    <div class="container">
        <a href="/index.php" class="logo">
            <img src="/assets/images/site/logo.svg" alt="<?= e(SITE_NAME) ?>">
        </a>

        <button class="nav-toggle" id="navToggle" aria-label="Menu">&#9776;</button>
        <div class="nav-overlay" id="navOverlay"></div>

        <nav class="main-nav" id="mainNav">
            <a href="/index.php" class="<?= isActivePage('index.php') ?>">Accueil</a>
            <a href="/shop.php" class="<?= isActivePage('shop.php') ?>">Boutique</a>
            <?php foreach ($brands as $b): ?>
                <a href="/shop.php?brand=<?= e($b['slug']) ?>">
                    <?= e($b['name']) ?>
                </a>
            <?php endforeach; ?>
            <a href="/about.php" class="<?= isActivePage('about.php') ?>">A propos</a>
            <a href="/contact.php" class="<?= isActivePage('contact.php') ?>">Contact</a>
        </nav>

        <div class="header-actions">
            <form class="header-search" action="/shop.php" method="get">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" name="search" placeholder="Rechercher un telephone..." value="<?= e($_GET['search'] ?? '') ?>">
            </form>
            <a href="/cart.php" class="cart-link">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                <span class="cart-count"><?= (int) cartCount() ?></span>
            </a>
        </div>
    </div>
</header>
