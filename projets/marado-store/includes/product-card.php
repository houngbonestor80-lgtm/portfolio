<?php

$discount = 0;
if (!empty($p['old_price']) && $p['old_price'] > $p['price']) {
    $discount = round((($p['old_price'] - $p['price']) / $p['old_price']) * 100);
}
$outOfStock = (int) $p['stock'] <= 0;
?>
<div class="product-card">
    <div class="thumb">
        <div class="badges">
            <?php if ($discount > 0): ?><span class="badge badge-sale">-<?= (int) $discount ?>%</span><?php endif; ?>
            <?php if (!empty($p['is_featured'])): ?><span class="badge badge-new">Vedette</span><?php endif; ?>
            <?php if (!$outOfStock && $p['stock'] <= 5): ?><span class="badge badge-low">Stock faible</span><?php endif; ?>
            <?php if ($outOfStock): ?><span class="badge badge-out">Epuise</span><?php endif; ?>
        </div>
        <a href="/product.php?slug=<?= e($p['slug']) ?>">
            <img src="/<?= e($p['image_main']) ?>" alt="<?= e($p['name']) ?>" loading="lazy">
        </a>
    </div>
    <div class="info">
        <span class="brand-tag"><?= e($p['brand_name']) ?></span>
        <h3><a href="/product.php?slug=<?= e($p['slug']) ?>"><?= e($p['name']) ?></a></h3>
        <p class="desc"><?= e($p['short_description']) ?></p>
        <div class="price-row">
            <span class="price"><?= formatPrice($p['price']) ?></span>
            <?php if ($discount > 0): ?><span class="old-price"><?= formatPrice($p['old_price']) ?></span><?php endif; ?>
        </div>
        <div class="card-actions">
            <a href="/product.php?slug=<?= e($p['slug']) ?>" class="btn btn-outline">Details</a>
            <form action="/cart.php" method="post" style="flex:1;">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_id" value="<?= (int) $p['id'] ?>">
                <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                <input type="hidden" name="redirect_back" value="<?= e(currentUrl()) ?>">
                <button type="submit" class="btn btn-primary btn-block" <?= $outOfStock ? 'disabled' : '' ?>>Ajouter</button>
            </form>
        </div>
    </div>
</div>
