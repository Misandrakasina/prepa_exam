<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "message");

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$email = $_GET['email'] ?? '';

if (!$email) {
    echo json_encode(["error" => "Email manquant"]);
    exit;
}

// Récupérer l'utilisateur
$userQuery = $conn->query("SELECT id, name FROM users WHERE email='$email'");

if ($userQuery->num_rows == 0) {
    echo json_encode(["error" => "Utilisateur non trouvé"]);
    exit;
}

$user = $userQuery->fetch_assoc();
$userId = $user['id'];

// Récupérer les objets par catégorie
$query = "
SELECT 
    objets.id_objet,
    objets.prix_estime,
    objets.image_path,
    categories.nom AS categorie
FROM objets
JOIN categories ON objets.id_categorie = categories.id
WHERE objets.id_user = $userId
";

$result = $conn->query($query);

$produits = [];

while ($row = $result->fetch_assoc()) {
    $produits[] = $row;
}

echo json_encode([
    "userName" => $user['name'],
    "products" => $produits
]);
