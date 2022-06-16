<style>
    <?php
    require "assets_register/css/roboto-font.css";
    require "assets_register/css/style.css";
    require "assets_register/fonts/font-awesome-5/css/fontawesome-all.min.css";
    ?>
</style>
</head>


<body>

<?php if(isset($model['regis_status']) && $model['regis_status'] == 'failed') { ?>
    <div class="alert alert-danger alert-dismissible fade show text-center mt-3 w-50 mx-auto" role="alert">
        <strong> <?= $model['message'] ?? '' ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<?php if(isset($model['regis_status']) && $model['regis_status'] == 'success') { ?>
    <div class="alert alert-success text-center mt-3 w-50 mx-auto" role="alert">
        Register berhasil, silahkan <a href="/login" class="alert-link">Login</a> kembali.
    </div>
<?php } ?>

<!--<div class="page-content">-->
<!--    <div class="form-v5-content border">-->
<!--        <form class="form-detail border-rounded" action="" method="post">-->
<!--            <h2>Register Account</h2>-->
<!--            <div class="form-row">-->
<!--                <label for="your-email">Email</label>-->
<!--                <input type="email" name="email" id="your-email" class="input-text" placeholder="abc@xyz.com" autocomplete="off" required>-->
<!--                <i class="bi bi-envelope px-2"></i>-->
<!--            </div>-->
<!--            <div class="form-row">-->
<!--                <label for="password">Password</label>-->
<!--                <input type="password" name="password" id="password" class="input-text" placeholder="Password" required autocomplete="off">-->
<!--                <i class="bi bi-lock px-2"></i>-->
<!--            </div>-->
<!--            <div class="form-row">-->
<!--                <label for="full-name">Username</label>-->
<!--                <input type="text" name="username" id="full-name" class="input-text" placeholder="Username" required autocomplete="off">-->
<!--                <i class="bi bi-person px-2"></i>-->
<!--            </div>-->
<!--            <div class="d-flex justify-content-center mb-3">-->
<!--                <button type="submit" class="btn btn-primary">Register</button>-->
<!--            </div>-->
<!--            <div class="text-center fs-6">-->
<!--                Sudah memiliki akun ? <strong><a href="/login">Login</a></strong>-->
<!--            </div>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->

<div class="container">
    <div class="container mt-5">
        <h3 class="text-center">Register Akun</h3>
    </div>
    <div class="row justify-content-center pt-5">
        <div class="col-md-10 col-lg-6">
            <form class="p-4 p-md-5 border rounded-3 bg-light" method="POST" action="">
                <div class="form-floating mb-3">
                    <input name="email" type="text" class="form-control" id="email" placeholder="email" autocomplete="off" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="password" type="password" class="form-control" id="password" placeholder="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="username" type="text" class="form-control" id="username" placeholder="username" autocomplete="off" required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="nohp" type="text" class="form-control" id="nohp" placeholder="No Handphone" autocomplete="off" required>
                    <label for="nohp">No Handphone</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit" value="register" name="register">Register</button>
                <div class="container d-flex justify-content-center mt-3">
                    <a class="txt2" href="/login">
                        Already have account ? Click Here
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>