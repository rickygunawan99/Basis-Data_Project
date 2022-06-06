
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
        <form class="form-detail" action="/admin/edit-produser/<?= $model['produser_id'] ?>" method="post">
            <h2>EDIT PRODUSER</h2>
            <div class="form-row">
                <label for="namaProduser">Nama Produser</label>
                <input type="text" name="namaProduser" id="namaProduser" class="input-text" autocomplete="off" required
                       value="<?=$model['produser_name'] ?>">
            </div>
            <div class="form-row">
                <label for="namaVoucher">Nama Voucher</label>
                <input type="text" name="namaVoucher" id="namaVoucher" class="input-text" autocomplete="off" required
                       value="<?=$model['voucher_name'] ?>">
            </div>
            <div class="d-flex justify-content-evenly">
                <a class="btn btn-primary btn-lg" href="/admin" role="button">Back</a>
                <button class="btn btn-success btn-lg" type="submit" name="submit">Save change</button>
            </div>
        </form>
    </div>
</div>