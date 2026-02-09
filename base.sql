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