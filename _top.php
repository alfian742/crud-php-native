<?php
// Koneksi ke basis data
include('connection.php');
?>

<!DOCTYPE html>
<html lang="id" data-bs-theme="auto">

<head>
    <!-- Check theme -->
    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst($page); ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/logo.png">
    <link rel="apple-touch-icon" href="assets/img/logo.png">

    <!-- General CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php if ($page == 'Data'): ?>
        <!-- Plugin -->
        <link href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <?php endif ?>

    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php if ($page != 'Login'): ?>
        <!-- SVG icon theme -->
        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
            <symbol id="check2" viewBox="0 0 16 16">
                <path
                    d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
            </symbol>
            <symbol id="circle-half" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
            </symbol>
            <symbol id="moon-stars-fill" viewBox="0 0 16 16">
                <path
                    d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
                <path
                    d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
            </symbol>
            <symbol id="sun-fill" viewBox="0 0 16 16">
                <path
                    d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
            </symbol>
        </svg>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark py-0 fixed-top">
            <div class="container bg-primary py-2 rounded-bottom-3" id="myNavbar">
                <a class="navbar-brand" href="#">
                    <div class="d-flex align-items-center gap-2">
                        <img src="assets/img/logo.png" alt="Logo" width="30" height="30"
                            class="d-inline-block bg-white rounded-circle">
                        <span class="fw-semibold">UTM</span>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto text-center mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'Beranda') ? 'active' : ''; ?>" href="index.php">Beranda</a>
                        </li>
                        <?php if (!isset($_SESSION['email'])): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($page == 'Login') ? 'active' : ''; ?>" href="login.php">Masuk</a>
                            </li>
                        <?php endif ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($page == 'Data') ? 'active' : ''; ?>" href="show.php">Data</a>
                        </li>
                    </ul>
                    <div class="vr bg-white d-none d-lg-inline ms-2 me-1"></div>
                    <div class="dropdown">
                        <button
                            class="btn btn-primary bg-transparent border-0 py-2 dropdown-toggle d-flex align-items-center mx-auto"
                            id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
                            aria-label="Toggle theme (auto)">
                            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                                <use href="#circle-half"></use>
                            </svg>
                            <span class="visually-hidden" id="bd-theme-text">Tema</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text"
                            id="dropdown-menu-theme">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="light" aria-pressed="false">
                                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                                        <use href="#sun-fill"></use>
                                    </svg>
                                    Terang
                                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                                        <use href="#check2"></use>
                                    </svg>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="dark" aria-pressed="false">
                                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                                        <use href="#moon-stars-fill"></use>
                                    </svg>
                                    Gelap
                                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                                        <use href="#check2"></use>
                                    </svg>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active"
                                    data-bs-theme-value="auto" aria-pressed="true">
                                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                                        <use href="#circle-half"></use>
                                    </svg>
                                    Otomatis
                                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                                        <use href="#check2"></use>
                                    </svg>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <?php if (isset($_SESSION['email'])): ?>
                        <div class="vr bg-white d-none d-lg-inline ms-1 me-3"></div>
                        <a href="logout.php" class="btn btn-sm btn-outline-light btn-logout">Keluar</a>
                    <?php endif ?>
                </div>
            </div>
        </nav>
        <!-- End of navbar -->
    <?php endif ?>

    <!-- Main -->
    <main class="container">
        <section class="row mb-3">
            <div class="col-12">
                <img src="assets/img/logo.png" alt="Logo" class="bg-white rounded-circle p-2 <?= ($page == 'Login') ? 'd-block mx-auto' : 'main-logo'; ?>" width="100"
                    height="100">
            </div>
        </section>

        <section class="row <?= ($page == 'Login') ? 'justify-content-center' : 'g-3'; ?>">
            <?php if ($page != 'Login'): ?>
                <div class="col-lg-2">
                    <!-- Sidemenu -->
                    <div class="list-group rounded-3">
                        <div class="list-group-item list-group-item-action border-0 text-bg-primary fw-semibold list-group-item <?= ($page == 'Data') ? 'list-group-item-custom' : 'py-3'; ?>">
                            <span class="h5">Menu</span>
                        </div>
                        <a href="index.php" class="list-group-item list-group-item-action <?= ($page == 'Beranda') ? 'fw-semibold' : ''; ?>">
                            <i class="fa-solid fa-house"></i> Beranda
                        </a>
                        <?php if (!isset($_SESSION['email'])): ?>
                            <a href="login.php" class="list-group-item list-group-item-action <?= ($page == 'Login') ? 'fw-semibold' : ''; ?>">
                                <i class="fa-solid fa-address-card"></i> Masuk
                            </a>
                        <?php endif ?>
                        <a href="show.php" class="list-group-item list-group-item-action <?= ($page == 'Data') ? 'fw-semibold' : ''; ?>">
                            <i class="fa-solid fa-table-cells"></i> Data
                        </a>
                    </div>
                    <!-- End of sidemenu -->
                </div>
            <?php endif ?>