<?php


namespace PHP\MVC\Middlewares;


use PHP\MVC\App\View;
use PHP\MVC\Service\SessionService;

class MustLoginSuperMiddleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function before()
    {
        $user = $this->sessionService->current();

        if($user == null || $user->role != 'super') {
            View::redirect("/");
        }

    }
}