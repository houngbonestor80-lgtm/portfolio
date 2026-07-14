<?php
/**
 * Authentification admin. A inclure apres includes/init.php.
 */

function isAdminLoggedIn(): bool
{
    return !empty($_SESSION['admin_id']);
}

function requireAdmin(): void
{
    if (!isAdminLoggedIn()) {
        redirect('/admin/login.php');
    }
}

function attemptAdminLogin(string $username, string $password): bool
{
    $stmt = getDB()->prepare('SELECT * FROM admin_users WHERE username = ?');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['full_name'] ?: $admin['username'];
        return true;
    }

    return false;
}
