<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="/index.php" class="logo"><img src="/assets/images/site/logo.svg" alt="<?= e(SITE_NAME) ?>"></a>
                <p><?= e(SITE_TAGLINE) ?>. Vente de smartphones neufs et garantis (iPhone, Samsung, Google) partout au Benin.</p>
                <div class="social-row">
                    <a href="https://wa.me/<?= e(SITE_WHATSAPP) ?>" aria-label="WhatsApp" target="_blank" rel="noopener"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91C21.96 6.45 17.5 2 12.04 2zm5.8 14.15c-.24.68-1.4 1.3-1.93 1.34-.5.05-1.02.24-3.4-.71-2.87-1.15-4.72-4.07-4.86-4.26-.14-.19-1.16-1.54-1.16-2.94 0-1.4.73-2.08.99-2.37.26-.28.56-.35.75-.35.19 0 .38 0 .54.01.18.01.41-.07.64.49.24.58.81 2 .88 2.15.07.14.12.31.02.5-.09.19-.14.31-.28.47-.14.17-.29.37-.42.5-.14.14-.28.29-.12.57.16.28.71 1.17 1.52 1.9 1.05.94 1.93 1.23 2.21 1.37.28.14.44.12.61-.07.16-.19.68-.79.87-1.06.19-.28.37-.23.62-.14.26.09 1.64.77 1.92.91.28.14.47.21.54.33.07.12.07.68-.17 1.36z"/></svg></a>
                    <a href="#" aria-label="Facebook"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.78-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99A10 10 0 0 0 22 12z"/></svg></a>
                    <a href="#" aria-label="Instagram"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
                </div>
            </div>
            <div>
                <h4>Boutique</h4>
                <ul>
                    <li><a href="/shop.php">Tous les produits</a></li>
                    <?php foreach (getAllBrands() as $b): ?>
                        <li><a href="/shop.php?brand=<?= e($b['slug']) ?>"><?= e($b['name']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <h4>Informations</h4>
                <ul>
                    <li><a href="/about.php">A propos de nous</a></li>
                    <li><a href="/contact.php">Contact</a></li>
                    <li><a href="/cart.php">Mon panier</a></li>
                </ul>
            </div>
            <div>
                <h4>Contact</h4>
                <ul>
                    <li><?= e(SITE_ADDRESS) ?></li>
                    <li><?= e(SITE_PHONE) ?></li>
                    <li><?= e(SITE_EMAIL) ?></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. Tous droits reserves.</span>
            <span>Paiement a la livraison &bull; Mobile Money</span>
        </div>
    </div>
</footer>
<script src="/assets/js/main.js"></script>
</body>
</html>
