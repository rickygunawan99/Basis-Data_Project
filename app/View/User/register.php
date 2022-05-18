<style>
    <?php
    require "assets_register/css/roboto-font.css";
    require "assets_register/css/style.css";
    require "assets_register/fonts/font-awesome-5/css/fontawesome-all.min.css";
    ?>
</style>
</head>


<body>
<nav class="navbar navbar-dark bg-gray">
    <div class="container">
        <a class="navbar-brand mb-0 h1" href="/">HOME</a>
    </div>
</nav>

<?php if(isset($model['regis_status']) && $model['regis_status'] == 'failed') { ?>
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong> <?= $model['message'] ?? '' ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php if(isset($model['regis_status']) && $model['regis_status'] == 'success') { ?>
    <div class="alert alert-success text-center" role="alert">
        Register berhasil, silahkan <a href="/login" class="alert-link">Login</a> kembali.
    </div>
<?php } ?>

<div class="page-content">
    <div class="form-v5-content border">
        <form class="form-detail border-rounded" action="" method="post">
            <h2>Register Account</h2>
            <div class="form-row">
                <label for="your-email">Email</label>
                <input type="email" name="email" id="your-email" class="input-text" placeholder="abc@xyz.com" autocomplete="off" required>
                <i class="bi bi-envelope px-2"></i>
            </div>
            <div class="form-row">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="input-text" placeholder="Password" required autocomplete="off">
                <i class="bi bi-lock px-2"></i>
            </div>
            <div class="form-row">
                <label for="full-name">Username</label>
                <input type="text" name="username" id="full-name" class="input-text" placeholder="Username" required autocomplete="off">
                <i class="bi bi-person px-2"></i>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
            <div class="text-center fs-6">
                Sudah memiliki akun ? <strong><a href="/login">Login</a></strong>
            </div>
        </form>
    </div>
</div>