<?php
require_once __DIR__ . '/includes/init.php';

$flash = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfCheck()) {
        $flash = ['type' => 'error', 'text' => 'Session expiree, merci de reessayer.'];
    } else {
        $action = $_POST['action'] ?? '';
        $productId = (int) ($_POST['product_id'] ?? 0);

        if ($action === 'add' && $productId) {
            $product = getProductById($productId);
            if ($product && $product['stock'] > 0) {
                cartAdd($productId, max(1, (int) ($_POST['quantity'] ?? 1)));
                $flash = ['type' => 'success', 'text' => e($product['name']) . ' a ete ajoute au panier.'];
            }
        } elseif ($action === 'update' && $productId) {
            cartUpdate($productId, (int) ($_POST['quantity'] ?? 1));
        } elseif ($action === 'remove' && $productId) {
            cartRemove($productId);
        } elseif ($action === 'clear') {
            cartClear();
        }

        if (!empty($_POST['redirect_back']) && $action === 'add') {
            $_SESSION['flash'] = $flash;
            redirect($_POST['redirect_back']);
        }
    }
}

$items = cartItems();
$total = cartTotal();

if (empty($flash) && !empty($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

$pageTitle = 'Mon panier';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Accueil</a> / <span>Mon panier</span></div>
        <h1>Mon panier</h1>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if ($flash): ?>
            <div class="alert alert-<?= e($flash['type']) ?>"><?= $flash['text'] ?></div>
        <?php endif; ?>

        <?php if (empty($items)): ?>
            <div class="empty-state">
                <div class="icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg></div>
                <h3>Ton panier est vide</h3>
                <p>Parcours notre boutique pour trouver le telephone qu'il te faut.</p>
                <a href="/shop.php" class="btn btn-primary">Voir la boutique</a>
            </div>
        <?php else: ?>
            <div class="cart-layout">
                <div>
                    <table class="cart-table">
                        <thead>
                            <tr><th>Produit</th><th>Prix</th><th>Quantite</th><th>Sous-total</th><th></th></tr>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $item): $p = $item['product']; ?>
                            <tr>
                                <td>
                                    <div class="cart-product">
                                        <img src="/<?= e($p['image_main']) ?>" alt="<?= e($p['name']) ?>">
                                        <div>
                                            <strong><?= e($p['name']) ?></strong>
                                            <span><?= e($p['color'] ?: '') ?><?= $p['storage'] ? ' &bull; ' . e($p['storage']) : '' ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td><?= formatPrice($p['price']) ?></td>
                                <td>
                                    <form action="/cart.php" method="post" class="qty-form">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="product_id" value="<?= (int) $p['id'] ?>">
                                        <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                                        <div class="qty-selector">
                                            <button type="button" onclick="cartStep(this,-1)">-</button>
                                            <input type="number" name="quantity" value="<?= (int) $item['quantity'] ?>" min="1" max="<?= (int) max(1,$p['stock']) ?>" onchange="this.form.submit()">
                                            <button type="button" onclick="cartStep(this,1)">+</button>
                                        </div>
                                    </form>
                                </td>
                                <td><strong><?= formatPrice($item['subtotal']) ?></strong></td>
                                <td>
                                    <form action="/cart.php" method="post">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="product_id" value="<?= (int) $p['id'] ?>">
                                        <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                                        <button type="submit" class="remove-link">Retirer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div style="margin-top:20px;">
                        <a href="/shop.php" class="btn btn-outline">&larr; Continuer mes achats</a>
                    </div>
                </div>

                <div class="summary-box">
                    <h3>Recapitulatif</h3>
                    <div class="summary-row"><span>Sous-total</span><span><?= formatPrice($total) ?></span></div>
                    <div class="summary-row"><span>Livraison</span><span>Calculee a la commande</span></div>
                    <div class="summary-row total"><span>Total</span><span><?= formatPrice($total) ?></span></div>
                    <a href="/checkout.php" class="btn btn-primary btn-block">Passer la commande</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
function cartStep(btn, delta) {
    const form = btn.closest('form');
    const input = form.querySelector('input[name=quantity]');
    const max = parseInt(input.max || 99, 10);
    let val = parseInt(input.value || 1, 10) + delta;
    if (val < 1) val = 1;
    if (val > max) val = max;
    input.value = val;
    form.submit();
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
