<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="/index.php" class="logo"><img src="/assets/images/site/logo.svg" alt="<?= e(SITE_NAME) ?>"></a>
                <p><?= e(SITE_TAGLINE) ?>. Vente de smartphones neufs et garantis (iPhone, Samsung, Google) partout au Benin.</p>
                <div class="social-row">
                    <a href="https://wa.me/<?= e(SITE_WHATSAPP) ?>" aria-label="WhatsApp" target="_blank" rel="noopener">&#128241;</a>
                    <a href="#" aria-label="Facebook">&#102;</a>
                    <a href="#" aria-label="Instagram">&#105;</a>
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
