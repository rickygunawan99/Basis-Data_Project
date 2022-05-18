
<div class="container" style="font-family: 'Arial'">
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin">Dashboard Admin</a>
            <div class="d-flex">
                <a class="btn bg-white text-black me-2" type="button" href="/profile">
                    <i class="bi bi-person-fill"></i>
                    <?= $model['user']->username ?>
                </a>
                <a class="btn bg-danger text-white" type="button" href="/logout">Logout</a>
            </div>
        </div>
    </nav>

    <?php session_start() ?>
        <?php if(isset($_SESSION['status'])) { ?>
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong> <?= "Tambah produser berhasil"?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
    <?php session_destroy()?>

    <div class="container d-flex justify-content-end py-2">
        <a href="/admin/add-produser" class="btn bg-primary me-2 text-white" type="button"  role="button">Add produser</a>
        <a href="/admin/add-product" class="btn bg-primary text-white" type="button" role="button">Add product</a>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="trans-tab" data-bs-toggle="tab" data-bs-target="#transaksi" type="button" role="tab" aria-controls="home" aria-selected="true">Transaksi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="products-tab" data-bs-toggle="tab" data-bs-target="#produk" type="button" role="tab" aria-controls="profile" aria-selected="false">Products</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="produser-tab" data-bs-toggle="tab" data-bs-target="#produser" type="button" role="tab" aria-controls="contact" aria-selected="false">Produser</button>
        </li>
    </ul>

    <div class="tab-content border" id="myTabContent">
        <div class="tab-pane fade show active" id="transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <form class="d-flex" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search id" aria-label="Search" autocomplete="off" name="s_tr_id">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>
            <form action="" method="post">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Description</th>
                        <th scope="col">Produser</th>
                        <th scope="col">Pembeli</th>
                        <th scope="col">Total harga</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if(isset($model['data_transaksi']) && $model['data_transaksi'] !== []) { ?>
                        <?php foreach ($model['data_transaksi'] as $row) { ?>
                            <tr>
                                <th scope="col"> <?=$row['id_transaksi']?> </th>
                                <td class="text-sm-start text-wrap"> <?=$row['description']?> </td>
                                <td class="text-sm-start text-wrap"> <?=$row['produser']?> </td>
                                <td class="text-sm-start text-wrap"> <?=$row['email']?> </td>
                                <td class="text-sm-start text-wrap"> <?=$row['harga']?> </td>
                                <td class="text-sm-start text-wrap"> <?= date("d-m-Y", strtotime($row['tgl_pembelian']))?> </td>

                                <!-- status : 0(belum diproses), 1(sudah diproses) !-->
                                <?php if($row['status'] == 0) {?>
                                    <td class="text-sm-start text-wrap"> <?= "Menunggu konfirmasi" ?> </td>
                                <?php } elseif($row['status'] == 1 ) { ?>
                                    <td class="text-sm-start text-wrap"> <?= "Dikonfirmasi" ?> </td>
                                <?php } elseif($row['status'] == -1 ) { ?>
                                <td class="text-sm-start text-wrap"> <?= "Pesanan dibatalkan" ?> </td>
                                <?php } ?>

                                <td>
                                        <a class="btn btn-primary btn-sm" type="button" href="/admin/edit-transaction/<?=$row['id_transaksi']?>">Edit</a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php }?>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="tab-pane fade" id="produk" role="tabpanel" aria-labelledby="products-tab">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <form class="d-flex" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search Product Name" aria-label="Search" autocomplete="off" name="s_product">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>
            <form action="" method="post">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Description</th> <!-- 11500 voucher google play -->
                        <th scope="col">Nominal Voucher</th> <!-- 10000 -->
                        <th scope="col">Nama Produser</th> <!-- Google -->
                        <th scope="col">Nama Voucher</th> <!-- Google Play Gift / Google play Card -->
                        <th scope="col">Harga</th> <!-- 15000 voucher google play -->
                        <th scope="col">Stock</th> <!-- 15000 voucher google play -->
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if(isset($model['data_products']) && $model['data_products'] != []) { ?>
                        <?php foreach ($model['data_products'] as $row) { ?>
                            <tr>
                                <th scope="row"> <?= $row['description'] ?></th>
                                    <td class="text-sm-start text-wrap"> <?=$row['jml_item']?> </td>
                                    <td class="text-sm-start text-wrap"> <?=$row['nama_produser']?> </td>
                                    <td class="text-sm-start text-wrap"> <?=$row['nama_voucher']?> </td>
                                    <td class="text-sm-start text-wrap"> <?=$row['harga']?> </td>
                                    <td class="text-sm-start text-wrap"> <?=$row['stock']?> </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" type="button" name="edit" href="/admin/edit-product/<?=$row['id_product']?>">Edit</a>
                                    </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>

                    </tbody>
                </table>
            </form>
        </div>
        <div class="tab-pane fade" id="produser" role="tabpanel" aria-labelledby="produser-tab">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <form class="d-flex" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search Produser Name" aria-label="Search" autocomplete="off" name="s_produser">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>
            <form action="" method="post">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nama Produser</th>
                        <th scope="col">Nama voucher</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if(isset($model['data_produser']) && $model['data_produser'] != []) { ?>
                        <?php $ctr = 1 ?>
                        <?php foreach ($model['data_produser'] as $row) { ?>
                            <tr>
                                <th scope="row"> <?= $ctr ?> </th>
                                <td class="text-sm-start text-wrap"> <?=$row['nama_produser']?> </td>
                                <td class="text-sm-start text-wrap"> <?=$row['nama_voucher']?> </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" type="button" href="/admin/edit-produser/<?=$row['id_produser'] ?>">Edit</a>
                                </td>
                            </tr>
                            <?php $ctr++ ?>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>