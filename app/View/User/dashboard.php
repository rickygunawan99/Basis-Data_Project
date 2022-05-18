<style>
    <?php require "assets_user_dash/main.css" ?>
    a{
        color: white;
        font-family: Arial;
    }
    a:hover{
        text-decoration: none;
        color: skyblue;
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

<section id="search">
    <div class="row justify-content-center mt-3">
        <div class="col-5">
            <form class="d-flex" method="GET" action="">
                <input class="form-control me-2" type="search" name="s" placeholder="Search" aria-label="Search" style="border-radius: 20px" autocomplete="off">
                <button class="btn btn-outline-success" type="submit" style="border-radius: 20px">Search</button>
            </form>
        </div>
    </div>
</section>

<div class="container">
    <div class="container mt-3 fs-4">
        <label class="font-monospace">VOUCHER LIST</label>
    </div>
    <?php if(isset($model['voucher']) && $model['voucher'] !== []) { ?>
        <div class="row">
            <?php foreach ($model['voucher'] as $row) { ?>
            <div class="col-3">
                <div class="card border bg-purple fw-bold">
                    <div class="card-body text-center">
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

