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
            'data' => $this->superService->getReport(),
            'info' => [
                'confirm' => $this->superService->countMothlyTotalConfirm(),
                'waiting' => $this->superService->countMothlyTotalWaiting(),
                'cancel' => $this->superService->countMothlyTotalCancel(),
                'admin' => $this->superService->countTotalAdmin()
            ]
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

    public function detail()
    {
        date_default_timezone_set("Asia/Jakarta");
        
        $month = date("m");
        $year = date("Y");
        
        if(isset($_GET['bulan'])){
            $date = explode("-", $_GET['bulan']);
            $month = $date[1];
            $year = $date[0];
        }
        
        View::show("Super/detail", [
            'title' => 'Register Admin',
            'data' => $this->superService->detail($month, $year)
        ]);
    }
}