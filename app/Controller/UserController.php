<?php

namespace PHP\MVC\Controller;

use Exception;
use PHP\MVC\App\View;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\User;
use PHP\MVC\Exception\ValidationException;
use PHP\MVC\Model\UpdatePasswordRequest;
use PHP\MVC\Model\UserCheckoutRequest;
use PHP\MVC\Model\UserLoginRequest;
use PHP\MVC\Model\UserRegisterRequest;
use PHP\MVC\Model\UserRegisterResponse;
use PHP\MVC\Repository\SessionRepository;
use PHP\MVC\Repository\UserRepository;
use PHP\MVC\Service\SessionService;
use PHP\MVC\Service\UserServices;

class UserController
{
    private UserServices $userService;
    private SessionService $sessionService;

    public function __construct()
    {
        $userRepository = new UserRepository();
        $this->sessionService = new SessionService();
        $this->userService = new UserServices($userRepository);
    }

    public function register()
    {
        View::show("User/register",[
            'title' => 'Register users'
        ]);
    }

    public function postRegister()
    {
        $request = new UserRegisterRequest();
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        $request->username = $_POST['username'];
        $request->nohp = $_POST['nohp'];

        try {
            $this->userService->register($request);
            View::show("User/register",[
                'title' => 'Register user',
                'regis_status' => 'success',
                'message' => 'register berhasil, silahkan login kembali'
            ]);
        }catch (ValidationException $e){
            View::show("User/register",[
                'title' => 'Register user',
                'regis_status' => 'failed',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function login()
    {
        View::show("User/login",[
            'title' => 'Login users'
        ]);
    }

    public function postLogin()
    {
        $user = new UserLoginRequest();
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        try {
            $request = $this->userService->login($user);
            $this->sessionService->create($user->email);

            if ($request->user->role == "admin") {
                View::redirect("/admin");
            }elseif ($request->user->role == "super"){
                View::redirect("/super");
            }else{
                View::redirect("/");
            }

        }catch (ValidationException $exception){
            View::show("User/login",[
                'title' => 'Login gagal',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function dashboard()
    {
        $voucher = $this->userService->getAllVoucher();
        $user = null;
        if(isset($_COOKIE[SessionService::$COOKIE_NAME])) {
            $user = $this->sessionService->current();

            if($user->role == "admin"){
                View::redirect("/admin");
            }else if($user->role == "super"){
                View::redirect("/super");
            }
        }

        if(isset($_GET['s']) && trim($_GET['s'] != "")){
            $voucher = $this->userService->getVoucherByName($_GET['s']);
        }

        View::show("User/dashboard",[
            'title' => 'Dashboard',
            'voucher' => $voucher,
            'user' => $user
        ]);
    }


    public function voucher(int $id, string $name)
    {
        $voucherList = $this->userService->getVoucherByProduserId($id);
        $user = null;
        if(isset($_COOKIE[SessionService::$COOKIE_NAME])) {
            $user = $this->sessionService->current();
        }

        View::show("User/voucher", [
            'title' => 'Data Voucher',
            'user' => $user,
            'vouchers' => $voucherList
        ]);
    }

    public function profile()
    {
        View::show("User/profile", [
            'title' => 'Edit Profile',
            'user' => $this->sessionService->current()
        ]);
    }

    public function postEditProfile()
    {
        $user = $this->sessionService->current();
        try {
            $this->userService->editUsername($user, $_POST['username']);
            View::show("User/profile", [
                'title' => 'Edit Profile',
                'user' => $this->sessionService->current(),
                'success'  => 'Edit username sukses'
            ]);
        }catch (ValidationException $e){
            View::show("User/profile", [
                'title' => 'Edit Profile',
                'user' => $this->sessionService->current(),
                'error' => $e->getMessage()
            ]);
        }
    }

    public function password()
    {
        View::show("User/password", [
            'title' => 'Edit Password',
            'user' => $this->sessionService->current()
        ]);
    }

    public function postEditPassword()
    {
        $user = $this->sessionService->current();
        $request = new UpdatePasswordRequest();
        $request->oldpass = $_POST['oldpass'];
        $request->newpass = $_POST['newpass'];
        $request->confpass = $_POST['confpass'];
        try {
            $this->userService->updatePassword($user, $request);
            View::show("User/password", [
                'title' => 'Edit Password',
                'user' => $this->sessionService->current(),
                'success'  => 'Update password sukses'
            ]);
        }catch (ValidationException $e){
            View::show("User/password", [
                'title' => 'Edit Password',
                'user' => $this->sessionService->current(),
                'error' => $e->getMessage()
            ]);
        }
    }

    public function checkout()
    {
        $id = $_GET['v_id'];
        $voucher = $this->userService->getVoucherById($id)[0];
        View::show("User/checkout", [
            'title' => 'Checkout',
            'voucher' => $voucher
        ]);
    }

    public function postCheckout()
    {
        $id = $_GET['v_id'];
        $voucher = $this->userService->getVoucherById($id)[0];

        $request = new UserCheckoutRequest();
        $request->email = $this->sessionService->current()->email;
        $request->productPrice = $voucher['harga'];
        $request->idProduct = $id;

        try {
            $response = $this->userService->checkout($request);
            View::redirect("/process?pay_id=$response->id");
        }catch (ValidationException $exception){
            View::show("User/checkout", [
                'Title' => 'Checkout',
                'error' => $exception
            ]);
        }
    }

    public function process()
    {
        $pay_id = $_GET['pay_id'];
        $info = $this->userService->getTransactionById($pay_id)[0];
        View::show("User/process", [
            'title' => 'Payment Process',
            'info' => $info
        ]);
    }

    public function history()
    {
        $current = $this->sessionService->current();
        View::show("User/history", [
            'title' => 'History Transaksi',
            'user' => $this->sessionService->current(),
            'data' => $this->userService->getHistory($current->email)
        ]);
    }

    public function logout()
    {
        $this->sessionService->destroy();
        View::redirect("/");
    }
}