<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modern Bootstrap 5 Admin Template - Clean, responsive dashboard">
    <meta name="keywords" content="bootstrap, admin, dashboard, template, modern, responsive">
    <meta name="author" content="Bootstrap Admin Template">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Modern Bootstrap Admin Template">
    <meta property="og:description" content="Clean and modern admin dashboard template built with Bootstrap 5">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/icons/favicon.svg">
    <link rel="icon" type="image/png" href="/assets/icons/favicon.png">

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Title -->
    <title>Dashboard - Modern Bootstrap Admin</title>

    <!-- Theme Color -->
    <meta name="theme-color" content="#6366f1">

    <!-- PWA Manifest -->
    <link rel="manifest" href="/assets/manifest-DTaoG9pG.json">
    <script type="module" crossorigin src="/assets/vendor-bootstrap-C9iorZI5.js"></script>
    <script type="module" crossorigin src="/assets/vendor-charts-DGwYAWel.js"></script>
    <script type="module" crossorigin src="/assets/vendor-ui-CflGdlft.js"></script>
    <script type="module" crossorigin src="/assets/main-B24LRf0x.js"></script>
    <link rel="stylesheet" crossorigin href="/assets/main-BQhM7myw.css">
</head>

<body data-page="dashboard" class="admin-layout">
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="loading-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Main Wrapper -->
    <div class="admin-wrapper" id="admin-wrapper">

        <!-- Header -->
        <header class="admin-header">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <!-- Logo/Brand - Now first on the left -->
                    <a class="navbar-brand d-flex align-items-center" href="/index">
                        <img src="/assets/images/logo.png"  height="32"
                            class="d-inline-block align-text-top me-2">
                        <h1 class="h4 mb-0 fw-bold text-primary">Exchange</h1>
                    </a>

                    <!-- Sidebar Toggle -->
                    <button class="hamburger-menu" type="button" data-sidebar-toggle aria-label="Toggle sidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <!-- Search Bar with Alpine.js -->
                    <div class="search-container flex-grow-1 mx-4" x-data="searchComponent">
                        <div class="position-relative">
                            <input type="search" class="form-control" placeholder="Search... (Ctrl+K)" x-model="query"
                                @input="search()" data-search-input aria-label="Search">
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

                        <!-- Fullscreen Toggle (hidden on phones) -->
                        <button class="btn btn-outline-secondary me-2 d-none d-md-inline-block" type="button"
                            data-fullscreen-toggle data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Toggle fullscreen">
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
                        <!-- User Menu -->
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
                            <a class="nav-link active" href="/">
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
                            <a class="nav-link" href="/users">
                                <i class="bi bi-people"></i>
                                <span>Users</span>
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
        <main class="admin-main">
            <div class="container-fluid p-4 p-lg-5">
                <!-- Page Header -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
                    <div>
                        <h1 class="h3 mb-0">Dashboard</h1>
                        <p class="text-muted mb-0">Welcome back! Here's what's happening.</p>
                    </div>

                    <div class="d-flex gap-2 flex-shrink-0">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#newItemModal">
                            <i class="bi bi-plus-lg me-2"></i>
                            <span class="d-none d-sm-inline">New Item</span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip"
                            title="Refresh data">
                            <i class="bi bi-arrow-clockwise icon-hover"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary d-none d-sm-inline-block"
                            data-bs-toggle="tooltip" title="Export data">
                            <i class="bi bi-download icon-hover"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary d-none d-sm-inline-block"
                            data-bs-toggle="tooltip" title="Settings">
                            <i class="bi bi-gear icon-hover"></i>
                        </button>
                    </div>
                </div>

<!-- Portfolio Hero Header - IMAGE QUI REMPLIT VRAIMENT 100% DE LA COLONNE DROITE -->
<section class="portfolio-hero border-bottom" style="padding: 7rem 0; min-height: 80vh; display: flex; align-items: stretch; background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);">
  <div class="container h-100">
    <div class="row align-items-stretch g-0">  <!-- Pas d'espace entre les colonnes -->

      <!-- Texte à gauche - centré verticalement -->
      <div class="col-lg-6 d-flex flex-column justify-content-center px-4 px-lg-5 py-5 py-lg-0">
        <h1 class="display-3 fw-bold text-dark mb-3" style="line-height: 1;">
          Exchange
        </h1>
        <h2 class="h2 fw-semibold text-primary mb-4" style="letter-spacing: 2px;">
          ÉCHANGEZ VOS OBJETS
        </h2>
        <p class="lead text-muted mb-5" style="max-width: 480px; font-size: 1.3rem;">
          Découvrez une communauté d'échange • Donnez une seconde vie à vos objets • Trouvez ce dont vous avez besoin gratuitement
        </p>

        <div class="d-flex flex-wrap gap-3">
          <a href="product.php" class="btn btn-primary btn-lg px-5 py-3 fw-medium shadow-sm">
            Explorer les objets <i class="bi bi-search ms-2"></i>
          </a>
          <a href="/forms" class="btn btn-outline-secondary btn-lg px-5 py-3 fw-medium">
            Proposer un échange <i class="bi bi-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

      <!-- Colonne image : remplit TOUT (hauteur + largeur) -->
      <div class="col-lg-6 position-relative overflow-hidden" style="min-height: 600px; height: 100%;">
        <img
          src="/assets/images/exchange2.jpeg"
          alt="Freya Moore artistic portrait"
          class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
          style="object-position: center; z-index: 1;"
        >
        <!-- Suggestions d'images placeholder dans le style Freya Moore (tons orange/chauds, artistique, jambes ou pose élégante) :
             → https://thumbs.dreamstime.com/b/love-relationship-online-dating-attractive-woman-closed-eyes-digital-neon-filter-lights-body-over-orange-background-275730759.jpg
             → Une recherche Unsplash/Pexels avec "artistic female legs orange sunset lighting" donne souvent de très bons résultats
             → Ou utilise directement une de tes photos cropée verticalement -->
      </div>

    </div>
  </div>
</section>















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

    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="toast-container"></div>
    </div>


    <!-- Icon Demo Modal -->
    <div class="modal fade" id="iconDemoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-palette me-2"></i>
                        Icon System Demo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" x-data="iconDemo">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Current Provider: <span class="badge bg-primary" x-text="currentProvider"></span></h6>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary"
                                    @click="switchProvider('bootstrap')"
                                    :class="{ 'active': currentProvider === 'bootstrap' }">
                                    Bootstrap Icons
                                </button>
                                <button type="button" class="btn btn-outline-primary" @click="switchProvider('lucide')"
                                    :class="{ 'active': currentProvider === 'lucide' }">
                                    Lucide Icons
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-3 text-center">
                            <div class="p-3 border rounded">
                                <i class="bi bi-speedometer2 icon-xl text-primary mb-2"></i>
                                <br><small>Dashboard</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="p-3 border rounded">
                                <i class="bi bi-people icon-xl text-success mb-2"></i>
                                <br><small>Users</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="p-3 border rounded">
                                <i class="bi bi-graph-up icon-xl text-info mb-2"></i>
                                <br><small>Analytics</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="p-3 border rounded">
                                <i class="bi bi-gear icon-xl text-warning mb-2"></i>
                                <br><small>Settings</small>
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-4">Icon Animations</h6>
                    <div class="row g-3">
                        <div class="col-md-3 text-center">
                            <i class="bi bi-arrow-clockwise icon-xl icon-spin text-primary"></i>
                            <br><small>Spin</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="bi bi-heart icon-xl icon-pulse text-danger"></i>
                            <br><small>Pulse</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="bi bi-star icon-xl icon-hover text-warning"></i>
                            <br><small>Hover Effect</small>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="bi bi-check-circle icon-xl text-success"></i>
                            <br><small>Static</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x me-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->

    <!-- New Item Modal -->
    <div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="newItemModalLabel">
                        <i class="bi bi-plus-circle text-primary me-2"></i>
                        Quick Add
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" x-data="quickAddForm()">
                    <p class="text-muted small mb-4">Create a new item quickly from the dashboard.</p>

                    <!-- Item Type Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">What would you like to add?</label>
                        <div class="btn-group w-100" role="group">
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                :class="{ 'active': itemType === 'task' }" @click="itemType = 'task'">
                                <i class="bi bi-check2-square"></i> Task
                            </button>
                            <button type="button" class="btn btn-outline-success btn-sm"
                                :class="{ 'active': itemType === 'note' }" @click="itemType = 'note'">
                                <i class="bi bi-sticky"></i> Note
                            </button>
                            <button type="button" class="btn btn-outline-info btn-sm"
                                :class="{ 'active': itemType === 'event' }" @click="itemType = 'event'">
                                <i class="bi bi-calendar-event"></i> Event
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-sm"
                                :class="{ 'active': itemType === 'reminder' }" @click="itemType = 'reminder'">
                                <i class="bi bi-bell"></i> Reminder
                            </button>
                        </div>
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="itemTitle" class="form-label fw-semibold">Title</label>
                        <input type="text" class="form-control" id="itemTitle" x-model="title"
                            placeholder="Enter a title..." autofocus>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="itemDescription" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="itemDescription" rows="3" x-model="description"
                            placeholder="Add some details..."></textarea>
                    </div>

                    <!-- Priority (shown for tasks) -->
                    <div class="mb-3" x-show="itemType === 'task'" x-transition>
                        <label class="form-label fw-semibold d-block">Priority</label>
                        <div class="btn-group" role="group" aria-label="Priority selection">
                            <input type="radio" class="btn-check" name="priorityRadio" id="priorityLow" value="low"
                                x-model="priority" autocomplete="off">
                            <label class="btn btn-outline-success btn-sm" for="priorityLow">
                                <i class="bi bi-flag"></i> Low
                            </label>
                            <input type="radio" class="btn-check" name="priorityRadio" id="priorityMedium"
                                value="medium" x-model="priority" autocomplete="off">
                            <label class="btn btn-outline-warning btn-sm" for="priorityMedium">
                                <i class="bi bi-flag-fill"></i> Medium
                            </label>
                            <input type="radio" class="btn-check" name="priorityRadio" id="priorityHigh" value="high"
                                x-model="priority" autocomplete="off">
                            <label class="btn btn-outline-danger btn-sm" for="priorityHigh">
                                <i class="bi bi-flag-fill"></i> High
                            </label>
                        </div>
                    </div>

                    <!-- Date (shown for events/reminders) -->
                    <div class="mb-3" x-show="itemType === 'event' || itemType === 'reminder'" x-transition>
                        <label for="itemDate" class="form-label fw-semibold">Date & Time</label>
                        <input type="datetime-local" class="form-control" id="itemDate" x-model="dateTime">
                    </div>

                    <!-- Assign to (shown for tasks) -->
                    <div class="mb-3" x-show="itemType === 'task'" x-transition>
                        <label for="assignTo" class="form-label fw-semibold">Assign to</label>
                        <select class="form-select" id="assignTo" x-model="assignee">
                            <option value="">Select team member...</option>
                            <option value="john">John Doe</option>
                            <option value="jane">Jane Smith</option>
                            <option value="mike">Mike Johnson</option>
                            <option value="sarah">Sarah Williams</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="saveItem()" data-bs-dismiss="modal">
                        <i class="bi bi-check-lg me-1"></i> Create Item
                    </button>
                </div>
            </div>
        </div>
    </div>
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
</body>

</html>