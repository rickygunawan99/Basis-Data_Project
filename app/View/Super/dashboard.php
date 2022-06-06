
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets_super/img/favicon.png" rel="icon">
    <link href="assets_super/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets_super/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_super/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets_super/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets_super/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets_super/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets_super/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets_super/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets_super/css/style.css" rel="stylesheet">
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <div class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">Superadmin</span>
        </div>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/super">
                <i class="bi bi-house"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/super/register-admin">
                <i class="bi bi-person-plus"></i>
                <span>Tambahkan Admin</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/super/detail">
                <i class="bi bi-clipboard-check"></i>
                <span>Detail Penjualan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/logout">
                <i class="bi bi-arrow-right-square"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>
</aside><!-- End Sidebar-->

<main id="main" class="main">
    <?php $month = date("o F") ?>
    <h4>Informasi Penjualan Bulan <?= $month ?> </h4>
    <div class="container d-flex flex-wrap gap-2">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title" style="color: green">Pembelian dikonfirmasi</h5>
                <p class="card-text"><?= $model['info']['confirm'] ?? '0' ?></p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body ">
                <h5 class="card-title" style="color: red">Pembelian dibatalkan</h5>
                <p class="card-text"><?= $model['info']['cancel'] ?? '0' ?></p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body ">
                <h5 class="card-title" style="color: blue">Menunggu konfirmasi</h5>
                <p class="card-text"><?= $model['info']['waiting'] ?? '0' ?></p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body ">
                <h5 class="card-title" style="color: grey">Jumlah admin</h5>
                <p class="card-text"><?= $model['info']['admin'] ?? '0' ?></p>
            </div>
        </div>
    </div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets_super/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets_super/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets_super/vendor/chart.js/chart.min.js"></script>
<script src="assets_super/vendor/echarts/echarts.min.js"></script>
<script src="assets_super/vendor/quill/quill.min.js"></script>
<script src="assets_super/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets_super/vendor/tinymce/tinymce.min.js"></script>
<script src="assets_super/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets_super/js/main.js"></script>

</body>