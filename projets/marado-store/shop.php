<?php
require_once __DIR__ . '/includes/init.php';

$filters = [
    'brand'     => $_GET['brand'] ?? '',
    'search'    => trim($_GET['search'] ?? ''),
    'max_price' => $_GET['max_price'] ?? '',
    'sort'      => $_GET['sort'] ?? 'newest',
];

$products = getProducts($filters);
$brands = getAllBrands();
$activeBrand = getBrandBySlug($filters['brand']);

$pageTitle = $activeBrand ? $activeBrand['name'] : 'Boutique';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Accueil</a> / <span><?= e($pageTitle) ?></span></div>
        <h1><?= $activeBrand ? 'Telephones ' . e($activeBrand['name']) : 'Toute la boutique' ?></h1>
    </div>
</div>
<?php include __DIR__ . '/includes/flash.php'; ?>

<section class="section">
    <div class="container">
        <div class="shop-layout">
            <aside class="filters-box">
                <form method="get" action="/shop.php" id="filterForm">
                    <div class="filter-group">
                        <h4>Marque</h4>
                        <label>
                            <input type="radio" name="brand" value="" <?= $filters['brand'] === '' ? 'checked' : '' ?> onchange="this.form.submit()">
                            Toutes les marques
                        </label>
                        <?php foreach ($brands as $b): ?>
                        <label>
                            <input type="radio" name="brand" value="<?= e($b['slug']) ?>" <?= $filters['brand'] === $b['slug'] ? 'checked' : '' ?> onchange="this.form.submit()">
                            <?= e($b['name']) ?>
                        </label>
                        <?php endforeach; ?>
                    </div>
                    <div class="filter-group">
                        <h4>Budget maximum</h4>
                        <label><input type="radio" name="max_price" value="" <?= $filters['max_price'] === '' ? 'checked' : '' ?> onchange="this.form.submit()"> Tous les budgets</label>
                        <label><input type="radio" name="max_price" value="350000" <?= $filters['max_price'] == 350000 ? 'checked' : '' ?> onchange="this.form.submit()"> Moins de 350 000 FCFA</label>
                        <label><input type="radio" name="max_price" value="600000" <?= $filters['max_price'] == 600000 ? 'checked' : '' ?> onchange="this.form.submit()"> Moins de 600 000 FCFA</label>
                        <label><input type="radio" name="max_price" value="900000" <?= $filters['max_price'] == 900000 ? 'checked' : '' ?> onchange="this.form.submit()"> Moins de 900 000 FCFA</label>
                    </div>
                    <?php if ($filters['search']): ?><input type="hidden" name="search" value="<?= e($filters['search']) ?>"><?php endif; ?>
                    <?php if ($filters['brand'] || $filters['max_price']): ?>
                        <a href="/shop.php" class="btn btn-outline btn-sm btn-block">Reinitialiser</a>
                    <?php endif; ?>
                </form>
            </aside>

            <div>
                <div class="toolbar">
                    <span><?= count($products) ?> produit(s) trouve(s)<?= $filters['search'] ? ' pour "' . e($filters['search']) . '"' : '' ?></span>
                    <form method="get" action="/shop.php" id="sortForm">
                        <?php if ($filters['brand']): ?><input type="hidden" name="brand" value="<?= e($filters['brand']) ?>"><?php endif; ?>
                        <?php if ($filters['max_price']): ?><input type="hidden" name="max_price" value="<?= e($filters['max_price']) ?>"><?php endif; ?>
                        <?php if ($filters['search']): ?><input type="hidden" name="search" value="<?= e($filters['search']) ?>"><?php endif; ?>
                        <select name="sort" onchange="this.form.submit()">
                            <option value="newest" <?= $filters['sort'] === 'newest' ? 'selected' : '' ?>>Nouveautes</option>
                            <option value="price_asc" <?= $filters['sort'] === 'price_asc' ? 'selected' : '' ?>>Prix croissant</option>
                            <option value="price_desc" <?= $filters['sort'] === 'price_desc' ? 'selected' : '' ?>>Prix decroissant</option>
                            <option value="name" <?= $filters['sort'] === 'name' ? 'selected' : '' ?>>Nom (A-Z)</option>
                        </select>
                    </form>
                </div>

                <?php if (empty($products)): ?>
                    <div class="empty-state">
                        <div class="icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></div>
                        <h3>Aucun produit trouve</h3>
                        <p>Essaie de modifier tes filtres ou ta recherche.</p>
                        <a href="/shop.php" class="btn btn-primary">Voir tous les produits</a>
                    </div>
                <?php else: ?>
                    <div class="product-grid cols-narrow">
                        <?php foreach ($products as $p): include __DIR__ . '/includes/product-card.php'; endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
