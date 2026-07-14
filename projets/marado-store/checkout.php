<?php
require_once __DIR__ . '/includes/init.php';

$items = cartItems();
$total = cartTotal();

if (empty($items)) {
    redirect('/cart.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfCheck()) {
        $errors[] = 'Session expiree, merci de reessayer.';
    } else {
        $name = trim($_POST['customer_name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $city = trim($_POST['city'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $payment = $_POST['payment_method'] ?? 'cod';
        $notes = trim($_POST['notes'] ?? '');

        if ($name === '') $errors[] = 'Le nom complet est obligatoire.';
        if ($phone === '') $errors[] = 'Le numero de telephone est obligatoire.';
        if ($city === '') $errors[] = 'La ville est obligatoire.';
        if ($address === '') $errors[] = 'L\'adresse de livraison est obligatoire.';
        if (!in_array($payment, ['cod', 'mobile_money'], true)) $errors[] = 'Mode de paiement invalide.';

        if (empty($errors)) {
            $db = getDB();
            $db->beginTransaction();
            try {
                $ref = generateOrderRef();
                $stmt = $db->prepare('INSERT INTO orders (order_ref, customer_name, phone, email, city, address, payment_method, notes, total_amount, status)
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, "pending")');
                $stmt->execute([$ref, $name, $phone, $email ?: null, $city, $address, $payment, $notes ?: null, $total]);
                $orderId = (int) $db->lastInsertId();

                $itemStmt = $db->prepare('INSERT INTO order_items (order_id, product_id, product_name, unit_price, quantity) VALUES (?, ?, ?, ?, ?)');
                $stockStmt = $db->prepare('UPDATE products SET stock = GREATEST(stock - ?, 0) WHERE id = ?');
                foreach ($items as $item) {
                    $p = $item['product'];
                    $itemStmt->execute([$orderId, $p['id'], $p['name'], $p['price'], $item['quantity']]);
                    $stockStmt->execute([$item['quantity'], $p['id']]);
                }

                $db->commit();
                cartClear();
                redirect('/order-success.php?ref=' . urlencode($ref));
            } catch (Exception $e) {
                $db->rollBack();
                $errors[] = 'Une erreur est survenue lors de l\'enregistrement de la commande. Merci de reessayer.';
            }
        }
    }
}

$pageTitle = 'Finaliser la commande';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Accueil</a> / <a href="/cart.php">Panier</a> / <span>Commande</span></div>
        <h1>Finaliser la commande</h1>
    </div>
</div>

<section class="section">
    <div class="container">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $err): ?><div><?= e($err) ?></div><?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="cart-layout">
            <form method="post" action="/checkout.php">
                <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                <h3 style="margin-bottom:18px;">Informations de livraison</h3>
                <div class="form-grid cols-2">
                    <div class="form-field">
                        <label>Nom complet *</label>
                        <input type="text" name="customer_name" required value="<?= e($_POST['customer_name'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label>Telephone *</label>
                        <input type="tel" name="phone" required value="<?= e($_POST['phone'] ?? '') ?>" placeholder="+229 ...">
                    </div>
                    <div class="form-field">
                        <label>Email (optionnel)</label>
                        <input type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>">
                    </div>
                    <div class="form-field">
                        <label>Ville *</label>
                        <input type="text" name="city" required value="<?= e($_POST['city'] ?? '') ?>" placeholder="Cotonou, Porto-Novo...">
                    </div>
                    <div class="form-field full">
                        <label>Adresse de livraison *</label>
                        <textarea name="address" rows="3" required><?= e($_POST['address'] ?? '') ?></textarea>
                    </div>
                    <div class="form-field full">
                        <label>Note pour la livraison (optionnel)</label>
                        <textarea name="notes" rows="2"><?= e($_POST['notes'] ?? '') ?></textarea>
                    </div>
                </div>

                <h3 style="margin:26px 0 14px;">Mode de paiement</h3>
                <div class="payment-options">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="cod" checked>
                        <div><strong>Paiement a la livraison</strong><br><span style="font-size:13px;color:var(--color-text-light)">Payez en especes a la reception de votre commande.</span></div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="mobile_money">
                        <div><strong>Mobile Money</strong><br><span style="font-size:13px;color:var(--color-text-light)">Notre equipe vous contactera pour finaliser le paiement.</span></div>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-block" style="margin-top:26px;">Confirmer la commande</button>
            </form>

            <div class="summary-box">
                <h3>Votre commande</h3>
                <?php foreach ($items as $item): $p = $item['product']; ?>
                    <div class="summary-row">
                        <span><?= (int) $item['quantity'] ?> &times; <?= e($p['name']) ?></span>
                        <span><?= formatPrice($item['subtotal']) ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="summary-row total"><span>Total</span><span><?= formatPrice($total) ?></span></div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
