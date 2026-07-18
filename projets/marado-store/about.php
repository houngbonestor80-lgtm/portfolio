<?php
require_once __DIR__ . '/includes/init.php';

$pageTitle = 'A propos';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Accueil</a> / <span>A propos</span></div>
        <h1>A propos de Marado Store</h1>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="about-grid">
            <div>
                <span class="eyebrow" style="color:var(--color-primary);font-weight:700;">Notre histoire</span>
                <h2 style="font-size:28px;margin:10px 0 18px;">La reference smartphones au Benin</h2>
                <p>Marado Store est une boutique specialisee dans la vente de smartphones neufs et garantis : iPhone, Samsung Galaxy et Google Pixel. Notre mission est simple : rendre l'acces aux meilleurs telephones du marche simple, rapide et fiable pour tous les Beninois.</p>
                <p>Chaque produit propose sur notre site est selectionne avec soin, verifie et couvert par une garantie de 12 mois. Nous livrons a Cotonou en 24h et partout ailleurs au Benin en 48 a 72h.</p>
                <p>Que vous soyez a la recherche du dernier iPhone, d'un Galaxy performant ou d'un Pixel a l'intelligence artificielle bluffante, notre equipe vous accompagne du choix du modele jusqu'a la livraison.</p>
                <a href="/shop.php" class="btn btn-primary">Decouvrir la boutique</a>
            </div>
            <div class="features-grid" style="grid-template-columns:repeat(2,1fr);">
                <div class="feature-card" style="background:var(--color-bg-alt);border-radius:var(--radius-lg);">
                    <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                    <h4>Garantie 12 mois</h4>
                    <p>Sur tous nos smartphones neufs.</p>
                </div>
                <div class="feature-card" style="background:var(--color-bg-alt);border-radius:var(--radius-lg);">
                    <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
                    <h4>Livraison rapide</h4>
                    <p>24h a Cotonou, 48-72h ailleurs.</p>
                </div>
                <div class="feature-card" style="background:var(--color-bg-alt);border-radius:var(--radius-lg);">
                    <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="3"/><line x1="6" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="18" y2="12"/></svg></div>
                    <h4>Paiement flexible</h4>
                    <p>A la livraison ou Mobile Money.</p>
                </div>
                <div class="feature-card" style="background:var(--color-bg-alt);border-radius:var(--radius-lg);">
                    <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                    <h4>Produits verifies</h4>
                    <p>Selection rigoureuse des modeles.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
