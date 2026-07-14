<?php
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

$db = getDB();
$id = (int) ($_GET['id'] ?? 0);

$stmt = $db->prepare('SELECT * FROM orders WHERE id = ?');
$stmt->execute([$id]);
$order = $stmt->fetch();

if (!$order) {
    redirect('/admin/orders.php');
}

$statusLabels = [
    'pending' => 'En attente', 'confirmed' => 'Confirmee', 'shipped' => 'Expediee',
    'delivered' => 'Livree', 'cancelled' => 'Annulee',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrfCheck()) {
    $newStatus = $_POST['status'] ?? '';
    if (isset($statusLabels[$newStatus])) {
        $db->prepare('UPDATE orders SET status = ? WHERE id = ?')->execute([$newStatus, $id]);
        redirect('/admin/order-view.php?id=' . $id);
    }
}

$itemsStmt = $db->prepare('SELECT * FROM order_items WHERE order_id = ?');
$itemsStmt->execute([$id]);
$items = $itemsStmt->fetchAll();

$pageTitle = 'Commande ' . $order['order_ref'];
require_once __DIR__ . '/includes/admin-header.php';
?>

<a href="/admin/orders.php" class="back-link" style="display:inline-block;margin-bottom:16px;">&larr; Retour aux commandes</a>

<div class="admin-grid-2">
    <div class="admin-panel">
        <h3>Articles commandes</h3>
        <table class="admin-table">
            <thead><tr><th>Produit</th><th>Prix unitaire</th><th>Qte</th><th>Sous-total</th></tr></thead>
            <tbody>
            <?php foreach ($items as $it): ?>
                <tr>
                    <td><?= e($it['product_name']) ?></td>
                    <td><?= formatPrice($it['unit_price']) ?></td>
                    <td><?= (int) $it['quantity'] ?></td>
                    <td><?= formatPrice($it['unit_price'] * $it['quantity']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="summary-row total" style="margin-top:16px;"><span>Total</span><span><?= formatPrice($order['total_amount']) ?></span></div>
    </div>

    <div class="admin-panel">
        <h3>Informations client</h3>
        <p><strong>Nom :</strong> <?= e($order['customer_name']) ?></p>
        <p><strong>Telephone :</strong> <?= e($order['phone']) ?></p>
        <?php if ($order['email']): ?><p><strong>Email :</strong> <?= e($order['email']) ?></p><?php endif; ?>
        <p><strong>Ville :</strong> <?= e($order['city']) ?></p>
        <p><strong>Adresse :</strong> <?= nl2br(e($order['address'])) ?></p>
        <?php if ($order['notes']): ?><p><strong>Note :</strong> <?= nl2br(e($order['notes'])) ?></p><?php endif; ?>
        <p><strong>Paiement :</strong> <?= $order['payment_method'] === 'cod' ? 'A la livraison' : 'Mobile Money' ?></p>
        <p><strong>Date :</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>

        <form method="post" action="/admin/order-view.php?id=<?= (int) $order['id'] ?>" style="margin-top:20px;">
            <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
            <div class="form-field">
                <label>Statut de la commande</label>
                <select name="status" onchange="this.form.submit()">
                    <?php foreach ($statusLabels as $key => $label): ?>
                        <option value="<?= e($key) ?>" <?= $order['status'] === $key ? 'selected' : '' ?>><?= e($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
