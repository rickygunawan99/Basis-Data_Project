    <style>
        <?php require "assets_login/css/main.css"?>
        <?php require "assets_login/css/util.css" ?>
        <?php require "assets_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css"?>
    </style>
</head>

<nav class="navbar navbar-dark bg-light">
    <div class="container d-flex justify-content-between">
        <div class="left">
            <a class="text-black fs-4" href="/">Dashboard</a>
        </div>
    </div>
</nav>

<body>
    <?php if(isset($model['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show text-center w-50 mx-auto" role="alert">
            <strong> <?= $model['error'] ?? '' ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

<!--	<div class="limiter">-->
<!--		<div class="container-login100">-->
<!--			<div class="wrap-login100 d-flex justify-content-center">-->
<!--				<form class="login100-form validate-form" action="/login" method="post">-->
<!--					<span class="login100-form-title">-->
<!--						Sign In-->
<!--					</span>-->
<!---->
<!--					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">-->
<!--						<input class="input100" type="email" name="email" placeholder="Email" autocomplete="off"-->
<!--                        value="--><?//= $_POST['email'] ?? '' ?><!--">-->
<!--						<span class="focus-input100"></span>-->
<!--						<span class="symbol-input100">-->
<!--							<i class="bi bi-envelope" aria-hidden="true"></i>-->
<!--						</span>-->
<!--					</div>-->
<!---->
<!--					<div class="wrap-input100 validate-input" data-validate = "Password is required">-->
<!--						<input class="input100" type="password" name="password" placeholder="Password">-->
<!--						<span class="focus-input100"></span>-->
<!--						<span class="symbol-input100">-->
<!--							<i class="bi bi-lock" aria-hidden="true"></i>-->
<!--						</span>-->
<!--					</div>-->
<!--					-->
<!--					<div class="container-login100-form-btn">-->
<!--						<button class="login100-form-btn" type="submit" name="login">-->
<!--							Login-->
<!--						</button>-->
<!--					</div>-->
<!---->
<!--					<div class="text-center p-t-40">-->
<!--						<a class="txt2" href="/register">-->
<!--							Register Account ? Click Here-->
<!--                            <i class="bi bi-arrow-right"></i>-->
<!--						</a>-->
<!--					</div>-->
<!--				</form>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->

    <div class="container">
        <div class="container mt-5">
            <h2 class="text-center">Sign In</h2>
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
                    <button class="w-100 btn btn-lg btn-primary" type="submit" value="register" name="login">Login</button>
                    <div class="container d-flex justify-content-center mt-3">
                        <a class="txt2" href="/register">
                            Register Account ? Click Here
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>