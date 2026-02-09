CREATE DATABASE IF NOT EXISTS message;

USE message;

-- 3. Créer la table (version minimale comme tu voulais)
CREATE TABLE IF NOT EXISTS users (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS objets (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    id_user  INT NOT NULL,
    prix_estime DECIMAL(10, 2) NOT NULL,
    id_categorie INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id),
    FOREIGN KEY (id_categorie) REFERENCES categories(id)
);

