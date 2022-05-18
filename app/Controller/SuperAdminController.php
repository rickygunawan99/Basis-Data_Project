<?php


namespace PHP\MVC\Controller;


use PHP\MVC\App\View;
use PHP\MVC\Exception\ValidationException;
use PHP\MVC\Model\UserRegisterRequest;
use PHP\MVC\Service\SessionService;
use PHP\MVC\Service\SuperService;

class SuperAdminController
{
    private SuperService $superService;
    private SessionService $sessionService;

    public function __construct()
    {
        $this->superService = new SuperService();
        $this->sessionService = new SessionService();
    }

    public function dashboard()
    {

        View::show("Super/dashboard",[
            'title' => 'Super',
            'data' => $this->superService->getReport()
        ]);
    }

    public function regisAdmin()
    {
        View::show("Super/register-admin", [
            'title' => 'Register Admin'
        ]);
    }

    public function postRegisAdmin()
    {
        $request = new UserRegisterRequest();
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];
        $request->username = $_POST['username'];

        try {
            $this->superService->register($request);
            View::show("Super/register-admin",[
                'title' => 'Register Admin',
                'regis_status' => 'success'
            ]);
        }catch (ValidationException $e){
            View::show("Super/register-admin",[
                'title' => 'Register user',
                'regis_status' => 'failed',
                'message' => $e->getMessage()
            ]);
        }
    }
}