<?php
require_once __DIR__ . '/includes/init.php';

$slug = $_GET['slug'] ?? '';
$product = $slug ? getProductBySlug($slug) : null;

if (!$product) {
    header('HTTP/1.0 404 Not Found');
    $pageTitle = 'Produit introuvable';
    require_once __DIR__ . '/includes/header.php';
    echo '<div class="empty-state"><div class="icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div><h3>Produit introuvable</h3><p>Ce produit n\'existe plus ou a ete retire de la boutique.</p><a href="/shop.php" class="btn btn-primary">Retour a la boutique</a></div>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$gallery = getProductGallery($product['id']);
$images = array_merge([['image_path' => $product['image_main']]], $gallery);
$related = getRelatedProducts($product['brand_id'], $product['id'], 4);

$discount = 0;
if (!empty($product['old_price']) && $product['old_price'] > $product['price']) {
    $discount = round((($product['old_price'] - $product['price']) / $product['old_price']) * 100);
}

$pageTitle = $product['name'];
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="/index.php">Accueil</a> /
            <a href="/shop.php?brand=<?= e($product['brand_slug']) ?>"><?= e($product['brand_name']) ?></a> /
            <span><?= e($product['name']) ?></span>
        </div>
        <h1><?= e($product['name']) ?></h1>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="product-view">
            <div>
                <div class="gallery-main">
                    <img id="mainImage" src="/<?= e($images[0]['image_path']) ?>" alt="<?= e($product['name']) ?>">
                </div>
                <?php if (count($images) > 1): ?>
                <div class="gallery-thumbs">
                    <?php foreach ($images as $i => $img): ?>
                        <button type="button" class="<?= $i === 0 ? 'active' : '' ?>" onclick="document.getElementById('mainImage').src=this.querySelector('img').src; document.querySelectorAll('.gallery-thumbs button').forEach(b=>b.classList.remove('active')); this.classList.add('active');">
                            <img src="/<?= e($img['image_path']) ?>" alt="Vue <?= $i + 1 ?>">
                        </button>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="product-info">
                <span class="brand-tag"><?= e($product['brand_name']) ?></span>
                <h1><?= e($product['name']) ?></h1>
                <p class="desc"><?= e($product['short_description']) ?></p>

                <div class="price-block">
                    <span class="price"><?= formatPrice($product['price']) ?></span>
                    <?php if ($discount > 0): ?>
                        <span class="old-price"><?= formatPrice($product['old_price']) ?></span>
                        <span class="badge badge-sale">-<?= (int) $discount ?>%</span>
                    <?php endif; ?>
                </div>

                <p class="stock-line">
                    <?php if ($product['stock'] <= 0): ?>
                        <span class="stock-out"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Rupture de stock</span>
                    <?php elseif ($product['stock'] <= 5): ?>
                        <span class="stock-low"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg> Plus que <?= (int) $product['stock'] ?> en stock</span>
                    <?php else: ?>
                        <span class="stock-ok"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg> En stock</span>
                    <?php endif; ?>
                </p>

                <div class="spec-list">
                    <div><strong>Stockage</strong><?= e($product['storage'] ?: '-') ?></div>
                    <div><strong>Couleur</strong><?= e($product['color'] ?: '-') ?></div>
                    <div><strong>Marque</strong><?= e($product['brand_name']) ?></div>
                    <div><strong>Garantie</strong>12 mois</div>
                </div>

                <form action="/cart.php" method="post">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
                    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                    <div class="purchase-row">
                        <div class="qty-selector">
                            <button type="button" onclick="stepQty(-1)">-</button>
                            <input type="number" name="quantity" id="qtyInput" value="1" min="1" max="<?= (int) max(1, $product['stock']) ?>">
                            <button type="button" onclick="stepQty(1)">+</button>
                        </div>
                        <button type="submit" class="btn btn-primary" <?= $product['stock'] <= 0 ? 'disabled' : '' ?>>Ajouter au panier</button>
                        <a href="https://wa.me/<?= e(SITE_WHATSAPP) ?>?text=<?= urlencode('Bonjour, je suis interesse par : ' . $product['name']) ?>" class="btn btn-outline" target="_blank" rel="noopener">Commander via WhatsApp</a>
                    </div>
                </form>

                <div class="tabs">
                    <div class="tabs-nav">
                        <button type="button" class="active" onclick="showTab(this,'desc-panel')">Description</button>
                        <button type="button" onclick="showTab(this,'delivery-panel')">Livraison</button>
                        <button type="button" onclick="showTab(this,'warranty-panel')">Garantie</button>
                    </div>
                    <div id="desc-panel" class="tab-panel active"><?= nl2br(e($product['description'])) ?></div>
                    <div id="delivery-panel" class="tab-panel">Livraison en 24h a Cotonou et sous 48-72h dans les autres villes du Benin. Frais calcules a la commande selon la zone.</div>
                    <div id="warranty-panel" class="tab-panel">Tous les telephones Marado Store sont neufs et couverts par une garantie constructeur/revendeur de 12 mois.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($related)): ?>
<section class="section section-alt">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Vous aimerez aussi</span>
            <h2>Produits similaires</h2>
        </div>
        <div class="product-grid cols-4">
            <?php foreach ($related as $p): include __DIR__ . '/includes/product-card.php'; endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<script>
function stepQty(delta) {
    const input = document.getElementById('qtyInput');
    const max = parseInt(input.max || 99, 10);
    let val = parseInt(input.value || 1, 10) + delta;
    if (val < 1) val = 1;
    if (val > max) val = max;
    input.value = val;
}
function showTab(btn, panelId) {
    document.querySelectorAll('.tabs-nav button').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(panelId).classList.add('active');
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
