-- Active: 1770563180943@@127.0.0.1@3306@message
-- 1. Créer la base (si elle n'existe pas encore)
CREATE DATABASE IF NOT EXISTS message;
-- 2. Utiliser la base
USE message;

-- 3. Créer la table (version minimale comme tu voulais)
CREATE TABLE IF NOT EXISTS users (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE
);

-- 4. Insérer les données de test (sans doublons grâce à IGNORE)
INSERT IGNORE INTO users (name, email) VALUES
('Jones Smith',    'smithjohn@gmail.com'),
('Sarah Johnson',  'sarahjohnson@gmail.com'),
('Mike Davids',    'mikedavids@gmail.com'),
('Emilie Brown',   'emiliebrown@gmail.com'),
('David Wilson',   'davidwilson@gmail.com');

INSERT IGNORE INTO categories (nom) VALUES
('Electronics'),
('Books'),
('Clothing'),
('Home & Garden'),
('Toys & Games');

INSERT INTO objets (id_user, image_objet, descri_objet, prix_estime, id_categorie) VALUES
(1, 'image1.jpg', 'Description de l\'objet 1', 100.00, 1),
(2, 'image2.jpg', 'Description de l\'objet 2', 150.00, 2),
(3, 'image3.jpg', 'Description de l\'objet 3', 200.00, 3),
(4, 'image4.jpg', 'Description de l\'objet 4', 250.00, 4),
(5, 'image5.jpg', 'Description de l\'objet 5', 300.00, 5),
(1, 'image6.jpg', 'Description de l\'objet 6', 120.00, 1),
(2, 'image7.jpg', 'Description de l\'objet 7', 180.00, 2);