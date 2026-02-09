<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">
<head>
    <!-- Meta Tags du template -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modern Bootstrap 5 Admin Template - Clean, responsive dashboard">
    <meta name="keywords" content="bootstrap, admin, dashboard, template, modern, responsive">
    <meta name="author" content="Bootstrap Admin Template">
    <!-- Open Graph -->
    <meta property="og:title" content="Modern Bootstrap Admin Template">
    <meta property="og:description" content="Clean and modern admin dashboard template built with Bootstrap 5">
    <meta property="og:type" content="website">
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/assets/icons/favicon.svg">
    <link rel="icon" type="image/png" href="/assets/icons/favicon.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Title -->
    <title><?php echo $page_title ?? 'Metis Admin'; ?></title>
    <!-- Theme Color -->
    <meta name="theme-color" content="#6366f1">
    <!-- PWA Manifest -->
    <link rel="manifest" href="/assets/manifest-DTaoG9pG.json">
    <!-- Scripts et CSS du template -->
    <script type="module" crossorigin src="/assets/vendor-bootstrap-C9iorZI5.js"></script>
    <script type="module" crossorigin src="/assets/vendor-charts-DGwYAWel.js"></script>
    <script type="module" crossorigin src="/assets/vendor-ui-CflGdlft.js"></script>
    <script type="module" crossorigin src="/assets/main-B24LRf0x.js"></script>
    <link rel="stylesheet" crossorigin href="/assets/main-BQhM7myw.css">
</head>
<body data-page="<?php echo $page_slug ?? 'login'; ?>" class="admin-layout">

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
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="/assets/images/logo.svg" alt="Logo" height="32" class="d-inline-block align-text-top me-2">
                <h1 class="h4 mb-0 fw-bold text-primary">Metis</h1>
            </a>
            <!-- Sidebar Toggle (seulement si sidebar visible) -->
            <?php if ($show_sidebar ?? true): ?>
            <button class="hamburger-menu" type="button" data-sidebar-toggle aria-label="Toggle sidebar">
                <i class="bi bi-list"></i>
            </button>
            <?php endif; ?>
            <!-- Search Bar (optionnel sur login, masque si pas connecté) -->
            <?php if ($show_user_menu ?? true): ?>
            <div class="search-container flex-grow-1 mx-4" x-data="searchComponent">
                <!-- Code search du template... (copie-colle si besoin) -->
            </div>
            <?php endif; ?>
            <!-- Right Side Icons (seulement si connecté) -->
            <?php if ($show_user_menu ?? true): ?>
            <div class="navbar-nav flex-row">
                <!-- Theme Toggle, Fullscreen, Notifications, User Menu du template... -->
                <!-- User Menu avec Logout -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/assets/images/avatar-placeholder.svg" alt="User Avatar" width="24" height="24" class="rounded-circle me-2">
                        <span class="d-none d-md-inline">John Doe</span>
                        <i class="bi bi-chevron-down ms-1"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </nav>
</header>

<!-- Sidebar (seulement sur dashboard, pas sur login) -->
<?php if ($show_sidebar ?? true): ?>
<aside class="admin-sidebar" id="admin-sidebar">
    <!-- Code sidebar du template... (copie-colle tout le <aside>) -->
</aside>
<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop" aria-hidden="true"></div>
<?php endif; ?>

<!-- Main Content -->
<main class="admin-main">