<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<?php if(isset($model['error'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong> <?= $model['error'] ?? '' ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<div class="container mt-4">
    <div class="row h5 ps-2">
        Checkout
    </div>
    <form action="" method="POST">
        <div class="row justify-content-evenly">
            <div class="col-7 border rounded-3">
                <div class="row mt-3 fw-bold ">
                    <div class="col-7 ms-2">
                        <?= $model['voucher']['nama_voucher'] ?>
                    </div>
                </div>
                <hr style="width: auto">
                <div class="row ms-2">
                    <div class="col-5">
                        <div class="row">
                            <?=$model['voucher']['description'] ?>
                        </div>
                        <div class="row">
                            <div style="font-size: smaller; padding: 0;">
                                Received Item : <?=$model['voucher']['jml_item'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 ms-auto">
                        RP. <?php echo number_format($model['voucher']['harga'],0, "",".") ?>
                    </div>
                    <div class="col-3 align-items-center ms-auto" style="color: green; font-size: smaller">
                        x1
                    </div>
                </div>
            </div>
            <div class="col-4 border rounded-3">
                <div class="row justify-content-between pt-2">

                    <div class="row justify-content-between">
                        <div class="col-6">
                            <div class="h5 py-2">Total</div>
                        </div>

                        <div class="col-6 text-end">
                            <div class="h5 ms-auto py-2" style="color: darkorange">
                                Rp. <?php echo number_format($model['voucher']['harga'],0, "",".") ?>
                            </div>
                        </div>
                    </div>

                    <hr style="width: 75%; margin: auto">

                    <div class="row justify-content-between pt-2">
                        <div class="col-6 fw-bold" style="font-size: smaller">
                            Original price
                        </div>
                        <div class="col-4 fw-bold"  style="font-size: smaller">
                            <div class="text-end">
                                Rp. <?php echo number_format($model['voucher']['harga'],0, "",".") ?>
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-between pt-2">
                        <div class="col-6 fw-bold" style="font-size: smaller">
                            Discount
                        </div>
                        <div class="col-4 fw-bold"  style="font-size: smaller">
                            <div class="text-end">
                                0
                            </div>
                        </div>
                    </div>

                    <div class="row col-10 mx-auto">
                        <button class="btn btn-primary text-center fs-6 mt-3 mb-2 border rounded-pill" type="submit">
                            Pay Now
                        </button>
                    </div>


                </div>
            </div>
        </div>
    </form>

</div>