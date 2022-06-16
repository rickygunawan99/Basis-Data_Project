<?php

?>
<div class="container">
    <div class="row justify-content-center pt-3">
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <div class="fs-5 fw-bold">
                        <i class="bi bi-clipboard-check"></i>
                        Payment Created
                    </div>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12 border">
                    <div class="row mt-2 fs-5">
                        <div class="col-4">Payment No.</div>
                        <div class="col-4 fw-bold"> <?= $_GET['pay_id'] ?> </div>
                    </div>
                    <hr>

                    <div class="info" style="font-size: smaller">
                        <div class="row mt-2">
                            <div class="col-4">Created</div>
<!--                            --><?php //date_default_timezone_set("Asia/Jakarta") ?>
                            <?php $now = $model['info']['tgl_pembelian'] ?? '' ?>
                            <div class="col-4 fw-bold"> <?= $now ?> </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">Expiry</div>
                            <?php $exp = strtotime($now) + (60*60*4) ?? '' ?>
                            <div class="col-4 fw-bold"> <?= date("Y-m-d H:i:s",$exp) ?? ''?> </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">Total</div>
                            <div class="col-4 fw-bold" style="color: red">
                                Rp. <?php echo number_format($model['info']['harga'],0, "",".") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-8 border">
            <div class="text fw-bold" style="letter-spacing: 0.1rem">
                Lakukan pembayaran ke rekening berikut agar transaksi diproses
            </div>
            <div class="row p-3">
                <div class="col-2 ps-3">
                    <img src="/assets_process/bca-logo.jpg" alt="Bca logo"  style="height: 10vh; padding: 0">
                </div>
                <div class="col-7 fs-2 d-flex align-items-center font-monospace" style="letter-spacing: 0.3rem">
                    <div class="text fw-bold">123456789</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-4 justify-content-center">
        <div class="col-8">
            <div class="row justify-content-around">
                <div class="col-4">
                    <a href="/" class="btn btn-primary" role="button">Back to Home</a>
                </div>
                <div class="col-4">
                    <a href="/history" class="btn btn-primary" role="button">History</a>
                </div>
            </div>
        </div>
    </div>
</div>