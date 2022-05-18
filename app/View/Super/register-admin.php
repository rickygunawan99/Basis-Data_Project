<style>
    <?php
    require "assets_register/css/roboto-font.css";
    require "assets_register/css/style.css";
    require "assets_register/fonts/font-awesome-5/css/fontawesome-all.min.css";
    ?>
</style>
</head>



<body class="form-v5">
    <nav class="navbar navbar-light" style="background-color: #134f71">
        <div class="container">
            <a class="navbar-brand mb-0 h1 text-white badge bg-primary text-wrap fs-5" href="/super">Home</a>
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
        Admin baru berhasil ditambahkan
    </div>
<?php } ?>

<div class="page-content" style="background-color: #134f71">
    <div class="form-v5-content">
        <form class="form-detail border-rounded" action="" method="post">
            <h2>Register Admin</h2>
            <div class="form-row">
                <label for="your-email">Email</label>
                <input type="email" name="email" id="your-email" class="input-text" placeholder="abc@xyz.com" autocomplete="off" required>
                <i class="bi bi-envelope px-2"></i>
            </div>
            <div class="form-row">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="input-text" placeholder="Password" required>
                <i class="bi bi-file-lock2-fill px-2"></i>
            </div>
            <div class="form-row">
                <label for="full-name">Username</label>
                <input type="text" name="username" id="full-name" class="input-text" placeholder="Username" required>
                <i class="bi bi-person px-2"></i>
            </div>
            <div class="form-row-last">
                <input type="submit" name="register" class="register" value="Register">
            </div>
        </form>
    </div>
</div>