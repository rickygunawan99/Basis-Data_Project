
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
        <form class="form-detail" action="/admin/edit-product/<?= $model['id'] ?>" method="post">
            <h2>EDIT PRODUCTS</h2>
            <div class="form-row">
                <label for="description">DESKRIPSI</label>
                <input type="text" name="description" id="description" class="input-text" autocomplete="off" required
                       value="<?=$model['product'][0]['description'] ?>">
            </div>
            <div class="form-row" aria-disabled="true">
                <label for="select1">Pilih Produser & Nama Voucher</label>

                <select id="select1" class="form-select" aria-label="Default select example" name="produser" disabled style="width: 80%">
                    <option name="idProduser" value=<?=$model['id']?> selected> <?=$model['product'][0]['nama_produser'] . " - " . $model['product'][0]['nama_voucher'] ?> </option>
                </select>
            </div>

            <div class="form-row mt-4">
                <label for="jumlahItem">Jumlah Item</label>
                <input type="text" name="jml_item" id="jumlahItem" class="input-text"
                       value="<?=$model['product'][0]['jml_item'] ?>" required>
            </div>
            <div class="form-row">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" class="input-text"
                       value="<?=$model['product'][0]['harga'] ?>" required>
            </div>
            <div class="form-row">
                <label for="stock">Stock</label>
                <input type="text" name="stock" id="harga" class="input-text"
                       value="<?=$model['product'][0]['stock'] ?>" required>
            </div>
            <input name="idProduser" type="hidden" value="<?= $model['product'][0]['id_produser'] ?>" >
            <div class="d-flex justify-content-evenly">
                <a class="btn btn-primary btn-lg" href="/admin" role="button">Back</a>
                <button class="btn btn-success btn-lg" type="submit" name="submit">Save change</button>
            </div>
        </form>
    </div>
</div>