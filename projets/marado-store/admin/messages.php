<?php
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrfCheck()) {
    $id = (int) ($_POST['id'] ?? 0);
    if ($_POST['action'] === 'mark_read' && $id) {
        $db->prepare('UPDATE contact_messages SET is_read = 1 WHERE id = ?')->execute([$id]);
    } elseif ($_POST['action'] === 'delete' && $id) {
        $db->prepare('DELETE FROM contact_messages WHERE id = ?')->execute([$id]);
    }
    redirect('/admin/messages.php');
}

$messages = $db->query('SELECT * FROM contact_messages ORDER BY created_at DESC')->fetchAll();

$pageTitle = 'Messages de contact';
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-panel">
    <?php if (empty($messages)): ?>
        <p>Aucun message pour l'instant.</p>
    <?php endif; ?>
    <?php foreach ($messages as $m): ?>
        <div class="message-card <?= $m['is_read'] ? '' : 'unread' ?>">
            <div class="message-head">
                <div>
                    <strong><?= e($m['name']) ?></strong>
                    <span style="color:var(--color-text-light);font-size:13px;"> &lt;<?= e($m['email']) ?>&gt;</span>
                    <?php if ($m['subject']): ?><div style="font-size:13px;color:var(--color-text-light);">Sujet : <?= e($m['subject']) ?></div><?php endif; ?>
                </div>
                <span style="font-size:12px;color:var(--color-text-light);"><?= date('d/m/Y H:i', strtotime($m['created_at'])) ?></span>
            </div>
            <p><?= nl2br(e($m['message'])) ?></p>
            <div class="admin-row-actions">
                <?php if (!$m['is_read']): ?>
                <form method="post" action="/admin/messages.php">
                    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                    <input type="hidden" name="action" value="mark_read">
                    <input type="hidden" name="id" value="<?= (int) $m['id'] ?>">
                    <button type="submit">Marquer comme lu</button>
                </form>
                <?php endif; ?>
                <form method="post" action="/admin/messages.php" onsubmit="return confirm('Supprimer ce message ?');">
                    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= (int) $m['id'] ?>">
                    <button type="submit" class="remove-link">Supprimer</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
