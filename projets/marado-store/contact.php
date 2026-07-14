<?php
require_once __DIR__ . '/includes/init.php';

$sent = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfCheck()) {
        $errors[] = 'Session expiree, merci de reessayer.';
    } else {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($name === '') $errors[] = 'Le nom est obligatoire.';
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Adresse email invalide.';
        if ($message === '') $errors[] = 'Le message est obligatoire.';

        if (empty($errors)) {
            $stmt = getDB()->prepare('INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)');
            $stmt->execute([$name, $email, $subject ?: null, $message]);
            $sent = true;
        }
    }
}

$pageTitle = 'Contact';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Accueil</a> / <span>Contact</span></div>
        <h1>Contactez-nous</h1>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info-card">
                <div class="row">
                    <span class="icon">&#128205;</span>
                    <div><strong>Adresse</strong><br><?= e(SITE_ADDRESS) ?></div>
                </div>
                <div class="row">
                    <span class="icon">&#128222;</span>
                    <div><strong>Telephone</strong><br><?= e(SITE_PHONE) ?></div>
                </div>
                <div class="row">
                    <span class="icon">&#9993;</span>
                    <div><strong>Email</strong><br><?= e(SITE_EMAIL) ?></div>
                </div>
                <div class="row">
                    <span class="icon">&#128241;</span>
                    <div><strong>WhatsApp</strong><br><a href="https://wa.me/<?= e(SITE_WHATSAPP) ?>" target="_blank" rel="noopener">Discuter maintenant</a></div>
                </div>
            </div>

            <div>
                <?php if ($sent): ?>
                    <div class="alert alert-success">Merci ! Ton message a bien ete envoye, nous te repondrons rapidement.</div>
                <?php endif; ?>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-error"><?php foreach ($errors as $err): ?><div><?= e($err) ?></div><?php endforeach; ?></div>
                <?php endif; ?>

                <form method="post" action="/contact.php">
                    <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
                    <div class="form-grid cols-2">
                        <div class="form-field">
                            <label>Nom *</label>
                            <input type="text" name="name" required value="<?= e($_POST['name'] ?? '') ?>">
                        </div>
                        <div class="form-field">
                            <label>Email *</label>
                            <input type="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>">
                        </div>
                        <div class="form-field full">
                            <label>Sujet</label>
                            <input type="text" name="subject" value="<?= e($_POST['subject'] ?? '') ?>">
                        </div>
                        <div class="form-field full">
                            <label>Message *</label>
                            <textarea name="message" rows="6" required><?= e($_POST['message'] ?? '') ?></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top:20px;">Envoyer le message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
