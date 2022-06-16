
</head>

<body>
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


<div class="container mb-5">
    <?php if(isset($model['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <?=$model['error'] ?>
        </div>
    <?php } ?>

    <?php if(isset($model['success'])) { ?>
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <?=$model['success'] ?>
        </div>
    <?php } ?>

    <form class="row pt-5 mb-sm-auto" action="" method="GET">
        <div class="col-md-3 col-sm-4 d-flex flex-column gap-2">
            <a class="btn btn-outline-primary" href="/profile">
                <div class="profile d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z" />
                    </svg>
                    <span class="ms-2"> User Profile</span>
                </div>
            </a>
            <a class="btn btn-outline-primary" href="/password">
                <div class="profile d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-lock2" viewBox="0 0 16 16">
                        <path d="M10 7v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V9.3c0-.627.46-1.058 1-1.224V7a2 2 0 1 1 4 0zM7 7v1h2V7a1 1 0 0 0-2 0z" />
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                    </svg>
                    <span class="ms-2">Change Password</span>
                </div>
            </a>
            <a class="btn btn-outline-primary active" href="/history">
                <div class="profile d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                        <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                        <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    <span class="ms-2">History</span>
                </div>
            </a>
        </div>
        <div class="col-md-9 col-sm-10">
            <h4>History Pembelian</h4>
                <?php if($model['data'] !== []) { ?>
                    <div class="container d-flex flex-wrap justify-content-around" style="font-size: small">
                        <?php foreach ($model['data'] as $row) { ?>
                            <div class="card border border-2 border-info" style="width: 14rem;">
                                <div class="card-header">
                                    <sub>
                                        ID :<?= $row['id'] ?>
                                    </sub>
                                    <br>
                                    <b>
                                        <?= $row['produser'] . " - " . $row['voucher']?>
                                    </b>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <b>Date : <?= $row['tanggal'] ?></b>
                                    </li>
                                    <li class="list-group-item">
                                        Description : <?= $row['descr'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        Harga : <?= $row['harga'] ?>
                                    </li>
                                    <li class="list-group-item">
                                        Nominal : <?= $row['nominal'] ?>
                                    </li>
                                    <li class="list-group-item fw-bold">
                                        <?php if($row['status'] == 0) {?>
                                            <i class="text-gray">Status : Menunggu Diproses</i>
                                        <?php } else if ($row['status'] == 1) {?>
                                            <i class="text-success">Status : Sudah diproses</i>
                                        <?php }else { ?>
                                            <i class="text-danger">Status : Dana dikembalikan</i>
                                        <?php } ?>
                                    </li>
                                    <?php if ($row['status'] == 1) {?>
                                        <li class="list-group-item fw-bold">
                                            <i class="text-primary">Kode : <?= $row['kode'] ?></i>
                                        </li>
                                    <?php }?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>

                <?php } else { ?>
                    <h4>Transaksi masih kosong</h4>
                <?php }?>
            </div>
    </form>
</div>