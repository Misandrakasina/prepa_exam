<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentUserEmail = $_SESSION['user_email'] ?? null;
$currentUserId = $_SESSION['user_id'] ?? null;

// Vérifier que l'utilisateur est connecté
if (!$currentUserId) {
    header('Location: /');
    exit;
}

// Récupérer l'ID de l'objet cible depuis l'URL
$wantedId = isset($_GET['wanted_id']) ? (int)$_GET['wanted_id'] : 0;
if (!$wantedId) {
    header('Location: /products');
    exit;
}

// Connexion DB (Flight doit être initialisé)
$db = Flight::db();

// Vérifier que la connexion DB est établie
if (!$db) {
    die("Erreur de connexion à la base de données");
}

// Récupérer les infos de l'objet cible
$wantedObject = $db->fetchRow("
    SELECT o.*, u.name AS owner_name 
    FROM objets o 
    JOIN users u ON o.id_user = u.id 
    WHERE o.id_objet = ?
", [$wantedId]);

// Si l'objet n'existe pas, afficher un message clair
if (!$wantedObject) {
    echo "<h3>Erreur : l'objet demandé (ID $wantedId) est introuvable.</h3>";
    echo '<a href="/products" class="btn btn-primary">Retour au catalogue</a>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un objet à échanger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/main-BQhM7myw.css">
    <style>
        .object-card { cursor: pointer; transition: transform 0.2s; }
        .object-card:hover { transform: scale(1.02); border-color: #0d6efd; }
        .object-card.selected { border: 2px solid #0d6efd; background-color: rgba(13,110,253,0.05); }
    </style>
</head>
<body>
    <div class="container py-5">
        <h2>Choisissez l'objet que vous souhaitez échanger</h2>
        <div class="alert alert-info">
            Vous voulez échanger contre l'objet de 
            <strong><?= htmlspecialchars($wantedObject['owner_name']) ?></strong> 
            (ID #<?= $wantedId ?>).
        </div>

        <div class="row g-4" id="objects-list">
            <?php
            // Récupérer les objets de l'utilisateur connecté
            $myObjects = $db->fetchAll("
                SELECT id_objet AS id, prix_estime AS price, image_path AS image, id_categorie 
                FROM objets 
                WHERE id_user = ?
            ", [$currentUserId]);

            if (empty($myObjects)) {
                echo '<div class="alert alert-warning">Vous n\'avez aucun objet à proposer. <a href="/users">Ajoutez-en</a> d\'abord.</div>';
            } else {
                foreach ($myObjects as $obj) {
                    ?>
                    <div class="col-md-4 col-lg-3">
                        <div class="card object-card" data-object-id="<?= $obj['id'] ?>" onclick="selectObject(this)">
                            <img src="<?= htmlspecialchars($obj['image']) ?>" class="card-img-top" alt="Objet" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title">Objet #<?= $obj['id'] ?></h6>
                                <p class="card-text">Prix estimé: <?= number_format($obj['price'], 2) ?> €</p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary" id="confirmBtn" disabled onclick="confirmExchange()">Confirmer l'échange</button>
            <a href="/products" class="btn btn-secondary">Annuler</a>
        </div>
    </div>

    <script>
        let selectedObjectId = null;

        function selectObject(card) {
            document.querySelectorAll('.object-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            selectedObjectId = card.dataset.objectId;
            document.getElementById('confirmBtn').disabled = false;
        }

        function confirmExchange() {
            if (!selectedObjectId) return;
            const email = <?= json_encode($currentUserEmail) ?>;
            if (!email) {
                alert('Vous devez être connecté');
                window.location.href = '/';
                return;
            }

            fetch('/api/exchange/propose', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    proposerEmail: email,
                    offeredObjectId: selectedObjectId,
                    wantedObjectId: <?= $wantedId ?>
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Proposition envoyée !');
                    window.location.href = '/users';
                } else {
                    alert('Erreur : ' + data.message);
                }
            });
        }
    </script>
</body>
</html>