


-- 4. Insérer les données de test (sans doublons grâce à IGNORE)
INSERT IGNORE INTO users (name, email) VALUES
('Jones Smith',    'smithjohn@gmail.com'),
('Sarah Johnson',  'sarahjohnson@gmail.com'),
('Mike Davids',    'mikedavids@gmail.com'),
('Emilie Brown',   'emiliebrown@gmail.com'),
('David Wilson',   'davidwilson@gmail.com');