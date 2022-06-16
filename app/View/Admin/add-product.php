
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

<?php if(isset($model['error'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show text-center w-50 mx-auto" role="alert">
        <strong> <?= $model['error'] ?? '' ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php if(isset($model['success'])) { ?>
    <div class="alert alert-success alert-dismissible fade show text-center w-50 mx-auto" role="alert">
        <strong> <?= $model['success'] ?? '' ?> <a href="/admin" class="text-primary"> Klik untuk kembali</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<div class="page-content">
    <div class="form-v5-content border">
        <form class="form-detail" action="" method="post">
            <h2>ADD PRODUCTS</h2>
            <div class="form-row">
                <label for="description">DESKRIPSI</label>
                <input type="text" name="description" id="description" class="input-text" placeholder="Deskripsi" autocomplete="off" required>
            </div>
            <div class="form-row">
                <label for="produser">Pilih Produser & Nama Voucher</label>

                <select id="select1" class="form-select" aria-label="Default select example" name="produser" style="width: 80%">
                    <option selected>Open this select menu</option>

                    <?php if(isset($model['produsers']) && $model['produsers'] != []) { ?>
                        <?php foreach ($model['produsers'] as $row) { ?>
                        <option value=<?=$row['id_produser']?> > <?= $row['nama_produser'] . " - " . $row['nama_voucher'] ?> </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>

            <div class="form-row mt-4">
                <label for="jumlahItem">Jumlah Item</label>
                <input type="text" name="jml_item" id="jumlahItem" class="input-text" placeholder="Jumlah item" required>
            </div>
            <div class="form-row">
                <label for="harga">Harga</label>
                <input type="text" name="harga" id="harga" class="input-text" placeholder="Harga" required>
            </div>
            <div class="form-row">
                <label for="stock">Stock</label>
                <input type="text" name="stock" id="harga" class="input-text" placeholder="stock" required>
            </div>
            <div class="d-flex justify-content-evenly">
                <a class="btn btn-primary btn-lg" href="/admin" role="button">Back</a>
                <button class="btn btn-success btn-lg" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>