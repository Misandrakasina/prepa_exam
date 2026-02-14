<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentUserEmail = $_SESSION['user_email'] ?? null;
$currentUserId = $_SESSION['user_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace - Échange d'objets</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Consultez les objets disponibles et proposez des échanges">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/icons/favicon.svg">
    <link rel="icon" type="image/png" href="/assets/icons/favicon.png">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="/assets/manifest-DTaoG9pG.json">
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ApexCharts (si nécessaire) -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <!-- Assets compilés (à adapter si besoin) -->
    <script type="module" crossorigin src="/assets/vendor-bootstrap-C9iorZI5.js"></script>
    <script type="module" crossorigin src="/assets/vendor-charts-DGwYAWel.js"></script>
    <script type="module" crossorigin src="/assets/vendor-ui-CflGdlft.js"></script>
    <script type="module" crossorigin src="/assets/main-B24LRf0x.js"></script>
    <link rel="stylesheet" crossorigin href="/assets/main-BQhM7myw.css">
</head>
<body data-page="products" class="product-management">
    <div class="admin-app">
        <div class="admin-wrapper" id="admin-wrapper">
            
            <!-- Header (identique à users.php) -->
            <header class="admin-header">
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                    <div class="container-fluid">
                        <a class="navbar-brand d-flex align-items-center" href="/index">
                            <img src="/assets/images/logo.svg" alt="Logo" height="32" class="d-inline-block align-text-top me-2">
                            <h1 class="h4 mb-0 fw-bold text-primary">Metis</h1>
                        </a>
                        <button class="hamburger-menu" type="button" data-sidebar-toggle aria-label="Toggle sidebar">
                            <i class="bi bi-list"></i>
                        </button>
                        <div class="search-container flex-grow-1 mx-4" x-data="searchComponent">
                            <div class="position-relative">
                                <input type="search" class="form-control" placeholder="Search... (Ctrl+K)" x-model="query" @input="search()" data-search-input aria-label="Search">
                                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                                <div x-show="results.length > 0" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="position-absolute top-100 start-0 w-100 bg-white border rounded-2 shadow-lg mt-1 z-3">
                                    <template x-for="result in results" :key="result.title">
                                        <a :href="result.url" class="d-block px-3 py-2 text-decoration-none text-dark border-bottom">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-text me-2 text-muted"></i>
                                                <span x-text="result.title"></span>
                                                <small class="ms-auto text-muted" x-text="result.type"></small>
                                            </div>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="navbar-nav flex-row">
                            <div x-data="themeSwitch">
                                <button class="btn btn-outline-secondary me-2" type="button" @click="toggle()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Toggle theme">
                                    <i class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>
                                    <i class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>
                                </button>
                            </div>
                            <button class="btn btn-outline-secondary me-2" type="button" data-fullscreen-toggle data-bs-toggle="tooltip" data-bs-placement="bottom" title="Toggle fullscreen">
                                <i class="bi bi-arrows-fullscreen icon-hover"></i>
                            </button>
                            <div class="dropdown me-2">
                                <button class="btn btn-outline-secondary position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bell"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h6 class="dropdown-header">Notifications</h6></li>
                                    <li><a class="dropdown-item" href="#">New user registered</a></li>
                                    <li><a class="dropdown-item" href="#">Server status update</a></li>
                                    <li><a class="dropdown-item" href="#">New message received</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="/assets/images/avatar-placeholder.svg" alt="User Avatar" width="24" height="24" class="rounded-circle me-2">
                                    <span class="d-none d-md-inline" id="userName">Chargement...</span>
                                    <i class="bi bi-chevron-down ms-1"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Sidebar (identique, lien Products actif) -->
            <aside class="admin-sidebar" id="admin-sidebar">
                <div class="sidebar-content">
                    <nav class="sidebar-nav">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="/index"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://dashboardpack.com/?utm_source=metis&amp;utm_medium=sidebar&amp;utm_campaign=go_pro_metis" target="_blank" rel="noopener"><i class="bi bi-rocket-takeoff"></i><span>Go Pro</span><span class="badge bg-danger rounded-pill ms-auto">Hot</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/analytics"><i class="bi bi-graph-up"></i><span>Analytics</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/users"><i class="bi bi-people"></i><span>Users</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/products"><i class="bi bi-box"></i><span>Products</span><span class="badge bg-primary rounded-pill ms-auto">Active</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/orders"><i class="bi bi-bag-check"></i><span>Orders</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/forms"><i class="bi bi-ui-checks"></i><span>Forms</span><span class="badge bg-success rounded-pill ms-auto">New</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#elementsSubmenu" aria-expanded="false"><i class="bi bi-puzzle"></i><span>Elements</span><span class="badge bg-primary rounded-pill ms-2 me-2">New</span><i class="bi bi-chevron-down ms-auto"></i></a>
                                <div class="collapse" id="elementsSubmenu">
                                    <ul class="nav nav-submenu">
                                        <li class="nav-item"><a class="nav-link" href="/elements"><i class="bi bi-grid"></i><span>Overview</span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="/elements-buttons"><i class="bi bi-square"></i><span>Buttons</span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="/elements-alerts"><i class="bi bi-exclamation-triangle"></i><span>Alerts</span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="/elements-badges"><i class="bi bi-award"></i><span>Badges</span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="/elements-cards"><i class="bi bi-card-text"></i><span>Cards</span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="/elements-modals"><i class="bi bi-window"></i><span>Modals</span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="/elements-forms"><i class="bi bi-ui-checks"></i><span>Forms</span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="/elements-tables"><i class="bi bi-table"></i><span>Tables</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/reports"><i class="bi bi-file-earmark-text"></i><span>Reports</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/messages"><i class="bi bi-chat-dots"></i><span>Messages</span><span class="badge bg-danger rounded-pill ms-auto">3</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/calendar"><i class="bi bi-calendar-event"></i><span>Calendar</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/files"><i class="bi bi-folder2-open"></i><span>Files</span></a>
                            </li>
                            <li class="nav-item mt-3">
                                <small class="text-muted px-3 text-uppercase fw-bold">Admin</small>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/settings"><i class="bi bi-gear"></i><span>Settings</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/security"><i class="bi bi-shield-check"></i><span>Security</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/help"><i class="bi bi-question-circle"></i><span>Help & Support</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <div class="sidebar-backdrop" aria-hidden="true"></div>

            <!-- Main Content -->
            <main class="admin-main">
                <div class="container-fluid p-4 p-lg-5">
                    
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4 mb-lg-5">
                        <div>
                            <h1 class="h3 mb-0">Marketplace</h1>
                            <p class="text-muted mb-0">Objets disponibles à l'échange</p>
                        </div>
                    </div>

                    <!-- Affichage du statut de sélection -->
                    <div id="selectedObjectAlert" class="alert alert-success d-none mb-4" role="alert">
                        <strong>✓ Objet sélectionné:</strong> <span id="selectedObjectInfo"></span>
                        <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="clearSelection()">Changer d'objet</button>
                    </div>
                    <div id="noObjectAlert" class="alert alert-warning mb-4" role="alert">
                        <strong>⚠️ Aucun objet sélectionné:</strong> Allez dans <a href="/users#userObjectsContainer"><strong>Mes Objets</strong></a> et cliquez "Utiliser pour échange" d'abord.
                    </div>

                    <!-- Liste des objets par utilisateur -->
                    <div class="row g-4">
                        <?php
                        try {
                            // Connexion DB via Flight
                            $db = Flight::db();
                            $objets = $db->fetchAll("
                                SELECT o.id_objet AS id,
                                       o.prix_estime AS price,
                                       o.image_path AS image,
                                       o.id_user,
                                       o.is_traded,
                                       u.name AS userName,
                                       u.email AS userEmail,
                                       c.nom AS category
                                FROM objets o
                                JOIN users u ON o.id_user = u.id
                                JOIN categories c ON o.id_categorie = c.id
                                ORDER BY u.name, o.id_objet
                            ");

                            $users = [];
                            foreach ($objets as $objet) {
                                $userId = $objet['id_user'];
                                if (!isset($users[$userId])) {
                                    $users[$userId] = [
                                        'user' => [
                                            'id'    => $userId,
                                            'name'  => $objet['userName'],
                                            'email' => $objet['userEmail'],
                                        ],
                                        'objets' => []
                                    ];
                                }
                                $users[$userId]['objets'][] = [
                                    'id'        => $objet['id'],
                                    'price'     => $objet['price'],
                                    'image'     => $objet['image'],
                                    'category'  => $objet['category'],
                                    'is_traded' => $objet['is_traded'],
                                ];
                            }

                            foreach ($users as $userData):
                                // Ne pas afficher l'utilisateur connecté (optionnel)
                                if ($currentUserId && $userData['user']['id'] == $currentUserId) continue;
                        ?>
                                <div class="col-12">
                                    <h5 class="text-primary mb-3">
                                        <i class="bi bi-person-circle me-2"></i>
                                        <?= htmlspecialchars($userData['user']['name']) ?>
                                        <small class="text-muted ms-2"><?= htmlspecialchars($userData['user']['email']) ?></small>
                                    </h5>
                                </div>
                                <?php foreach ($userData['objets'] as $objet): ?>
                                    <div class="col-md-4 col-lg-3 mb-4">
                                        <div class="card h-100 <?= $objet['is_traded'] ? 'opacity-50' : '' ?>">
                                            <div class="position-relative">
                                                <img src="<?= htmlspecialchars($objet['image']) ?>" class="card-img-top" alt="Objet" style="height: 180px; object-fit: cover;">
                                                <?php if ($objet['is_traded']): ?>
                                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.4);">
                                                        <span class="badge bg-success fs-6">✓ Échangé</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title">Objet #<?= $objet['id'] ?></h6>
                                                <p class="card-text">
                                                    <strong>Catégorie:</strong> <?= htmlspecialchars($objet['category']) ?><br>
                                                    <strong>Prix estimé:</strong> <?= number_format($objet['price'], 2) ?> €
                                                </p>
                                            </div>
                                            <?php if ($currentUserId): ?>
                                                <div class="card-footer bg-transparent border-top-0">
                                                    <?php if ($objet['is_traded']): ?>
                                                        <button type="button" class="btn btn-sm btn-secondary w-100" disabled>Déjà échangé</button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-sm btn-primary w-100" onclick="proposeExchange(<?= (int)$objet['id'] ?>)">Proposer un échange</button>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="card-footer bg-transparent border-top-0">
                                                    <a href="/" class="btn btn-sm btn-outline-secondary w-100">Connectez-vous pour échanger</a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                        <?php
                            endforeach;
                        } catch (Exception $e) {
                            echo '<div class="alert alert-danger">Erreur : ' . htmlspecialchars($e->getMessage()) . '</div>';
                        }
                        ?>
                    </div>

                </div> <!-- fin container-fluid -->
            </main>

            <!-- Footer -->
            <footer class="admin-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0 text-muted">© 2026 Modern Bootstrap Admin Template</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-0 text-muted">Built with Bootstrap 5 by <a href="https://colorlib.com/" target="_blank" rel="noopener noreferrer">Colorlib</a></p>
                        </div>
                    </div>
                </div>
            </footer>

        </div> <!-- /.admin-wrapper -->
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        // Affichage du nom de l'utilisateur dans le header
        const sessionEmail = <?= json_encode($currentUserEmail) ?>;
        if (sessionEmail) {
            fetch(`/api/me?email=${encodeURIComponent(sessionEmail)}`)
                .then(r => r.json())
                .then(user => {
                    if (user.name) {
                        document.getElementById('userName').textContent = user.name;
                    } else {
                        document.getElementById('userName').textContent = 'Utilisateur inconnu';
                    }
                })
                .catch(() => {
                    document.getElementById('userName').textContent = 'Erreur';
                });
        } else {
            document.getElementById('userName').textContent = 'Non connecté';
        }
    </script>

    <script>
        function checkSelectedObject() {
            const selectedId = localStorage.getItem('selectedOfferObjectId');
            if (selectedId) {
                document.getElementById('selectedObjectAlert').classList.remove('d-none');
                document.getElementById('noObjectAlert').classList.add('d-none');
                document.getElementById('selectedObjectInfo').textContent = 'Objet #' + selectedId;
            } else {
                document.getElementById('selectedObjectAlert').classList.add('d-none');
                document.getElementById('noObjectAlert').classList.remove('d-none');
            }
        }

        function clearSelection() {
            localStorage.removeItem('selectedOfferObjectId');
            checkSelectedObject();
        }

        document.addEventListener('DOMContentLoaded', checkSelectedObject);

        function proposeExchange(wantedId) {
            if (!sessionEmail) {
                alert('Vous devez être connecté');
                window.location.href = '/';
                return;
            }

            const offeredObjectId = localStorage.getItem('selectedOfferObjectId');
            if (!offeredObjectId) {
                const confirmNav = confirm('⚠️ Vous n\'avez pas sélectionné d\'objet à échanger.\n\nClic OK pour aller sélectionner un objet dans votre compte.\n\nFlux: Mes Objets > Cliquez "Utiliser pour échange" > Revenez au marketplace');
                if (confirmNav) {
                    window.location.href = '/users#userObjectsContainer';
                }
                return;
            }

            console.log('Envoi de la proposition:', {proposerEmail: sessionEmail, offeredObjectId: parseInt(offeredObjectId), wantedObjectId: wantedId});

            fetch('/api/exchange/propose', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    proposerEmail: sessionEmail,
                    offeredObjectId: parseInt(offeredObjectId),
                    wantedObjectId: wantedId
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log('Réponse API:', data);
                if (data.success) {
                    alert('✅ Proposition envoyée avec succès!');
                    localStorage.removeItem('selectedOfferObjectId');
                    window.location.href = '/users';
                } else {
                    alert('❌ Erreur : ' + data.message);
                }
            })
            .catch(err => {
                console.error('Erreur réseau:', err);
                alert('❌ Erreur réseau.');
            });
        }
    </script>
</body>
</html>