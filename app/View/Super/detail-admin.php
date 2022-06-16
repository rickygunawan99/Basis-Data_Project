
<!-- Favicons -->
<link href="/assets_super/img/favicon.png" rel="icon">
<link href="/assets_super/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="/assets_super/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets_super/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="/assets_super/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="/assets_super/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="/assets_super/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="/assets_super/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="/assets_super/vendor/simple-datatables/style.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="/assets_super/css/style.css" rel="stylesheet">
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
            <a class="nav-link collapsed" href="/super/detail-admin">
                <i class="bi bi-person"></i>
                <span>Detail Admin</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/super/detail-update">
                <i class="bi bi-arrow-repeat"></i>
                <span>Detail Update</span>
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
    <form action="" method="GET">
        <?php $month = date("Y-m") ?>
        <h4>Admin Info <?= $_GET['bulan'] ?? ' '?> </h4>
        <div class="container d-flex align-items-center gap-2">
            <label class="mt-1">Bulan
                <input type="month" name="bulan" id="bulan" value="<?=$_GET['bulan'] ?? ''?>">
            </label>
            <button class="btn btn-sm btn-outline-primary mt-1" type="submit" style="margin-top: -2px; padding: 3px 8px">
                Cari
            </button>
        </div>
    </form>

    <section class="section">
        <table class="table border-info">
            <thead>
            <tr>
                <th scope="col" class="fw-bold">Email</th>
                <th scope="col" class="fw-bold">Jumlah Konfirmasi</th>
            </tr>
            </thead>
            <tbody>
            <?php if($model['data'] !== []) { ?>
                <?php foreach ($model['data'] as $row) {?>
            <tr>
                <th scope="row"><?= $row['email'] ?></th>
                <td><?= $row['total'] ?? '0' ?></td>
            </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </section>
</main><!-- End #main -->

<!-- Vendor JS Files -->
<script src="/assets_super/vendor/apexcharts/apexcharts.min.js"></script>
<script src="/assets_super/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets_super/vendor/chart.js/chart.min.js"></script>
<script src="/assets_super/vendor/echarts/echarts.min.js"></script>
<script src="/assets_super/vendor/quill/quill.min.js"></script>
<script src="/assets_super/vendor/simple-datatables/simple-datatables.js"></script>
<script src="/assets_super/vendor/tinymce/tinymce.min.js"></script>
<script src="/assets_super/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="/assets_super/js/main.js"></script>

</body>