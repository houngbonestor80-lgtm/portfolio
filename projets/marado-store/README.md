# Marado Store

Boutique en ligne PHP + MySQL pour la vente de smartphones (iPhone, Samsung Galaxy, Google Pixel), avec panier, tunnel de commande et panneau d'administration complet.

## Fonctionnalites

- Vitrine (accueil, boutique avec filtres marque/prix/tri, fiche produit avec galerie)
- Panier en session + tunnel de commande (paiement a la livraison ou Mobile Money)
- Panneau admin : tableau de bord, gestion des produits (CRUD + upload photo), gestion des commandes (statuts), messages de contact
- Design responsive, professionnel, propre pour mobile/tablette/desktop
- Photos produits reelles (libres de droits, Pexels) pour chaque telephone (vue face / dos / angle)

## Prerequis

- PHP 8+ avec l'extension PDO MySQL
- MySQL / MariaDB (WampServer, XAMPP, Laragon...)

## Installation

1. **Base de donnees** : importe `database/schema.sql` dans MySQL (il cree la base `marado_store`, les tables et les 12 produits de demonstration).
   ```
   mysql -u root < database/schema.sql
   ```
2. **Configuration** : ajuste si besoin les identifiants dans `config/database.php` (hote, utilisateur, mot de passe MySQL, coordonnees de la boutique).
3. **Lancer le site** :
   - Avec WampServer/XAMPP : place le dossier dans `www/` (ou `htdocs/`) et ouvre `http://localhost/Marado%20Store/`.
   - Ou en local avec le serveur PHP integre :
     ```
     php -S localhost:8000
     ```
     puis ouvre `http://localhost:8000/index.php`.

## Acces admin

URL : `/admin/login.php`

- Identifiant : `admin`
- Mot de passe : `admin123`

**Change ce mot de passe des la mise en production** (page de gestion a ajouter, ou directement en base via `UPDATE admin_users SET password_hash = ...`).

## Structure du projet

```
config/            Connexion base de donnees + constantes du site
database/           Schema SQL + donnees de demonstration
includes/           Fonctions communes, panier, header/footer, carte produit
admin/              Panneau d'administration (produits, commandes, messages)
assets/css/         style.css (site public), admin.css (panneau admin)
assets/js/          Interactions (menu mobile, alertes)
assets/images/      Photos produits + visuels du site (logo, banniere)
scripts/            Scripts utilitaires (voir ci-dessous)
```

## A propos des images produits

Les photos actuelles sont de vraies photographies de smartphones, telechargees depuis Pexels (licence libre, usage commercial autorise, sans attribution obligatoire). Elles servent d'illustration generique par marque/modele en attendant tes propres visuels produits.

- `scripts/download_real_images.php` : re-telecharge le jeu de photos Pexels utilise (utile si tu changes la liste de produits).
- `scripts/generate_images.php` : genere des illustrations SVG stylisees alternatives (secours si tu veux repartir sans dependance a une source externe).

Pour utiliser tes propres photos (officielles ou prises par toi) : va dans **Admin > Produits > Modifier**, et uploade directement la photo principale et jusqu'a 2 photos de galerie par produit.

## Notes securite / production

- Change le mot de passe admin par defaut.
- Passe `DB_PASS` a un mot de passe fort et ne commite jamais tes vrais identifiants.
- Force HTTPS et desactive l'affichage des erreurs PHP (`display_errors=Off`) en production.
