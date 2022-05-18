<?php

namespace PHP\MVC\Controller;

use Exception;
use PHP\MVC\App\View;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\User;
use PHP\MVC\Exception\ValidationException;
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
            'title' => 'Edit Profile'
        ]);
    }

    public function logout()
    {
        $this->sessionService->destroy();
        View::redirect("/");
    }
}