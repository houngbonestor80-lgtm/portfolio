<?php
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

$db = getDB();
$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);
$product = $id ? getProductById($id) : null;
$gallery = $id ? getProductGallery($id) : [];
$brands = getAllBrands();
$errors = [];

function slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function uploadImage(string $field, string $slug, string $suffix): ?string
{
    if (empty($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    $tmp = $_FILES[$field]['tmp_name'];
    $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) {
        return null;
    }
    $filename = $slug . '-' . $suffix . '-' . time() . '.' . $ext;
    $dest = __DIR__ . '/../assets/images/products/' . $filename;
    if (move_uploaded_file($tmp, $dest)) {
        return 'assets/images/products/' . $filename;
    }
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfCheck()) {
        $errors[] = 'Session expiree, merci de reessayer.';
    } else {
        $name = trim($_POST['name'] ?? '');
        $brandId = (int) ($_POST['brand_id'] ?? 0);
        $shortDesc = trim($_POST['short_description'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price = (float) ($_POST['price'] ?? 0);
        $oldPrice = $_POST['old_price'] !== '' ? (float) $_POST['old_price'] : null;
        $storage = trim($_POST['storage'] ?? '');
        $color = trim($_POST['color'] ?? '');
        $stock = (int) ($_POST['stock'] ?? 0);
        $isFeatured = !empty($_POST['is_featured']) ? 1 : 0;
        $isActive = !empty($_POST['is_active']) ? 1 : 0;

        if ($name === '') $errors[] = 'Le nom du produit est obligatoire.';
        if (!$brandId) $errors[] = 'La marque est obligatoire.';
        if ($price <= 0) $errors[] = 'Le prix doit etre superieur a 0.';

        $slug = slugify($name);

        if (empty($errors)) {
            if ($product) {
                $imagePath = $product['image_main'];
                $uploaded = uploadImage('image_main', $slug, 'main');
                if ($uploaded) $imagePath = $uploaded;

                $stmt = $db->prepare('UPDATE products SET brand_id=?, name=?, slug=?, short_description=?, description=?, price=?, old_price=?, storage=?, color=?, stock=?, image_main=?, is_featured=?, is_active=? WHERE id=?');
                $stmt->execute([$brandId, $name, $slug, $shortDesc, $description, $price, $oldPrice, $storage, $color, $stock, $imagePath, $isFeatured, $isActive, $product['id']]);
                $productId = $product['id'];
            } else {
                $imagePath = uploadImage('image_main', $slug, 'main') ?? 'assets/images/site/logo.svg';
                $stmt = $db->prepare('INSERT INTO products (brand_id, name, slug, short_description, description, price, old_price, storage, color, stock, image_main, is_featured, is_active) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
                $stmt->execute([$brandId, $name, $slug, $shortDesc, $description, $price, $oldPrice, $storage, $color, $stock, $imagePath, $isFeatured, $isActive]);
                $productId = (int) $db->lastInsertId();
            }

            foreach (['gallery_1', 'gallery_2'] as $field) {
                $uploaded = uploadImage($field, $slug, $field);
                if ($uploaded) {
                    $db->prepare('INSERT INTO product_images (product_id, image_path, sort_order) VALUES (?, ?, ?)')
                       ->execute([$productId, $uploaded, 9]);
                }
            }

            redirect('/admin/products.php');
        }
    }
}

$pageTitle = $product ? 'Modifier le produit' : 'Ajouter un produit';
require_once __DIR__ . '/includes/admin-header.php';
?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-error"><?php foreach ($errors as $err): ?><div><?= e($err) ?></div><?php endforeach; ?></div>
<?php endif; ?>

<div class="admin-panel">
    <form method="post" action="/admin/product-form.php<?= $product ? '?id=' . (int) $product['id'] : '' ?>" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
        <?php if ($product): ?><input type="hidden" name="id" value="<?= (int) $product['id'] ?>"><?php endif; ?>

        <div class="form-grid cols-2">
            <div class="form-field">
                <label>Nom du produit *</label>
                <input type="text" name="name" required value="<?= e($product['name'] ?? $_POST['name'] ?? '') ?>">
            </div>
            <div class="form-field">
                <label>Marque *</label>
                <select name="brand_id" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($brands as $b): $sel = ($product['brand_id'] ?? $_POST['brand_id'] ?? null) == $b['id']; ?>
                        <option value="<?= (int) $b['id'] ?>" <?= $sel ? 'selected' : '' ?>><?= e($b['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-field full">
                <label>Description courte</label>
                <input type="text" name="short_description" value="<?= e($product['short_description'] ?? $_POST['short_description'] ?? '') ?>">
            </div>
            <div class="form-field full">
                <label>Description complete</label>
                <textarea name="description" rows="4"><?= e($product['description'] ?? $_POST['description'] ?? '') ?></textarea>
            </div>
            <div class="form-field">
                <label>Prix (FCFA) *</label>
                <input type="number" step="1" min="0" name="price" required value="<?= e((string) ($product['price'] ?? $_POST['price'] ?? '')) ?>">
            </div>
            <div class="form-field">
                <label>Ancien prix (optionnel, pour promo)</label>
                <input type="number" step="1" min="0" name="old_price" value="<?= e((string) ($product['old_price'] ?? $_POST['old_price'] ?? '')) ?>">
            </div>
            <div class="form-field">
                <label>Stockage</label>
                <input type="text" name="storage" placeholder="128 Go" value="<?= e($product['storage'] ?? $_POST['storage'] ?? '') ?>">
            </div>
            <div class="form-field">
                <label>Couleur</label>
                <input type="text" name="color" placeholder="Noir" value="<?= e($product['color'] ?? $_POST['color'] ?? '') ?>">
            </div>
            <div class="form-field">
                <label>Stock (quantite)</label>
                <input type="number" min="0" name="stock" value="<?= e((string) ($product['stock'] ?? $_POST['stock'] ?? 0)) ?>">
            </div>
            <div class="form-field">
                <label>Options</label>
                <label style="display:flex;align-items:center;gap:8px;font-weight:400;">
                    <input type="checkbox" name="is_featured" value="1" <?= !empty($product['is_featured']) ? 'checked' : '' ?>> Produit vedette
                </label>
                <label style="display:flex;align-items:center;gap:8px;font-weight:400;margin-top:8px;">
                    <input type="checkbox" name="is_active" value="1" <?= ($product === null || !empty($product['is_active'])) ? 'checked' : '' ?>> Actif (visible sur le site)
                </label>
            </div>

            <div class="form-field full">
                <label>Photo principale <?= $product ? '(laisser vide pour conserver l\'image actuelle)' : '' ?></label>
                <?php if ($product): ?><img src="/<?= e($product['image_main']) ?>" class="admin-thumb" style="margin-bottom:10px;"><?php endif; ?>
                <input type="file" name="image_main" accept=".jpg,.jpeg,.png,.webp">
            </div>
            <div class="form-field">
                <label>Photo galerie 1 (optionnel)</label>
                <input type="file" name="gallery_1" accept=".jpg,.jpeg,.png,.webp">
            </div>
            <div class="form-field">
                <label>Photo galerie 2 (optionnel)</label>
                <input type="file" name="gallery_2" accept=".jpg,.jpeg,.png,.webp">
            </div>

            <?php if ($product && !empty($gallery)): ?>
            <div class="form-field full">
                <label>Galerie actuelle</label>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <?php foreach ($gallery as $g): ?>
                        <img src="/<?= e($g['image_path']) ?>" class="admin-thumb">
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div style="margin-top:24px;display:flex;gap:12px;">
            <button type="submit" class="btn btn-primary"><?= $product ? 'Enregistrer les modifications' : 'Creer le produit' ?></button>
            <a href="/admin/products.php" class="btn btn-outline">Annuler</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
