<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHP\MVC\App\Router;
use PHP\MVC\Config\Database;
use PHP\MVC\Controller\AdminController;
use PHP\MVC\Controller\SuperAdminController;
use PHP\MVC\Controller\UserController;
use PHP\MVC\Middlewares\MustLoginAdminMiddleware;
use PHP\MVC\Middlewares\MustLoginMiddleware;
use PHP\MVC\Middlewares\MustNotLoginMiddleware;

Database::getConnection();

Router::add("GET","/logout",UserController::class,"logout");

Router::add("GET","/login",UserController::class,"login",[MustNotLoginMiddleware::class]);
Router::add("POST","/login",UserController::class,"postLogin", [MustNotLoginMiddleware::class]);

Router::add("GET","/register",UserController::class,"register", [MustNotLoginMiddleware::class]);
Router::add("POST","/register",UserController::class,"postRegister, [MustNotLoginMiddleware::class]");

Router::add("GET","/",UserController::class,"dashboard");

Router::add("GET","/voucher/([0-9]*)/([a-zA-Z0-9-]*)",UserController::class,"voucher");
Router::add("GET","/checkout",UserController::class,"checkout", [MustLoginMiddleware::class]);
Router::add("POST","/checkout",UserController::class,"postCheckout", [MustLoginMiddleware::class]);

Router::add("GET","/process",UserController::class,"process", [MustLoginMiddleware::class]);

Router::add("GET","/profile",UserController::class,"profile",[MustLoginMiddleware::class]);
Router::add("POST","/profile",UserController::class,"postEditProfile", [MustLoginMiddleware::class]);

Router::add("GET","/password",UserController::class,"password", [MustLoginMiddleware::class]);
Router::add("POST","/password",UserController::class,"postEditpassword", [MustLoginMiddleware::class]);

Router::add("GET","/history",UserController::class,"history", [MustLoginMiddleware::class]);

Router::add("GET","/admin",AdminController::class,"dashboard", [MustLoginAdminMiddleware::class]);

Router::add("GET","/admin/add-produser",AdminController::class,"addProduser",  [MustLoginAdminMiddleware::class]);
Router::add("POST","/admin/add-produser",AdminController::class,"postAddProduser",  [MustLoginAdminMiddleware::class]);

Router::add("GET","/admin/add-product",AdminController::class,"addProduct",  [MustLoginAdminMiddleware::class]);
Router::add("POST","/admin/add-product",AdminController::class,"postAddProduct",  [MustLoginAdminMiddleware::class]);

Router::add("GET","/admin/edit-transaction/([0-9]*)",AdminController::class,"editTransaction", [MustLoginAdminMiddleware::class] );
Router::add("POST","/admin/edit-transaction/([0-9]*)",AdminController::class,"postEditTransaction",[MustLoginAdminMiddleware::class]);

Router::add("GET","/admin/edit-product/([0-9]*)",AdminController::class,"editProduct",  [MustLoginAdminMiddleware::class]);
Router::add("POST","/admin/edit-product/([0-9]*)",AdminController::class,"postEditProduct",  [MustLoginAdminMiddleware::class]);

Router::add("GET","/admin/edit-produser/([0-9]*)",AdminController::class,"editProduser",  [MustLoginAdminMiddleware::class]);
Router::add("POST","/admin/edit-produser/([0-9]*)",AdminController::class,"postEditProduser",  [MustLoginAdminMiddleware::class]);

Router::add("GET","/super",SuperAdminController::class,"dashboard");

Router::add("GET","/super/register-admin",SuperAdminController::class,"regisAdmin");
Router::add("POST","/super/register-admin",SuperAdminController::class,"postRegisAdmin");

Router::add("GET","/super/detail",SuperAdminController::class,"detail");


Router::run();