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
            <a href="tel:<?= e(SITE_PHONE) ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg> <?= e(SITE_PHONE) ?></a>
            <a href="mailto:<?= e(SITE_EMAIL) ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg> <?= e(SITE_EMAIL) ?></a>
        </div>
        <div class="topbar-links">
            <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> <?= e(SITE_ADDRESS) ?></span>
        </div>
    </div>
</div>

<header class="site-header">
    <div class="container">
        <a href="/index.php" class="logo">
            <img src="/assets/images/site/logo.svg" alt="<?= e(SITE_NAME) ?>">
        </a>

        <button class="nav-toggle" id="navToggle" aria-label="Menu"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
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
