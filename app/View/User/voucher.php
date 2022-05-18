<style>
    #btnbeli:hover{
        background-color: blue;
        color: white;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <?php if($model['user'] === null) {?>
                    <li>
                        <a role="button" class="btn btn-outline-primary" href="/login">Login</a>
                    </li>
                <?php } else if ($model['user'] !== null) { ?>
                    <li>
                        <a class="btn bg-primary bg-gradient text-white me-2" type="button" href="/profile">
                            <i class="bi bi-person-fill"></i>
                            <?= $model['user']->username ?>
                        </a>
                    </li>
                    <li>
                        <a role="button" class="btn btn-outline-danger" href="/logout">Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="container mt-3 fs-5 fw-bold">
        <label>NAMA VOUCHER</label>
    </div>
        <div class="row">
            <?php if(isset($model['vouchers']) && $model['vouchers'] !== []) {?>
                <?php foreach ($model['vouchers'] as $row) { ?>
                    <div class="col-4">
                        <div class="card border bg-transparent">
                            <div class="card-body">
                                <div class="row">
                                    <?= $row['description'] ?>
                                </div>
                                <div class="row align-items-center pt-1">
                                    <div class="text-start" style="font-size: smaller; padding-left: 0">
                                        Item yang didapat : <?=$row['jml_item'] ?>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6 pt-2" style="font-size: smaller;padding-left: 0">
                                        <div class="text-start">stock : <?= $row['stock'] ?></div>
                                    </div>
                                    <div class="col-4 mt-2 ms-auto text-end">
                                        <?php if($row['stock'] > 0) { ?>
                                            <button class="btn btn-outline-primary btn-sm rounded-5" id="btnbeli">BUY</button>
                                        <?php } else {?>
                                            <button class="btn btn-outline-primary btn-sm rounded-5" id="btnbeli" disabled>BUY</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <h5 class="text-center">Product belum tersedia</h5>
            <?php } ?>
        </div>

</div>