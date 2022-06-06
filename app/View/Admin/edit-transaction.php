<style>
    <?php
    require "assets_register/css/style.css";
    require "assets_register/fonts/font-awesome-5/css/fontawesome-all.min.css";
    ?>
</style>
</head>


<body class="form-v5">
<nav class="navbar navbar-light bg-primary">
    <div class="container px-4">
        <a class="navbar-brand fs-4" href="/admin">Home</a>
    </div>
</nav>

<?php if(isset($model['status']) && $model['status'] == 'failed') { ?>
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong> <?= $model['message'] ?? '' ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php if(isset($model['status']) && $model['status'] == 'success') { ?>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <strong> <?= $model['message'] ?? '' ?>
            <a href="/admin" class="text-primary">Kembali ke Dashboard</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>


<div class="page-content">
    <div class="form-v5-content border">
        <form class="form-detail" action="/admin/edit-transaction/<?=$model['id_transaction'] ?>" method="post">
            <h2>Konfirmasi Transaksi</h2>

            <?php if($model['data'] !== []) { ?>
                <input type="hidden" name="id_prod" value="<?= $model['data']['id_prod'] ?>">
                <table class="table table-light table-hover mx-auto">
                    <tbody>
                    <tr>
                        <th scope="col">Email Pembeli</th>
                        <td> <?= $model['data']['email'] ?> </td>
                    </tr>
                    <tr>
                        <th scope="col">No Hp</th>
                        <td> <?= $model['data']['no_hp'] ?> </td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Voucher</th>
                        <td> <?= $model['data']['nama_voucher'] ?> </td>
                    </tr>
                    <tr>
                        <th scope="row">Produser</th>
                        <td> <?= $model['data']['produser'] ?> </td>
                    </tr>
                    <tr>
                        <th scope="row">Harga</th>
                        <td> <?= $model['data']['harga'] ?> </td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal pembelian</th>
                        <td> <?= $model['data']['tgl_pembelian'] ?> </td>
                    </tr>

                    <?php if($model['data']['kode_voucher'] != null ) { ?>
                        <tr>
                            <th scope="row">Kode Voucher</th>
                            <td> <?= $model['data']['kode_voucher'] ?> </td>
                        </tr>
                    <?php } ?>

                    <?php if($model['data']['email_admin'] != null ) { ?>
                        <tr>
                            <th scope="row">Admin konfirmasi</th>
                            <td> <?= $model['data']['email_admin'] ?> </td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <th scope="row">Status</th>
                        <?php if($model['data']['status'] == 0) $status = "Menunggu dikonfirmasi" ?>
                        <?php if($model['data']['status'] == 1) $status = "Sudah dikonfirmasi" ?>
                        <?php if($model['data']['status'] == -1) $status = "Pesanan dibatalkan" ?>
                        <td> <?= $status?> </td>
                    </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-evenly mt-5">
                    <a class="btn btn-outline-primary btn" href="/admin" role="button">Back</a>
                    <button class="btn btn-outline-success btn" type="submit" name="status" value="1">Konfirmasi pesanan</button>
                    <button class="btn btn-outline-danger btn" type="submit" name="status" value="-1">Batalkan pesanan</button>
                </div>
            <?php } ?>
        </form>
    </div>
</div>

