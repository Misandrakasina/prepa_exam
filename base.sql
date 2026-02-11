


-- 4. Insérer les données de test (sans doublons grâce à IGNORE)
INSERT IGNORE INTO users (name, email) VALUES
('Jones Smith',    'smithjohn@gmail.com'),
('Sarah Johnson',  'sarahjohnson@gmail.com'),
('Mike Davids',    'mikedavids@gmail.com'),
('Emilie Brown',   'emiliebrown@gmail.com'),
('David Wilson',   'davidwilson@gmail.com');

-- Insérer les données de test pour les catégories
INSERT IGNORE INTO categories (nom) VALUES
('Électronique'),
('Vêtements'),
('Livres'),
('Sac'),
('Sports');

-- Insérer les données de test pour les objets
INSERT IGNORE INTO objets (id_user, prix_estime, id_categorie, image_path) VALUES
-- Utilisateur 1 (Jones Smith)
(1, 299.99, 1, '/assets/images/aspi1.jpeg'),
(1, 49.99, 2, '/assets/images/aspi2.jpeg'),
(1, 19.99, 3, '/assets/images/aspi3.jpeg'),
(1, 149.99, 4, '/assets/images/aspi1.jpeg'),
(1, 99.99, 5, '/assets/images/aspi1.jpeg'),
-- Utilisateur 2 (Sarah Johnson)
(2, 199.99, 1, '/assets/images/chauss1.jpeg'),
(2, 39.99, 2, '/assets/images/chauss2.jpeg'),
(2, 29.99, 3, '/assets/images/chauss3.jpeg'),
(2, 129.99, 4, '/assets/images/chauss1.jpeg'),
(2, 89.99, 5, '/assets/images/chauss1.jpeg'),
-- Utilisateur 3 (Mike Davids)
(3, 399.99, 1, '/assets/images/liv1.jpeg'),
(3, 59.99, 2, '/assets/images/liv2.jpeg'),
(3, 24.99, 3, '/assets/images/liv3.jpeg'),
(3, 159.99, 4, '/assets/images/liv1.jpeg'),
(3, 109.99, 5, '/assets/images/liv2.jpeg'),
-- Utilisateur 4 (Emilie Brown)
(4, 249.99, 1, '/assets/images/nike1.jpeg'),
(4, 44.99, 2, '/assets/images/nike2.jpeg'),
(4, 14.99, 3, '/assets/images/nike3.jpeg'),
(4, 139.99, 4, '/assets/images/nike1.jpeg'),
(4, 79.99, 5, '/assets/images/nike3.jpeg'),
-- Utilisateur 5 (David Wilson)
(5, 349.99, 1, '/assets/images/sac1.jpeg'),
(5, 54.99, 2, '/assets/images/sac2.jpeg'),
(5, 34.99, 3, '/assets/images/sac3.jpeg'),
(5, 169.99, 4, '/assets/images/sac1.jpeg'),
(5, 119.99, 5, '/assets/images/sac4.jpeg');