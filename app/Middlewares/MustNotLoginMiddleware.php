<?php


namespace PHP\MVC\Middlewares;


use PHP\MVC\App\View;
use PHP\MVC\Service\SessionService;

class MustNotLoginMiddleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function before()
    {
        $user = $this->sessionService->current();

        if($user != null ){
            if($user->role == "admin"){
                View::redirect("/admin");
            }else if($user->role == "user"){
                View::redirect("/");
            }
        }
    }
}