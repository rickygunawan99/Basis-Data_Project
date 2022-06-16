<style>
    <?php require "assets_user_dash/main.css" ?>
    a{
        font-family: Arial;
    }
    a:hover{
        text-decoration: none;
        color: red;
        text-decoration-thickness: 3px;
        text-decoration-style: revert;
    }
    #contact{
        color: blue;
    }
    #contact:hover{
        color: red;
        text-decoration-line: none;
    }
</style>
</head>
<body>

<nav class="navbar navbar-dark bg-light">
    <div class="container d-flex justify-content-between">
        <div class="left">
            <a class="text-black fs-5" href="/">Dashboard</a>
        </div>
        <div class="right">
            <?php if($model['user'] === null) {?>
                <a role="button" class="btn btn-outline-primary" href="/login">Login</a>
                <a role="button" class="btn btn-outline-primary" href="/register">Register</a>
            <?php } else if ($model['user'] !== null) { ?>
                <a class="btn bg-primary bg-gradient text-white me-2" type="button" href="/profile">
                    <i class="bi bi-person-fill"></i>
                    <?= $model['user']->username ?>
                </a>
                <a role="button" class="btn btn-outline-danger" href="/logout">Logout</a>
            <?php } ?>
        </div>
    </div>
</nav>



<section id="search">
    <div class="row justify-content-center mt-3">
        <div class="col-md-5 col-sm-7">
            <form class="d-flex" method="GET" action="">
                <input class="form-control me-2" type="search" name="s" placeholder="Search" aria-label="Search" style="border-radius: 20px" autocomplete="off">
                <button class="btn btn-outline-success" type="submit" style="border-radius: 20px">Search</button>
            </form>
        </div>
    </div>
</section>

<div class="container">
    <div class="container mt-3 fs-4">
        <label class="font-monospace">VOUCHER</label>
    </div>
    <?php if(isset($model['voucher']) && $model['voucher'] !== []) { ?>
        <div class="row">
            <?php foreach ($model['voucher'] as $row) { ?>
            <div class="col-md-3 col-sm-4">
                <div class="card fw-bold mt-2">
                    <div class="card-body text-center border border-info rounded-4">
                        <?php $name = str_replace(" ", "-", $row['nama_voucher'])?>
                        <a href="/voucher/<?=$row['id'] . '/' . $name?>"> <?= $row['nama_voucher']?> </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p class="text-center fw-bolder h5">Produk tidak ditemukan</p>
    <?php } ?>
</div>

