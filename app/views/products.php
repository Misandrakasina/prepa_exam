<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Modern Bootstrap Admin</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Comprehensive product management with inventory tracking, categories, and analytics">
    <meta name="keywords" content="bootstrap, admin, dashboard, products, inventory, e-commerce">
    
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
    
    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>  <script type="module" crossorigin src="/assets/vendor-bootstrap-C9iorZI5.js"></script>
  <script type="module" crossorigin src="/assets/vendor-charts-DGwYAWel.js"></script>
  <script type="module" crossorigin src="/assets/vendor-ui-CflGdlft.js"></script>
  <script type="module" crossorigin src="/assets/main-B24LRf0x.js"></script>
  <script type="module" crossorigin src="/assets/products-WhFVlziX.js"></script>
  <link rel="stylesheet" crossorigin href="/assets/main-BQhM7myw.css">
</head>

<body data-page="products" class="product-management">
    <!-- Admin App Container -->
    <div class="admin-app">
        <div class="admin-wrapper" id="admin-wrapper">
            
            <!-- Header -->
            <header class="admin-header">
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                    <div class="container-fluid">
                        <!-- Logo/Brand -->
                        <a class="navbar-brand d-flex align-items-center" href="./index">
                            <img src="/assets/images/logo.png" alt="Logo" height="32" class="d-inline-block align-text-top me-2">
                            <h1 class="h4 mb-0 fw-bold text-primary">Exchange</h1>
                        </a>

                        <!-- Sidebar Toggle -->
                        <button class="hamburger-menu" type="button" data-sidebar-toggle aria-label="Toggle sidebar">
                            <i class="bi bi-list"></i>
                        </button>

                        <!-- Search Bar with Alpine.js -->
                        <div class="search-container flex-grow-1 mx-4" x-data="searchComponent">
                            <div class="position-relative">
                                <input type="search" 
                                       class="form-control" 
                                       placeholder="Search... (Ctrl+K)"
                                       x-model="query"
                                       @input="search()"
                                       data-search-input
                                       aria-label="Search">
                                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                                
                                <!-- Search Results Dropdown -->
                                <div x-show="results.length > 0" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="position-absolute top-100 start-0 w-100 bg-white border rounded-2 shadow-lg mt-1 z-3">
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

                        <!-- Right Side Icons -->
                        <div class="navbar-nav flex-row">
                            <!-- Theme Toggle with Alpine.js -->
                            <div x-data="themeSwitch">
                                <button class="btn btn-outline-secondary me-2" 
                                        type="button" 
                                        @click="toggle()"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        title="Toggle theme">
                                    <i class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>
                                    <i class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>
                                </button>
                            </div>

                            <!-- Fullscreen Toggle -->
                            <button class="btn btn-outline-secondary me-2" 
                                    type="button" 
                                    data-fullscreen-toggle
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    title="Toggle fullscreen">
                                <i class="bi bi-arrows-fullscreen icon-hover"></i>
                            </button>

                            <!-- Notifications -->
                            <div class="dropdown me-2">
                                <button class="btn btn-outline-secondary position-relative" 
                                        type="button" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false">
                                    <i class="bi bi-bell"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        3
                                    </span>
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

                            <!-- User Menu -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary d-flex align-items-center" 
                                        type="button" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false">
                                    <img src="/assets/images/avatar-placeholder.svg" 
                                         alt="User Avatar" 
                                         width="24" 
                                         height="24" 
                                         class="rounded-circle me-2">
                                    <span class="d-none d-md-inline">John Doe</span>
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

            <!-- Sidebar -->
            <aside class="admin-sidebar" id="admin-sidebar">
                <div class="sidebar-content">
                    <nav class="sidebar-nav">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="./index">
                                    <i class="bi bi-speedometer2"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://dashboardpack.com/?utm_source=metis&amp;utm_medium=sidebar&amp;utm_campaign=go_pro_metis" target="_blank" rel="noopener">
                                    <i class="bi bi-rocket-takeoff"></i>
                                    <span>Go Pro</span>
                                    <span class="badge bg-danger rounded-pill ms-auto">Hot</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./analytics">
                                    <i class="bi bi-graph-up"></i>
                                    <span>Analytics</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./users">
                                    <i class="bi bi-people"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="./products">
                                    <i class="bi bi-box"></i>
                                    <span>Products</span>
                                    <span class="badge bg-primary rounded-pill ms-auto">Active</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./orders">
                                    <i class="bi bi-bag-check"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./forms">
                                    <i class="bi bi-ui-checks"></i>
                                    <span>Forms</span>
                                    <span class="badge bg-success rounded-pill ms-auto">New</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#elementsSubmenu" aria-expanded="false">
                                    <i class="bi bi-puzzle"></i>
                                    <span>Elements</span>
                                    <span class="badge bg-primary rounded-pill ms-2 me-2">New</span>
                                    <i class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <div class="collapse" id="elementsSubmenu">
                                    <ul class="nav nav-submenu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="./elements">
                                                <i class="bi bi-grid"></i>
                                                <span>Overview</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="./elements-buttons">
                                                <i class="bi bi-square"></i>
                                                <span>Buttons</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="./elements-alerts">
                                                <i class="bi bi-exclamation-triangle"></i>
                                                <span>Alerts</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="./elements-badges">
                                                <i class="bi bi-award"></i>
                                                <span>Badges</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="./elements-cards">
                                                <i class="bi bi-card-text"></i>
                                                <span>Cards</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="./elements-modals">
                                                <i class="bi bi-window"></i>
                                                <span>Modals</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="./elements-forms">
                                                <i class="bi bi-ui-checks"></i>
                                                <span>Forms</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="./elements-tables">
                                                <i class="bi bi-table"></i>
                                                <span>Tables</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./reports">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <span>Reports</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./messages">
                                    <i class="bi bi-chat-dots"></i>
                                    <span>Messages</span>
                                    <span class="badge bg-danger rounded-pill ms-auto">3</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./calendar">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>Calendar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./files">
                                    <i class="bi bi-folder2-open"></i>
                                    <span>Files</span>
                                </a>
                            </li>
                            <li class="nav-item mt-3">
                                <small class="text-muted px-3 text-uppercase fw-bold">Admin</small>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./settings">
                                    <i class="bi bi-gear"></i>
                                    <span>Settings</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./security">
                                    <i class="bi bi-shield-check"></i>
                                    <span>Security</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./help">
                                    <i class="bi bi-question-circle"></i>
                                    <span>Help & Support</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Sidebar Backdrop (mobile overlay) -->
        <div class="sidebar-backdrop" aria-hidden="true"></div>
            <!-- Main Content -->
            <main class="admin-main">
                <div class="container-fluid p-4 p-lg-5">
                    
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4 mb-lg-5">
                        <div>
                            <h1 class="h3 mb-0">Product Exchange</h1>
                            <p class="text-muted mb-0">Here you can manage your product listings and exchanges.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary" @click="exportProducts()">
                                <i class="bi bi-download me-2"></i>Export
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importModal">
                                <i class="bi bi-upload me-2"></i>Import
                            </button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                                <i class="bi bi-plus-lg me-2"></i>Add Product
                            </button>
                        </div>
                    </div>





                        <!-- Products Table -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title mb-0"></h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex gap-2">
                                            <!-- Search -->
                                            <div class="position-relative">
                                                <input type="search" 
                                                       class="form-control form-control-sm" 
                                                       placeholder="Search products..."
                                                       id="searchInput"
                                                       style="width: 200px;">
                                                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2 text-muted"></i>
                                            </div>
                                            
                                            <!-- Category Filter -->
                                            <select class="form-select form-select-sm" 
                                                    id="categoryFilter"
                                                    style="width: 150px;">
                                                <option value="">Toutes les catégories</option>
                                            </select>
                                            
                                            <!-- User Filter -->                                         
                                            <select class="form-select form-select-sm" 
                                                    id="userFilter"
                                                    style="width: 150px;">
                                                <option value="">Tous les utilisateurs</option>
                                            </select>

                                            <button type="button" class="btn btn-sm btn-primary" id="searchBtn">
                                                Rechercher
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                        <!-- Simple display of objects by user -->
                        <div class="container-fluid" id="objectsByUser">
                            <h4 class="mb-4">Objets par Utilisateur</h4>

                            <?php
                            // Utiliser l'instance Flight déjà chargée
                            try {
                                // Appeler directement la méthode getObjetsByUser (même logique que dans le contrôleur)
                                $objets = Flight::db()->fetchAll("
                                    SELECT o.id_objet AS id,
                                           o.prix_estime AS price,
                                           o.image_path AS image,
                                           o.id_user,
                                           u.name AS userName,
                                           u.email AS userEmail,
                                           c.nom AS category
                                    FROM objets o
                                    JOIN users u ON o.id_user = u.id
                                    JOIN categories c ON o.id_categorie = c.id
                                    ORDER BY u.name, o.id_objet
                                ");

                                // Grouper les objets par utilisateur
                                $result = [];
                                foreach ($objets as $objet) {
                                    $userId = $objet['id_user'];
                                    if (!isset($result[$userId])) {
                                        $result[$userId] = [
                                            'user' => [
                                                'id'    => (int) $userId,
                                                'name'  => $objet['userName'],
                                                'email' => $objet['userEmail'],
                                            ],
                                            'objets' => [],
                                        ];
                                    }
                                    $result[$userId]['objets'][] = [
                                        'id'       => (int) $objet['id'],
                                        'price'    => (float) $objet['price'],
                                        'image'    => $objet['image'],
                                        'category' => $objet['category'],
                                    ];
                                }

                                // Afficher les données
                                foreach ($result as $userData) {
                                    echo '<div class="mb-5">';
                                    echo '<h5 class="text-primary mb-3">';
                                    echo '<i class="bi bi-person-circle me-2"></i>';
                                    echo htmlspecialchars($userData['user']['name']);
                                    echo '<small class="text-muted ms-2">' . htmlspecialchars($userData['user']['email']) . '</small>';
                                    echo '</h5>';

                                    echo '<div class="row g-3">';
                                    foreach ($userData['objets'] as $objet) {
                                    echo '<div class="col-md-4 col-lg-3 mb-4">';
                                    echo '<div class="card" style="width: 18rem;">';
                                    echo '<div class="card-body">';

                                    // Grande image principale
                                    echo '<img id="mainImage-' . $objet['id'] . '" src="' . htmlspecialchars($objet['image']) . '" ';
                                    echo 'class="img-fluid mb-3 rounded" ';
                                    echo 'alt="Objet ' . $objet['id'] . '" ';
                                    echo 'style="width: 100%; height: 200px; object-fit: cover;">';

                                    // Petites images thumbnails (utilisant la même image pour l'exemple)
                                    echo '<div class="d-flex justify-content-between mb-3">';
                                    echo '<img src="' . htmlspecialchars($objet['image']) . '" class="img-thumbnail thumb" style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;" onclick="changeImage(' . $objet['id'] . ', this.src)">';
                                    echo '<img src="' . htmlspecialchars($objet['image']) . '" class="img-thumbnail thumb" style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;" onclick="changeImage(' . $objet['id'] . ', this.src)">';
                                    echo '<img src="' . htmlspecialchars($objet['image']) . '" class="img-thumbnail thumb" style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;" onclick="changeImage(' . $objet['id'] . ', this.src)">';
                                    echo '</div>';

                                    // Informations de l'objet
                                    echo '<h6 class="card-title">Objet ' . $objet['id'] . '</h6>';
                                    echo '<p class="card-text">';
                                    echo '<strong>Utilisateur:</strong> ' . htmlspecialchars($userData['user']['name']) . '<br>';
                                    echo '<strong>Catégorie:</strong> ' . htmlspecialchars($objet['category']) . '<br>';
                                    echo '<strong>Prix:</strong> <span class="text-success fw-bold">$ ' . number_format($objet['price'], 2) . '</span>';
                                    echo '</p>';

                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                }

                            } catch (Exception $e) {
                                echo '<div class="alert alert-danger">Erreur lors du chargement des objets : ' . htmlspecialchars($e->getMessage()) . '</div>';
                            }
                            ?>
                        </div>
                                                                <i class="bi bi-three-dots"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#" @click="editProduct(product)">
                                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="#" @click="viewProduct(product)">
                                                                    <i class="bi bi-eye me-2"></i>View Details
                                                                </a></li>
                                                                <li><a class="dropdown-item" href="#" @click="duplicateProduct(product)">
                                                                    <i class="bi bi-copy me-2"></i>Duplicate
                                                                </a></li>
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li><a class="dropdown-item text-danger" href="#" @click="deleteProduct(product)">
                                                                    <i class="bi bi-trash me-2"></i>Delete
                                                                </a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing <span x-text="(currentPage - 1) * itemsPerPage + 1"></span> to 
                                <span x-text="Math.min(currentPage * itemsPerPage, filteredProducts.length)"></span> of 
                                <span x-text="filteredProducts.length"></span> results
                            </div>
                            <nav>
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(currentPage - 1)">Previous</a>
                                    </li>
                                    <template x-for="(page, index) in visiblePages" :key="`page-${index}`">
                                        <li class="page-item" :class="{ 'active': page === currentPage }">
                                            <a class="page-link" href="#" @click.prevent="page !== '...' && goToPage(page)" x-text="page"></a>
                                        </li>
                                    </template>
                                    <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(currentPage + 1)">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        
                    </div> <!-- End Product Management Container -->

                </div>


            </main>

            <!-- Footer -->
            <footer class="admin-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0 text-muted">© ETU003992 ETU004372 ETU00</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-0 text-muted">Built with Bootstrap 5 by <a href="https://colorlib.com/" target="_blank" rel="noopener noreferrer">Colorlib</a></p>
                        </div>
                    </div>
                </div>
            </footer>

        </div> <!-- /.admin-wrapper -->
    </div>

    <!-- Product Modal (Add/Edit) -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form x-data="productForm">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" x-model="form.name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" x-model="form.sku" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select class="form-select" x-model="form.category" required>
                                    <option value="">Select Category</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="clothing">Clothing</option>
                                    <option value="books">Books</option>
                                    <option value="home">Home & Garden</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" x-model="form.price" step="0.01" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" x-model="form.stock" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" x-model="form.description" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" x-model="form.status" required>
                                    <option value="">Select Status</option>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                    <option value="pending">Pending Review</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Product Image</label>
                                <input type="file" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" @click="saveProduct()">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Upload CSV File</label>
                        <input type="file" class="form-control" accept=".csv">
                        <div class="form-text">Upload a CSV file with columns: name, sku, category, price, stock, status</div>
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>CSV Format:</strong> name, sku, category, price, stock, status<br>
                        <small>Example: iPhone 14, IPHONE14-128, electronics, 799.99, 50, published</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Import Products</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-specific Component -->

    <!-- Script pour les objets par utilisateur -->
    <script>
        function changeImage(objetId, newSrc) {
            const mainImage = document.getElementById('mainImage-' + objetId);
            if (mainImage) {
                mainImage.src = newSrc;
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const userFilter = document.getElementById('userFilter');
            const searchBtn = document.getElementById('searchBtn');
            const objectsContainer = document.getElementById('objectsByUser');

            if (!searchInput || !categoryFilter || !userFilter || !searchBtn || !objectsContainer) {
                return;
            }

            const escapeHtml = (str) => {
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            };

            const renderObjects = (data) => {
                let html = '<h4 class="mb-4">Objets par Utilisateur</h4>';

                if (!Array.isArray(data) || data.length === 0) {
                    html += '<div class="alert alert-info">Aucun objet trouvé.</div>';
                    objectsContainer.innerHTML = html;
                    return;
                }

                data.forEach((userData) => {
                    const userName = escapeHtml(userData.user?.name ?? '');
                    const userEmail = escapeHtml(userData.user?.email ?? '');

                    html += '<div class="mb-5">';
                    html += '<h5 class="text-primary mb-3">';
                    html += '<i class="bi bi-person-circle me-2"></i>';
                    html += userName;
                    html += '<small class="text-muted ms-2">' + userEmail + '</small>';
                    html += '</h5>';

                    html += '<div class="row g-3">';

                    (userData.objets || []).forEach((objet) => {
                        const id = escapeHtml(objet.id ?? '');
                        const image = escapeHtml(objet.image ?? '');
                        const category = escapeHtml(objet.category ?? '');
                        const price = Number(objet.price ?? 0).toFixed(2);

                        html += '<div class="col-md-4 col-lg-3 mb-4">';
                        html += '<div class="card" style="width: 18rem;">';
                        html += '<div class="card-body">';

                        html += '<img id="mainImage-' + id + '" src="' + image + '" class="img-fluid mb-3 rounded" alt="Objet ' + id + '" style="width: 100%; height: 200px; object-fit: cover;">';

                        html += '<div class="d-flex justify-content-between mb-3">';
                        html += '<img src="' + image + '" class="img-thumbnail thumb" style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;" onclick="changeImage(' + id + ', this.src)">';
                        html += '<img src="' + image + '" class="img-thumbnail thumb" style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;" onclick="changeImage(' + id + ', this.src)">';
                        html += '<img src="' + image + '" class="img-thumbnail thumb" style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;" onclick="changeImage(' + id + ', this.src)">';
                        html += '</div>';

                        html += '<h6 class="card-title">Objet ' + id + '</h6>';
                        html += '<p class="card-text">';
                        html += '<strong>Utilisateur:</strong> ' + userName + '<br>';
                        html += '<strong>Catégorie:</strong> ' + category + '<br>';
                        html += '<strong>Prix:</strong> <span class="text-success fw-bold">$ ' + price + '</span>';
                        html += '</p>';

                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    });

                    html += '</div>';
                    html += '</div>';
                });

                objectsContainer.innerHTML = html;
            };

            const fetchOptions = async () => {
                const currentCategory = categoryFilter.value;
                const currentUser = userFilter.value;

                const [categoriesRes, usersRes] = await Promise.all([
                    fetch('/api/categories'),
                    fetch('/api/users')
                ]);

                const categories = await categoriesRes.json();
                const users = await usersRes.json();

                categoryFilter.innerHTML = '<option value="">Toutes les catégories</option>';
                (categories || []).forEach((category) => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.nom;
                    categoryFilter.appendChild(option);
                });

                userFilter.innerHTML = '<option value="">Tous les utilisateurs</option>';
                (users || []).forEach((user) => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = `${user.name} (${user.email})`;
                    userFilter.appendChild(option);
                });

                if (currentCategory) {
                    categoryFilter.value = currentCategory;
                }
                if (currentUser) {
                    userFilter.value = currentUser;
                }
            };

            const fetchObjects = async () => {
                const params = new URLSearchParams();
                if (searchInput.value.trim() !== '') {
                    params.set('q', searchInput.value.trim());
                }
                if (categoryFilter.value !== '') {
                    params.set('category', categoryFilter.value);
                }
                if (userFilter.value !== '') {
                    params.set('user', userFilter.value);
                }

                const res = await fetch('/api/objets?' + params.toString());
                const payload = await res.json();

                if (payload && payload.success) {
                    renderObjects(payload.data);
                } else {
                    renderObjects([]);
                }
            };

            const runSearch = async () => {
                searchBtn.disabled = true;
                try {
                    await fetchOptions();
                    await fetchObjects();
                } catch (err) {
                    objectsContainer.innerHTML = '<h4 class="mb-4">Objets par Utilisateur</h4><div class="alert alert-danger">Erreur lors du chargement.</div>';
                } finally {
                    searchBtn.disabled = false;
                }
            };

            searchBtn.addEventListener('click', runSearch);
            searchInput.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    runSearch();
                }
            });
            categoryFilter.addEventListener('change', runSearch);
            userFilter.addEventListener('change', runSearch);

            runSearch();
        });
    </script>

    <!-- Script pour les autres fonctionnalités (sans appel API pour les objets) -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('productForm', () => ({
                form: {
                    name: '',
                    price: '',
                    stock: '',
                    category: '',
                    status: 'draft',
                    description: ''
                },

                saveProduct() {
                    console.log('Sauvegarder produit:', this.form);
                    // Implémenter la sauvegarde
                }
            }));

            Alpine.data('usersTable', () => ({
                users: [],

                loadUsers() {
                    fetch('/api/users')
                        .then(response => response.json())
                        .then(data => {
                            this.users = data;
                        })
                        .catch(error => console.error('Error loading users:', error));
                }
            }));
        });
    </script>
       <script>
    const email = localStorage.getItem('userEmail');

    if (email) {
        fetch(`/api/me?email=${encodeURIComponent(email)}`)
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

    <!-- Main App Script -->
</body>
</html>