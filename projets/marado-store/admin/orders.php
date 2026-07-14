<?php
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

$db = getDB();
$statusFilter = $_GET['status'] ?? '';
$statusLabels = [
    'pending' => 'En attente', 'confirmed' => 'Confirmee', 'shipped' => 'Expediee',
    'delivered' => 'Livree', 'cancelled' => 'Annulee',
];

$sql = 'SELECT * FROM orders';
$params = [];
if ($statusFilter && isset($statusLabels[$statusFilter])) {
    $sql .= ' WHERE status = ?';
    $params[] = $statusFilter;
}
$sql .= ' ORDER BY created_at DESC';
$stmt = $db->prepare($sql);
$stmt->execute($params);
$orders = $stmt->fetchAll();

$pageTitle = 'Commandes';
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-toolbar">
    <div class="filter-pills">
        <a href="/admin/orders.php" class="pill <?= $statusFilter === '' ? 'active' : '' ?>">Toutes</a>
        <?php foreach ($statusLabels as $key => $label): ?>
            <a href="/admin/orders.php?status=<?= e($key) ?>" class="pill <?= $statusFilter === $key ? 'active' : '' ?>"><?= e($label) ?></a>
        <?php endforeach; ?>
    </div>
</div>

<div class="admin-panel">
    <table class="admin-table">
        <thead><tr><th>Reference</th><th>Client</th><th>Ville</th><th>Total</th><th>Paiement</th><th>Statut</th><th>Date</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($orders as $o): ?>
            <tr>
                <td><?= e($o['order_ref']) ?></td>
                <td><?= e($o['customer_name']) ?><br><span style="color:var(--color-text-light);font-size:12px;"><?= e($o['phone']) ?></span></td>
                <td><?= e($o['city']) ?></td>
                <td><?= formatPrice($o['total_amount']) ?></td>
                <td><?= $o['payment_method'] === 'cod' ? 'A la livraison' : 'Mobile Money' ?></td>
                <td><span class="status-pill status-<?= e($o['status']) ?>"><?= e($statusLabels[$o['status']] ?? $o['status']) ?></span></td>
                <td><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></td>
                <td><a href="/admin/order-view.php?id=<?= (int) $o['id'] ?>">Voir</a></td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($orders)): ?><tr><td colspan="8">Aucune commande.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
