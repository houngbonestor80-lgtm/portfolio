<?php
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

$db = getDB();

$totalProducts = (int) $db->query('SELECT COUNT(*) FROM products')->fetchColumn();
$totalOrders = (int) $db->query('SELECT COUNT(*) FROM orders')->fetchColumn();
$pendingOrders = (int) $db->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetchColumn();
$revenue = (float) $db->query("SELECT COALESCE(SUM(total_amount),0) FROM orders WHERE status != 'cancelled'")->fetchColumn();
$lowStock = $db->query('SELECT * FROM products WHERE stock <= 5 AND is_active = 1 ORDER BY stock ASC LIMIT 5')->fetchAll();
$recentOrders = $db->query('SELECT * FROM orders ORDER BY created_at DESC LIMIT 6')->fetchAll();

$statusLabels = [
    'pending' => 'En attente', 'confirmed' => 'Confirmee', 'shipped' => 'Expediee',
    'delivered' => 'Livree', 'cancelled' => 'Annulee',
];

$pageTitle = 'Tableau de bord';
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="stat-grid">
    <div class="stat-card">
        <span class="stat-label">Produits</span>
        <span class="stat-value"><?= $totalProducts ?></span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Commandes totales</span>
        <span class="stat-value"><?= $totalOrders ?></span>
    </div>
    <div class="stat-card accent">
        <span class="stat-label">Commandes en attente</span>
        <span class="stat-value"><?= $pendingOrders ?></span>
    </div>
    <div class="stat-card success">
        <span class="stat-label">Chiffre d'affaires</span>
        <span class="stat-value"><?= formatPrice($revenue) ?></span>
    </div>
</div>

<div class="admin-grid-2">
    <div class="admin-panel">
        <h3>Dernieres commandes</h3>
        <table class="admin-table">
            <thead><tr><th>Reference</th><th>Client</th><th>Total</th><th>Statut</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($recentOrders as $o): ?>
                <tr>
                    <td><?= e($o['order_ref']) ?></td>
                    <td><?= e($o['customer_name']) ?></td>
                    <td><?= formatPrice($o['total_amount']) ?></td>
                    <td><span class="status-pill status-<?= e($o['status']) ?>"><?= e($statusLabels[$o['status']] ?? $o['status']) ?></span></td>
                    <td><a href="/admin/order-view.php?id=<?= (int) $o['id'] ?>">Voir</a></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($recentOrders)): ?><tr><td colspan="5">Aucune commande pour l'instant.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="admin-panel">
        <h3>Stock faible</h3>
        <table class="admin-table">
            <thead><tr><th>Produit</th><th>Stock</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($lowStock as $p): ?>
                <tr>
                    <td><?= e($p['name']) ?></td>
                    <td><span class="badge badge-low"><?= (int) $p['stock'] ?> restant(s)</span></td>
                    <td><a href="/admin/product-form.php?id=<?= (int) $p['id'] ?>">Modifier</a></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($lowStock)): ?><tr><td colspan="3">Aucun produit en stock faible.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
