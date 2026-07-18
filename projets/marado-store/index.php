<?php
require_once __DIR__ . '/includes/init.php';

$pageTitle = 'Accueil';
$featured = getFeaturedProducts(8);
$brands = getAllBrands();

$brandMeta = [
    'apple'   => ['color' => '#1d1d1f', 'desc' => 'iPhone 15, 14, 13, SE...'],
    'samsung' => ['color' => '#1428a0', 'desc' => 'Galaxy S24, S23, A54, Z Flip...'],
    'google'  => ['color' => '#0b8043', 'desc' => 'Pixel 8 Pro, 8, 7a...'],
];

require_once __DIR__ . '/includes/header.php';
?>
<?php include __DIR__ . '/includes/flash.php'; ?>

<section class="hero">
    <div class="container">
        <div class="hero-text">
            <span class="hero-eyebrow"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg> Livraison rapide a Cotonou &amp; partout au Benin</span>
            <h1>Le smartphone de tes reves <span>chez Marado Store</span></h1>
            <p class="lead">iPhone, Samsung Galaxy et Google Pixel neufs, garantis et au meilleur prix. Paiement a la livraison ou Mobile Money.</p>
            <div class="hero-actions">
                <a href="/shop.php" class="btn btn-accent">Voir la boutique</a>
                <a href="https://wa.me/<?= e(SITE_WHATSAPP) ?>" class="btn btn-outline" style="color:#fff;border-color:rgba(255,255,255,0.35)" target="_blank" rel="noopener">Commander sur WhatsApp</a>
            </div>
            <div class="hero-stats">
                <div><strong>12+</strong><span>Modeles disponibles</span></div>
                <div><strong>3</strong><span>Grandes marques</span></div>
                <div><strong>100%</strong><span>Produits garantis</span></div>
            </div>
        </div>
        <div class="hero-image">
            <img src="/assets/images/site/hero-banner.svg" alt="Smartphones Marado Store">
        </div>
    </div>
</section>

<section class="brand-strip section">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Nos marques</span>
            <h2>Achete par marque</h2>
            <p>Explore notre selection des plus grandes marques de smartphones du marche.</p>
        </div>
        <div class="brand-grid">
            <?php foreach ($brands as $b): $meta = $brandMeta[$b['slug']] ?? ['color' => '#111', 'desc' => '']; ?>
            <a href="/shop.php?brand=<?= e($b['slug']) ?>" class="brand-card">
                <span class="dot" style="background:<?= e($meta['color']) ?>"><?= e(strtoupper(substr($b['name'], 0, 1))) ?></span>
                <span>
                    <h3><?= e($b['name']) ?></h3>
                    <span><?= e($meta['desc']) ?></span>
                </span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Selection</span>
            <h2>Produits vedettes</h2>
            <p>Les telephones les plus demandes du moment, choisis pour leur rapport qualite-prix.</p>
        </div>
        <div class="product-grid">
            <?php foreach ($featured as $p): include __DIR__ . '/includes/product-card.php'; endforeach; ?>
        </div>
        <div style="text-align:center;margin-top:36px;">
            <a href="/shop.php" class="btn btn-primary">Voir tous les produits</a>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
                <h4>Livraison rapide</h4>
                <p>Partout a Cotonou et dans les grandes villes du Benin.</p>
            </div>
            <div class="feature-card">
                <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                <h4>Produits garantis</h4>
                <p>Tous nos telephones sont neufs et sous garantie.</p>
            </div>
            <div class="feature-card">
                <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="3"/><line x1="6" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="18" y2="12"/></svg></div>
                <h4>Paiement flexible</h4>
                <p>Paiement a la livraison ou par Mobile Money.</p>
            </div>
            <div class="feature-card">
                <div class="icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg></div>
                <h4>Support client</h4>
                <p>Une equipe disponible par telephone et WhatsApp.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Avis clients</span>
            <h2>Ce que disent nos clients</h2>
        </div>
        <div class="testimonial-grid">
            <div class="testimonial-card">
                <div class="stars"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                <p class="quote">"Commande passee le matin, livree l'apres-midi a Cotonou. Le telephone etait comme neuf, tres satisfait !"</p>
                <div class="author">
                    <div class="avatar">R</div>
                    <div><strong>Roseline A.</strong><span>Cotonou</span></div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="stars"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                <p class="quote">"Le meilleur prix que j'ai trouve pour un Galaxy S24 Ultra au Benin. Equipe tres reactive sur WhatsApp."</p>
                <div class="author">
                    <div class="avatar">K</div>
                    <div><strong>Kevin D.</strong><span>Porto-Novo</span></div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="stars"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div>
                <p class="quote">"Mon Pixel 8 fonctionne parfaitement, et le paiement a la livraison m'a rassure. Je recommande Marado Store."</p>
                <div class="author">
                    <div class="avatar">S</div>
                    <div><strong>Sandra M.</strong><span>Abomey-Calavi</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0;">
    <div class="container">
        <div class="cta-band">
            <div>
                <h3>Une question avant de commander ?</h3>
                <p>Notre equipe repond en quelques minutes sur WhatsApp.</p>
            </div>
            <a href="https://wa.me/<?= e(SITE_WHATSAPP) ?>" class="btn btn-accent" target="_blank" rel="noopener">Discuter maintenant</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
