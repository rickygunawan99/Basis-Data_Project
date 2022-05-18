<style>
    <?php
    require "assets_register/css/roboto-font.css";
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
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong> <?= $model['error'] ?? '' ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php //if(isset($model['regis_status']) && $model['regis_status'] == 'success') { ?>
<!--    <div class="alert alert-success text-center" role="alert">-->
<!--        Login berhasil, silahkan <a href="/user-login" class="alert-link">Login</a> kembali.-->
<!--    </div>-->
<?php //} ?>

<div class="page-content">
    <div class="form-v5-content border">
        <form class="form-detail" action="" method="post">
            <h2>ADD PRODUSER</h2>
            <div class="form-row">
                <label for="produserName">Produser Name</label>
                <input type="text" name="produserName" id="produserName" class="input-text" placeholder="Produser Name" autocomplete="off" required>
            </div>
            <div class="form-row">
                <label for="voucherName">Voucher Name</label>
                <input type="text" name="voucherName" id="voucherName" class="input-text" placeholder="Voucher name" required>
            </div>
            <div class="d-flex justify-content-evenly">
                <a class="btn btn-primary btn-lg" href="/admin" role="button">Back</a>
                <button class="btn btn-success btn-lg" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>