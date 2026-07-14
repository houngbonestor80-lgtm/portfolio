<?php
require_once __DIR__ . '/includes/init.php';

$ref = $_GET['ref'] ?? '';
if ($ref === '') {
    redirect('/index.php');
}

$stmt = getDB()->prepare('SELECT * FROM orders WHERE order_ref = ?');
$stmt->execute([$ref]);
$order = $stmt->fetch();

if (!$order) {
    redirect('/index.php');
}

$itemsStmt = getDB()->prepare('SELECT * FROM order_items WHERE order_id = ?');
$itemsStmt->execute([$order['id']]);
$orderItems = $itemsStmt->fetchAll();

$pageTitle = 'Commande confirmee';
require_once __DIR__ . '/includes/header.php';
?>

<section class="section">
    <div class="container">
        <div class="empty-state">
            <div class="icon">&#9989;</div>
            <h3>Merci <?= e($order['customer_name']) ?>, ta commande est confirmee !</h3>
            <p>Numero de commande : <strong><?= e($order['order_ref']) ?></strong><br>
            Notre equipe te contactera au <?= e($order['phone']) ?> pour organiser la livraison a <?= e($order['city']) ?>.</p>

            <div class="summary-box" style="max-width:480px;margin:30px auto;text-align:left;">
                <h3>Recapitulatif</h3>
                <?php foreach ($orderItems as $it): ?>
                    <div class="summary-row">
                        <span><?= (int) $it['quantity'] ?> &times; <?= e($it['product_name']) ?></span>
                        <span><?= formatPrice($it['unit_price'] * $it['quantity']) ?></span>
                    </div>
                <?php endforeach; ?>
                <div class="summary-row total"><span>Total</span><span><?= formatPrice($order['total_amount']) ?></span></div>
            </div>

            <a href="/shop.php" class="btn btn-primary">Continuer mes achats</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
