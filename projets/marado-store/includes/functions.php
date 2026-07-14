<?php
/**
 * Fonctions utilitaires partagees par tout le site.
 */

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function formatPrice($amount): string
{
    return number_format((float) $amount, 0, ',', ' ') . ' ' . CURRENCY;
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function currentUrl(): string
{
    return $_SERVER['REQUEST_URI'] ?? '/';
}

function isActivePage(string $file): string
{
    return basename($_SERVER['SCRIPT_NAME']) === $file ? 'active' : '';
}

function generateOrderRef(): string
{
    return 'MS' . date('ymd') . strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));
}

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrfCheck(): bool
{
    return isset($_POST['csrf_token'], $_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
}

/* ---------------------------------------------------------
   Requetes produits / marques
--------------------------------------------------------- */

function getAllBrands(): array
{
    $stmt = getDB()->query('SELECT * FROM brands ORDER BY name');
    return $stmt->fetchAll();
}

function getBrandBySlug(string $slug): ?array
{
    $stmt = getDB()->prepare('SELECT * FROM brands WHERE slug = ?');
    $stmt->execute([$slug]);
    $brand = $stmt->fetch();
    return $brand ?: null;
}

function getFeaturedProducts(int $limit = 8): array
{
    $stmt = getDB()->prepare('SELECT p.*, b.name AS brand_name, b.slug AS brand_slug
                               FROM products p JOIN brands b ON b.id = p.brand_id
                               WHERE p.is_featured = 1 AND p.is_active = 1
                               ORDER BY p.created_at DESC LIMIT ?');
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProducts(array $filters = []): array
{
    $sql = 'SELECT p.*, b.name AS brand_name, b.slug AS brand_slug
            FROM products p JOIN brands b ON b.id = p.brand_id
            WHERE p.is_active = 1';
    $params = [];

    if (!empty($filters['brand'])) {
        $sql .= ' AND b.slug = ?';
        $params[] = $filters['brand'];
    }

    if (!empty($filters['search'])) {
        $sql .= ' AND (p.name LIKE ? OR p.short_description LIKE ?)';
        $like = '%' . $filters['search'] . '%';
        $params[] = $like;
        $params[] = $like;
    }

    if (!empty($filters['max_price'])) {
        $sql .= ' AND p.price <= ?';
        $params[] = $filters['max_price'];
    }

    $sort = $filters['sort'] ?? 'newest';
    $sql .= match ($sort) {
        'price_asc'  => ' ORDER BY p.price ASC',
        'price_desc' => ' ORDER BY p.price DESC',
        'name'       => ' ORDER BY p.name ASC',
        default      => ' ORDER BY p.created_at DESC',
    };

    $stmt = getDB()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function getProductBySlug(string $slug): ?array
{
    $stmt = getDB()->prepare('SELECT p.*, b.name AS brand_name, b.slug AS brand_slug
                               FROM products p JOIN brands b ON b.id = p.brand_id
                               WHERE p.slug = ? AND p.is_active = 1');
    $stmt->execute([$slug]);
    $product = $stmt->fetch();
    return $product ?: null;
}

function getProductById(int $id): ?array
{
    $stmt = getDB()->prepare('SELECT p.*, b.name AS brand_name, b.slug AS brand_slug
                               FROM products p JOIN brands b ON b.id = p.brand_id
                               WHERE p.id = ?');
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    return $product ?: null;
}

function getProductGallery(int $productId): array
{
    $stmt = getDB()->prepare('SELECT * FROM product_images WHERE product_id = ? ORDER BY sort_order');
    $stmt->execute([$productId]);
    return $stmt->fetchAll();
}

function getRelatedProducts(int $brandId, int $excludeId, int $limit = 4): array
{
    $stmt = getDB()->prepare('SELECT p.*, b.name AS brand_name, b.slug AS brand_slug
                               FROM products p JOIN brands b ON b.id = p.brand_id
                               WHERE p.brand_id = ? AND p.id != ? AND p.is_active = 1
                               ORDER BY p.created_at DESC LIMIT ?');
    $stmt->bindValue(1, $brandId, PDO::PARAM_INT);
    $stmt->bindValue(2, $excludeId, PDO::PARAM_INT);
    $stmt->bindValue(3, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}
