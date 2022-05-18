<style>
    <?php
    require "assets_super_dashboard/css/main.css";
    require "assets_super_dashboard/css/util.css";
    require "assets_super_dashboard/vendor/bootstrap/css/bootstrap.min.css";
    ?>
</style>

</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-sm text-light me-4" href="/super/register-admin" role="button">Tambah admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-sm text-light" href="/admin" role="button">Masuk sebagai admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-250">
                <div class="table100-head">
                    <table>
                        <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">Bulan</th>
                                <th class="cell100 column2">Tahun</th>
                                <th class="cell100 column3">Jumlah Transaksi</th>
                                <th class="cell100 column4">Total Transaksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table100-body js-pscroll">
                    <table class="table-hover">
                        <tbody>
                        <?php if(isset($model['data']) && $model['data'] !== []) { ?>
                            <?php foreach ($model['data'] as $row) { ?>
                                <?php $time = (date(strtotime($row['date']))) ?>
                                <tr class="row100 body">
                                    <td class="cell100 column1"> <?= date("M", $time)?></td>
                                    <td class="cell100 column1"> <?= date("Y", $time)?></td>
                                    <td class="cell100 column3"> <?=$row['jumlah'] ?></td>
                                    <td class="cell100 column4"> <?=$row['total'] ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
