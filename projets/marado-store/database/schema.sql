
CREATE TABLE brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    slug VARCHAR(50) NOT NULL UNIQUE,
    color VARCHAR(20) DEFAULT '#111827',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    short_description VARCHAR(255) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    price DECIMAL(12,2) NOT NULL,
    old_price DECIMAL(12,2) DEFAULT NULL,
    storage VARCHAR(30) DEFAULT NULL,
    color VARCHAR(30) DEFAULT NULL,
    stock INT NOT NULL DEFAULT 0,
    image_main VARCHAR(255) NOT NULL,
    is_featured TINYINT(1) NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE product_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_ref VARCHAR(20) NOT NULL UNIQUE,
    customer_name VARCHAR(100) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    email VARCHAR(120) DEFAULT NULL,
    city VARCHAR(80) NOT NULL,
    address TEXT NOT NULL,
    payment_method VARCHAR(30) NOT NULL DEFAULT 'cod',
    notes TEXT DEFAULT NULL,
    total_amount DECIMAL(12,2) NOT NULL,
    status ENUM('pending','confirmed','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT DEFAULT NULL,
    product_name VARCHAR(150) NOT NULL,
    unit_price DECIMAL(12,2) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    subject VARCHAR(150) DEFAULT NULL,
    message TEXT NOT NULL,
    is_read TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO brands (name, slug, color) VALUES
('Apple', 'apple', '#1d1d1f'),
('Samsung', 'samsung', '#1428a0'),
('Google', 'google', '#4285f4');

INSERT INTO admin_users (username, password_hash, full_name) VALUES
('admin', '$2y$10$yAyepJtiiwCG57JQN5Z7eOxYjUkdrP2Ld7AEk0uVTeY4YJCJdoTX6', 'Administrateur Marado Store');

INSERT INTO products (brand_id, name, slug, short_description, description, price, old_price, storage, color, stock, image_main, is_featured) VALUES
(1, 'iPhone 15 Pro Max', 'iphone-15-pro-max', 'Le fleuron Apple avec puce A17 Pro et appareil photo 48 MP', 'L''iPhone 15 Pro Max repousse les limites avec son chassis en titane, sa puce A17 Pro ultra-rapide et son systeme photo professionnel 48 MP. Ecran Super Retina XDR 6,7 pouces avec Dynamic Island.', 850000, 899000, '256 Go', 'Titane Naturel', 12, 'assets/images/products/iphone-15-pro-max-main.jpg', 1),
(1, 'iPhone 15', 'iphone-15', 'Design en aluminium colore avec Dynamic Island', 'L''iPhone 15 introduit Dynamic Island, une camera principale 48 MP et le port USB-C. Performances fluides grace a la puce A16 Bionic.', 650000, NULL, '128 Go', 'Bleu', 18, 'assets/images/products/iphone-15-main.jpg', 1),
(1, 'iPhone 14', 'iphone-14', 'Fiable, puissant et parfait pour la photo', 'L''iPhone 14 offre une excellente autonomie, un mode Action stabilise pour la video et un appareil photo principal ameliore.', 550000, 600000, '128 Go', 'Minuit', 20, 'assets/images/products/iphone-14-main.jpg', 0),
(1, 'iPhone 13', 'iphone-13', 'Le grand classique toujours au top', 'L''iPhone 13 reste un excellent choix avec sa puce A15 Bionic et son ecran Super Retina XDR eclatant.', 450000, NULL, '128 Go', 'Rose', 25, 'assets/images/products/iphone-13-main.jpg', 0),
(1, 'iPhone SE (2022)', 'iphone-se-2022', 'Compact, abordable, puissant', 'L''iPhone SE combine le format compact avec Touch ID et la puissance de la puce A15 Bionic, a prix accessible.', 320000, 350000, '64 Go', 'Rouge', 15, 'assets/images/products/iphone-se-2022-main.jpg', 0);

INSERT INTO products (brand_id, name, slug, short_description, description, price, old_price, storage, color, stock, image_main, is_featured) VALUES
(2, 'Samsung Galaxy S24 Ultra', 'galaxy-s24-ultra', 'Le summum Samsung avec S Pen et zoom 100x', 'Le Galaxy S24 Ultra combine un chassis en titane, un ecran Dynamic AMOLED 2X et des fonctionnalites Galaxy AI. S Pen integre et zoom optique impressionnant.', 780000, NULL, '256 Go', 'Noir Titane', 10, 'assets/images/products/galaxy-s24-ultra-main.jpg', 1),
(2, 'Samsung Galaxy S23', 'galaxy-s23', 'Performances phares dans un format compact', 'Le Galaxy S23 embarque le processeur Snapdragon 8 Gen 2 et un appareil photo triple capteur pour des clichs eclatants.', 520000, 560000, '128 Go', 'Vert', 16, 'assets/images/products/galaxy-s23-main.jpg', 0),
(2, 'Samsung Galaxy A54', 'galaxy-a54', 'Le meilleur rapport qualite-prix Samsung', 'Le Galaxy A54 offre un ecran Super AMOLED 120Hz, une certification IP67 et un appareil photo 50 MP a prix tres accessible.', 280000, 320000, '128 Go', 'Violet', 30, 'assets/images/products/galaxy-a54-main.jpg', 1),
(2, 'Samsung Galaxy Z Flip5', 'galaxy-z-flip5', 'Le pliant compact et tendance', 'Le Galaxy Z Flip5 se plie en deux grace a son grand ecran de couverture Flex Window et son design premium.', 690000, NULL, '256 Go', 'Lavande', 8, 'assets/images/products/galaxy-z-flip5-main.jpg', 0);

INSERT INTO products (brand_id, name, slug, short_description, description, price, old_price, storage, color, stock, image_main, is_featured) VALUES
(3, 'Google Pixel 8 Pro', 'pixel-8-pro', 'L''intelligence artificielle Google au service de la photo', 'Le Pixel 8 Pro embarque la puce Google Tensor G3 et un systeme photo professionnel avec Magic Editor pour des retouches bluffantes.', 600000, NULL, '128 Go', 'Obsidienne', 9, 'assets/images/products/pixel-8-pro-main.jpg', 1),
(3, 'Google Pixel 8', 'pixel-8', 'Photo intelligente et Android pur', 'Le Pixel 8 propose une experience Android pure, un appareil photo excellent en basse lumiere et 7 ans de mises a jour.', 480000, 520000, '128 Go', 'Menthe', 14, 'assets/images/products/pixel-8-main.jpg', 0),
(3, 'Google Pixel 7a', 'pixel-7a', 'Le meilleur Pixel abordable', 'Le Pixel 7a offre un appareil photo 64 MP, la recharge sans fil et la fluidite d''Android au meilleur prix de la gamme Pixel.', 300000, 340000, '128 Go', 'Corail', 22, 'assets/images/products/pixel-7a-main.jpg', 1);

INSERT INTO product_images (product_id, image_path, sort_order)
SELECT id, CONCAT('assets/images/products/', slug, '-back.jpg'), 1 FROM products;
INSERT INTO product_images (product_id, image_path, sort_order)
SELECT id, CONCAT('assets/images/products/', slug, '-angle.jpg'), 2 FROM products;
