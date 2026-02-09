


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
('Maison et Jardin'),
('Sports');

-- Insérer les données de test pour les objets
INSERT IGNORE INTO objets (id_user, prix_estime, id_categorie) VALUES
(1, 299.99, 1),  -- Jones Smith, Électronique
(2, 49.99, 2),   -- Sarah Johnson, Vêtements
(3, 19.99, 3),   -- Mike Davids, Livres
(4, 149.99, 4),  -- Emilie Brown, Maison et Jardin
(5, 99.99, 5),   -- David Wilson, Sports
(1, 199.99, 1),  -- Jones Smith, Électronique
(2, 29.99, 3),   -- Sarah Johnson, Livres
(3, 79.99, 2);   -- Mike Davids, Vêtements