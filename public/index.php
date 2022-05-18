<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHP\MVC\App\Router;
use PHP\MVC\Config\Database;
use PHP\MVC\Controller\AdminController;
use PHP\MVC\Controller\SuperAdminController;
use PHP\MVC\Controller\UserController;

Database::getConnection();

Router::add("GET","/logout",UserController::class,"logout");

Router::add("GET","/login",UserController::class,"login");
Router::add("POST","/login",UserController::class,"postLogin");

Router::add("GET","/register",UserController::class,"register");
Router::add("POST","/register",UserController::class,"postRegister");

Router::add("GET","/",UserController::class,"dashboard");

Router::add("GET","/voucher/([0-9]*)/([a-zA-Z0-9-]*)",UserController::class,"voucher");

Router::add("GET","/profile",UserController::class,"profile");

Router::add("GET","/admin",AdminController::class,"dashboard");

Router::add("GET","/admin/add-produser",AdminController::class,"addProduser");
Router::add("POST","/admin/add-produser",AdminController::class,"postAddProduser");

Router::add("GET","/admin/add-product",AdminController::class,"addProduct");
Router::add("POST","/admin/add-product",AdminController::class,"postAddProduct");

Router::add("GET","/admin/edit-transaction/([0-9]*)",AdminController::class,"editTransaction");
Router::add("POST","/admin/edit-transaction/([0-9]*)",AdminController::class,"postEditTransaction");

Router::add("GET","/admin/edit-product/([0-9]*)",AdminController::class,"editProduct");
Router::add("POST","/admin/edit-product/([0-9]*)",AdminController::class,"postEditProduct");

Router::add("GET","/admin/edit-produser/([0-9]*)",AdminController::class,"editProduser");
Router::add("POST","/admin/edit-produser/([0-9]*)",AdminController::class,"postEditProduser");

Router::add("GET","/super",SuperAdminController::class,"dashboard");

Router::add("GET","/super/register-admin",SuperAdminController::class,"regisAdmin");
Router::add("POST","/super/register-admin",SuperAdminController::class,"postRegisAdmin");

Router::run();

Database::closeConnection();