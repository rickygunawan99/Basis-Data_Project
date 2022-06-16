<?php


namespace PHP\MVC\Controller;


use PHP\MVC\App\View;
use PHP\MVC\Exception\ValidationException;
use PHP\MVC\Model\UserRegisterRequest;
use PHP\MVC\Repository\UserRepository;
use PHP\MVC\Service\SessionService;
use PHP\MVC\Service\SuperService;
use PHP\MVC\Service\UserServices;

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
        $request->nohp = $_POST['nohp'];

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

    public function detailAdmin()
    {
        $val = $this->superService->detailAdmin(0, 0);
        date_default_timezone_set("Asia/Jakarta");

        $month = date("m");
        $year = date("Y");

        if(isset($_GET['bulan']) && trim($_GET['bulan']) != ""){
            $date = explode("-", $_GET['bulan']);
            $month = $date[1];
            $year = $date[0];
            $val = $this->superService->detailAdmin($month, $year);
        }

        View::show("Super/detail-admin", [
            'title' => 'Detail Admin',
            'data' => $val
        ]);
    }

    public function detailUpdate()
    {
        if(isset($_GET['hari'])){
            $date = $_GET['hari'];
        }else{
            $date = date("Y-m-d");
        }

        $date = explode("-", $date);
        $year = $date[0];
        $month = $date[1];
        $day = $date[2];
        $data = $this->superService->detailUpdate($year, $month, $day);

        View::show("Super/detail-update", [
            'title' => 'Detail update',
            'data' => $data
        ]);
    }
}