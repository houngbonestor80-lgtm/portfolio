<?php
/**
 * Gestion du panier via la session PHP.
 * Structure : $_SESSION['cart'] = [ product_id => quantity, ... ]
 */

function cartInit(): void
{
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
}

function cartAdd(int $productId, int $qty = 1): void
{
    cartInit();
    $qty = max(1, $qty);
    $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + $qty;
}

function cartUpdate(int $productId, int $qty): void
{
    cartInit();
    if ($qty <= 0) {
        unset($_SESSION['cart'][$productId]);
    } else {
        $_SESSION['cart'][$productId] = $qty;
    }
}

function cartRemove(int $productId): void
{
    cartInit();
    unset($_SESSION['cart'][$productId]);
}

function cartClear(): void
{
    $_SESSION['cart'] = [];
}

/**
 * Retourne les lignes du panier avec les informations produit a jour depuis la BDD.
 * Enleve automatiquement les produits qui n'existent plus ou sont hors stock.
 */
function cartItems(): array
{
    cartInit();
    if (empty($_SESSION['cart'])) {
        return [];
    }

    $items = [];
    foreach ($_SESSION['cart'] as $productId => $qty) {
        $product = getProductById((int) $productId);
        if (!$product || !$product['is_active']) {
            unset($_SESSION['cart'][$productId]);
            continue;
        }
        $qty = min($qty, max(1, (int) $product['stock']));
        $items[] = [
            'product'  => $product,
            'quantity' => $qty,
            'subtotal' => $qty * (float) $product['price'],
        ];
    }

    return $items;
}

function cartCount(): int
{
    cartInit();
    return array_sum($_SESSION['cart']);
}

function cartTotal(): float
{
    $total = 0.0;
    foreach (cartItems() as $item) {
        $total += $item['subtotal'];
    }
    return $total;
}
