<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Modern Bootstrap Admin</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Advanced user management with data tables, CRUD operations, and bulk actions">
    <meta name="keywords" content="bootstrap, admin, dashboard, users, data tables, CRUD">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/icons/favicon.svg">
    <link rel="icon" type="image/png" href="/assets/icons/favicon.png">
    <link rel="stylesheet" href="style.css">

    <!-- PWA Manifest -->
    <link rel="manifest" href="/assets/manifest-DTaoG9pG.json">

    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Styles now in SCSS files -->

    <script type="module" crossorigin src="/assets/vendor-bootstrap-C9iorZI5.js"></script>
    <script type="module" crossorigin src="/assets/vendor-charts-DGwYAWel.js"></script>
    <script type="module" crossorigin src="/assets/vendor-ui-CflGdlft.js"></script>
    <script type="module" crossorigin src="/assets/main-B24LRf0x.js"></script>
    <script type="module" crossorigin src="/assets/users-DaDyOi2I.js"></script>
    <link rel="stylesheet" crossorigin href="/assets/main-BQhM7myw.css">

<body data-page="users" class="user-management">
    <!-- Admin App Container -->
    <div class="admin-app">
        <div class="admin-wrapper" id="admin-wrapper">

            <!-- Header -->
            <header class="admin-header">
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                    <div class="container-fluid">
                        <!-- Logo/Brand -->
                        <a class="navbar-brand d-flex align-items-center" href="/index">
                                <span class="d-none d-md-inline" id="userName">Chargement...</span>
                                class="d-inline-block align-text-top me-2">
                            <h1 class="h4 mb-0 fw-bold text-primary">Metis</h1>
                        </a>

                        <!-- Sidebar Toggle -->
                        <button class="hamburger-menu" type="button" data-sidebar-toggle aria-label="Toggle sidebar">
                            <i class="bi bi-list"></i>
                        </button>

                        <!-- Search Bar with Alpine.js -->
                        <div class="search-container flex-grow-1 mx-4" x-data="searchComponent">
                            <div class="position-relative">
                                <input type="search" class="form-control" placeholder="Search... (Ctrl+K)"
                                    x-model="query" @input="search()" data-search-input aria-label="Search">
                                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>

                                <!-- Search Results Dropdown -->
                                <div x-show="results.length > 0" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    class="position-absolute top-100 start-0 w-100 bg-white border rounded-2 shadow-lg mt-1 z-3">
                                    <template x-for="result in results" :key="result.title">
                                        <a :href="result.url"
                                            class="d-block px-3 py-2 text-decoration-none text-dark border-bottom">
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
                                <button class="btn btn-outline-secondary me-2" type="button" @click="toggle()"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Toggle theme">
                                    <i class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>
                                    <i class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>
                                </button>
                            </div>

                            <!-- Fullscreen Toggle -->
                            <button class="btn btn-outline-secondary me-2" type="button" data-fullscreen-toggle
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Toggle fullscreen">
                                <i class="bi bi-arrows-fullscreen icon-hover"></i>
                            </button>

                            <!-- Notifications -->
                            <div class="dropdown me-2">
                                <button class="btn btn-outline-secondary position-relative" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bell"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        3
                                    </span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <h6 class="dropdown-header">Notifications</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#">New user registered</a></li>
                                    <li><a class="dropdown-item" href="#">Server status update</a></li>
                                    <li><a class="dropdown-item" href="#">New message received</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
                                </ul>
                            </div>

                            <!-- User Menu -->
                            <div class="dropdown">
                            <button class="btn btn-outline-secondary d-flex align-items-center" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/assets/images/avatar-placeholder.svg" alt="User Avatar" width="24"
                                    height="24" class="rounded-circle me-2">
                                <span class="d-none d-md-inline" id="userName">Chargement...</span>
                                <!-- ← on change ça -->
                                <i class="bi bi-chevron-down ms-1"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#"><i
                                            class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
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
                                <a class="nav-link" href="/index">
                                    <i class="bi bi-speedometer2"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="https://dashboardpack.com/?utm_source=metis&amp;utm_medium=sidebar&amp;utm_campaign=go_pro_metis"
                                    target="_blank" rel="noopener">
                                    <i class="bi bi-rocket-takeoff"></i>
                                    <span>Go Pro</span>
                                    <span class="badge bg-danger rounded-pill ms-auto">Hot</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/analytics">
                                    <i class="bi bi-graph-up"></i>
                                    <span>Analytics</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/users">
                                    <i class="bi bi-people"></i>
                                    <span>Users</span>
                                    <span class="badge bg-primary rounded-pill ms-auto">Active</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/products">
                                    <i class="bi bi-box"></i>
                                    <span>Products</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/orders">
                                    <i class="bi bi-bag-check"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/forms">
                                    <i class="bi bi-ui-checks"></i>
                                    <span>Forms</span>
                                    <span class="badge bg-success rounded-pill ms-auto">New</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#elementsSubmenu"
                                    aria-expanded="false">
                                    <i class="bi bi-puzzle"></i>
                                    <span>Elements</span>
                                    <span class="badge bg-primary rounded-pill ms-2 me-2">New</span>
                                    <i class="bi bi-chevron-down ms-auto"></i>
                                </a>
                                <div class="collapse" id="elementsSubmenu">
                                    <ul class="nav nav-submenu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/elements">
                                                <i class="bi bi-grid"></i>
                                                <span>Overview</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/elements-buttons">
                                                <i class="bi bi-square"></i>
                                                <span>Buttons</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/elements-alerts">
                                                <i class="bi bi-exclamation-triangle"></i>
                                                <span>Alerts</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/elements-badges">
                                                <i class="bi bi-award"></i>
                                                <span>Badges</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/elements-cards">
                                                <i class="bi bi-card-text"></i>
                                                <span>Cards</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/elements-modals">
                                                <i class="bi bi-window"></i>
                                                <span>Modals</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/elements-forms">
                                                <i class="bi bi-ui-checks"></i>
                                                <span>Forms</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/elements-tables">
                                                <i class="bi bi-table"></i>
                                                <span>Tables</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/reports">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <span>Reports</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/messages">
                                    <i class="bi bi-chat-dots"></i>
                                    <span>Messages</span>
                                    <span class="badge bg-danger rounded-pill ms-auto">3</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/calendar">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>Calendar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/files">
                                    <i class="bi bi-folder2-open"></i>
                                    <span>Files</span>
                                </a>
                            </li>
                            <li class="nav-item mt-3">
                                <small class="text-muted px-3 text-uppercase fw-bold">Admin</small>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/settings">
                                    <i class="bi bi-gear"></i>
                                    <span>Settings</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/security">
                                    <i class="bi bi-shield-check"></i>
                                    <span>Security</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/help">
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
            <!-- Main Content -->
            <!-- Main Content -->
            <main class="admin-main p-0">
                <!-- HERO avec background image -->
                <section class="hero position-relative text-white text-center overflow-hidden" style="background: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)), 
                        url('/assets/images/hero-fashion-beige-model.jpg');
                    background-size: cover; 
                    background-position: center 30%; 
                    background-attachment: fixed;
                    min-height: 80vh; 
                    display: flex; 
                    align-items: center;">
                    <div class="container position-relative z-2">
                        <h1 class="display-3 fw-bold mb-3 text-shadow">Discover Your Style Today!</h1>
                        <p class="lead fs-4 mb-5 text-shadow">Explore ta collection personnelle – Tendances uniques et
                            élégantes</p>
                        <a href="#productsContainer" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg">
                            Voir ta collection
                        </a>
                    </div>
                </section>

                <!-- PROMO BLOC (comme dans ton image exemple) -->
                <section class="promo py-5 bg-gradient-light">
                    <div class="container">
                        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between mb-4">
                            <div class="text-center text-lg-start">
                                <h2 class="display-6 fw-bold mb-2 text-dark">Sélection de la boutique</h2>
                                <p class="lead text-muted mb-0">Produits de l'utilisateur connecté</p>
                            </div>
                            <a href="#productsContainer" class="btn btn-dark btn-lg px-5 py-3 rounded-pill mt-3 mt-lg-0">
                                Voir toute la collection
                            </a>
                        </div>

                        <div class="row g-4" id="featuredProducts"></div>
                    </div>
                </section>

                <!-- PRODUITS PAR CATÉGORIE -->
                <section id="productsContainer" class="py-5 bg-light">
                    <div class="container">
                        <h2 class="text-center mb-4 fw-bold display-6" id="storeTitle">Chargement de ta boutique
                            personnelle...</h2>
                        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5" id="categoriesNav"></div>

                        <!-- Les catégories et produits seront injectés ici par le script -->
                    </div>
                </section>
            </main>


            <!-- Footer -->
            <footer class="admin-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0 text-muted">© 2026 Modern Bootstrap Admin Template</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-0 text-muted">Built with Bootstrap 5 by <a href="https://colorlib.com/"
                                    target="_blank" rel="noopener noreferrer">Colorlib</a></p>
                        </div>
                    </div>
                </div>
            </footer>

        </div> <!-- /.admin-wrapper -->
    </div>

    <!-- User Modal (Add/Edit) -->
    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form x-data="userForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" x-model="form.firstName" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" x-model="form.lastName" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" x-model="form.email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select class="form-select" x-model="form.role" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="moderator">Moderator</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select" x-model="form.status" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" x-model="form.phone">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" @click="saveUser()">Save User</button>
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
                    <h5 class="modal-title">Import Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Upload CSV File</label>
                        <input type="file" class="form-control" accept=".csv">
                        <div class="form-text">Upload a CSV file with columns: name, email, role, status</div>
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>CSV Format:</strong> name, email, role, status<br>
                        <small>Example: John Doe, john@example.com, user, active</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Import Users</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-specific Component -->
 <script>
const email = localStorage.getItem('userEmail');

const storeTitle = document.getElementById("storeTitle");
const container = document.querySelector("#productsContainer .container");
const categoriesNav = document.getElementById("categoriesNav");
const featuredProducts = document.getElementById("featuredProducts");

const setHeaderUserName = (name) => {
    const nameEl = document.getElementById('userName');
    if (nameEl) {
        nameEl.textContent = name || 'Utilisateur inconnu';
    }
};

if (!email) {
    storeTitle.textContent = "Veuillez vous connecter pour voir votre boutique";
    setHeaderUserName('Non connecté');
} else {

    fetch(`/api/site/${encodeURIComponent(email)}`)
        .then(response => {
            if (!response.ok) throw new Error("Erreur réseau");
            return response.json();
        })
        .then(data => {

            if (data.error) {
                storeTitle.textContent = data.error;
                return;
            }

            storeTitle.textContent = `Boutique de ${data.user.name}`;
            setHeaderUserName(data.user.name);

            if (!data.objets || data.objets.length === 0) {
                container.innerHTML += `
                    <p class="text-center lead mt-4">
                        Aucun article disponible pour le moment.
                    </p>
                `;
                if (featuredProducts) {
                    featuredProducts.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-info text-center mb-0">
                                Aucun produit à afficher pour cette boutique.
                            </div>
                        </div>
                    `;
                }
                return;
            }

            /* 🔥 Regroupement par catégorie */
            const grouped = {};

            data.objets.forEach(obj => {
                if (!grouped[obj.categorie]) {
                    grouped[obj.categorie] = [];
                }
                grouped[obj.categorie].push(obj);
            });

            /* 🔥 Affichage */
            const categoryNames = Object.keys(grouped);
            categoriesNav.innerHTML = categoryNames.map(name => {
                const safeId = name.replace(/\s+/g, '-').toLowerCase();
                return `
                    <a href="#cat-${safeId}" class="btn btn-outline-dark btn-sm rounded-pill px-3">
                        ${name}
                    </a>
                `;
            }).join('');

            if (featuredProducts) {
                const featured = data.objets.slice(0, 4);
                featuredProducts.innerHTML = featured.map(obj => {
                    const prix = parseFloat(obj.prix_estime).toFixed(2);
                    const rawPath = (obj.image_path || '').replace(/^\/+/, '');
                    const fileName = rawPath.split('/').pop();
                    const imagePath = `/views/assets/images/${fileName}`;
                        const imagePath = `/assets/images/${fileName}`;
                    return `
                        <div class="col-md-6 col-lg-3">
                            <div class="card border-0 shadow-sm h-100 product-card">
                                <img src="${imagePath}"
                                     class="card-img-top rounded-top"
                                     style="height: 260px; object-fit: cover;">
                                <div class="card-body text-center">
                                    <p class="fw-semibold fs-5 mb-2">${prix} €</p>
                                    <button class="btn btn-outline-dark rounded-pill px-4">
                                        Ajouter au panier
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');
            }

            for (const categorie in grouped) {

                const safeId = categorie.replace(/\s+/g, '-').toLowerCase();

                container.innerHTML += `
                    <div class="category-block mb-5">
                        <h3 class="fw-bold mb-4">${categorie}</h3>
                        <div class="row g-4" id="cat-${safeId}"></div>
                    </div>
                `;

                const catDiv = document.getElementById(`cat-${safeId}`);

                grouped[categorie].forEach(obj => {

                    const prix = parseFloat(obj.prix_estime).toFixed(2);

                    /* 🔥 Correction du chemin d'image - on utilise /views/assets/images/ qui est servi par la route */
                    const rawPath = (obj.image_path || '').replace(/^\/+/, '');
                    const fileName = rawPath.split('/').pop();
                    const imagePath = `/views/assets/images/${fileName}`;
                        const imagePath = `/assets/images/${fileName}`;

                    catDiv.innerHTML += `
                        <div class="col-md-3">
                            <div class="card border-0 shadow-sm h-100 product-card">
                                  <img src="${imagePath}"
                                     class="card-img-top rounded-top"
                                     style="height: 300px; object-fit: cover;">
                                <div class="card-body text-center">
                                    <p class="fw-semibold fs-5 mb-2">${prix} €</p>
                                    <button class="btn btn-outline-dark rounded-pill px-4">
                                        Ajouter au panier
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

        })
        .catch(error => {
            console.error(error);
            storeTitle.textContent = "Erreur lors du chargement des données.";
            setHeaderUserName('Erreur');
        });
}
</script>
    <!-- Main App Script -->

</body>

</html>