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
                    <span class="icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
                    <div><strong>Adresse</strong><br><?= e(SITE_ADDRESS) ?></div>
                </div>
                <div class="row">
                    <span class="icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                    <div><strong>Telephone</strong><br><?= e(SITE_PHONE) ?></div>
                </div>
                <div class="row">
                    <span class="icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
                    <div><strong>Email</strong><br><?= e(SITE_EMAIL) ?></div>
                </div>
                <div class="row">
                    <span class="icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91C21.96 6.45 17.5 2 12.04 2zm5.8 14.15c-.24.68-1.4 1.3-1.93 1.34-.5.05-1.02.24-3.4-.71-2.87-1.15-4.72-4.07-4.86-4.26-.14-.19-1.16-1.54-1.16-2.94 0-1.4.73-2.08.99-2.37.26-.28.56-.35.75-.35.19 0 .38 0 .54.01.18.01.41-.07.64.49.24.58.81 2 .88 2.15.07.14.12.31.02.5-.09.19-.14.31-.28.47-.14.17-.29.37-.42.5-.14.14-.28.29-.12.57.16.28.71 1.17 1.52 1.9 1.05.94 1.93 1.23 2.21 1.37.28.14.44.12.61-.07.16-.19.68-.79.87-1.06.19-.28.37-.23.62-.14.26.09 1.64.77 1.92.91.28.14.47.21.54.33.07.12.07.68-.17 1.36z"/></svg></span>
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
