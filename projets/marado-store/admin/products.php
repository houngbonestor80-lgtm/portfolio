<?php
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrfCheck()) {
    $action = $_POST['action'] ?? '';
    $id = (int) ($_POST['id'] ?? 0);

    if ($action === 'toggle_active' && $id) {
        $db->prepare('UPDATE products SET is_active = 1 - is_active WHERE id = ?')->execute([$id]);
    } elseif ($action === 'toggle_featured' && $id) {
        $db->prepare('UPDATE products SET is_featured = 1 - is_featured WHERE id = ?')->execute([$id]);
    } elseif ($action === 'delete' && $id) {
        $db->prepare('DELETE FROM products WHERE id = ?')->execute([$id]);
    }
    redirect('/admin/products.php');
}

$brandFilter = $_GET['brand'] ?? '';
$sql = 'SELECT p.*, b.name AS brand_name FROM products p JOIN brands b ON b.id = p.brand_id';
$params = [];
if ($brandFilter) {
    $sql .= ' WHERE b.slug = ?';
    $params[] = $brandFilter;
}
$sql .= ' ORDER BY p.created_at DESC';
$stmt = $db->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

$brands = getAllBrands();

$pageTitle = 'Produits';
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-toolbar">
    <div class="filter-pills">
        <a href="/admin/products.php" class="pill <?= $brandFilter === '' ? 'active' : '' ?>">Tous</a>
        <?php foreach ($brands as $b): ?>
            <a href="/admin/products.php?brand=<?= e($b['slug']) ?>" class="pill <?= $brandFilter === $b['slug'] ? 'active' : '' ?>"><?= e($b['name']) ?></a>
        <?php endforeach; ?>
    </div>
    <a href="/admin/product-form.php" class="btn btn-primary">+ Ajouter un produit</a>
</div>

<div class="admin-panel">
    <table class="admin-table">
        <thead>
            <tr><th>Image</th><th>Nom</th><th>Marque</th><th>Prix</th><th>Stock</th><th>Statut</th><th>Vedette</th><th></th></tr>
        </thead>
        <tbody>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><img src="/<?= e($p['image_main']) ?>" alt="" class="admin-thumb"></td>
                <td><?= e($p['name']) ?></td>
                <td><?= e($p['brand_name']) ?></td>
                <td><?= formatPrice($p['price']) ?></td>
                <td><?= (int) $p['stock'] ?></td>
                <td>
                    <form method="post" action="/admin/products.php">
                        <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                        <input type="hidden" name="action" value="toggle_active">
                        <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                        <button type="submit" class="badge <?= $p['is_active'] ? 'badge-new' : 'badge-out' ?>" style="border:none;cursor:pointer;">
                            <?= $p['is_active'] ? 'Actif' : 'Masque' ?>
                        </button>
                    </form>
                </td>
                <td>
                    <form method="post" action="/admin/products.php">
                        <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                        <input type="hidden" name="action" value="toggle_featured">
                        <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                        <button type="submit" class="badge <?= $p['is_featured'] ? 'badge-sale' : 'badge-out' ?>" style="border:none;cursor:pointer;">
                            <?= $p['is_featured'] ? 'Oui' : 'Non' ?>
                        </button>
                    </form>
                </td>
                <td class="admin-row-actions">
                    <a href="/admin/product-form.php?id=<?= (int) $p['id'] ?>">Modifier</a>
                    <form method="post" action="/admin/products.php" onsubmit="return confirm('Supprimer ce produit definitivement ?');">
                        <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                        <button type="submit" class="remove-link">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($products)): ?><tr><td colspan="8">Aucun produit.</td></tr><?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
