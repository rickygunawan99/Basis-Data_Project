<?php


namespace PHP\MVC\Service;


use PHP\MVC\Entity\Session;
use PHP\MVC\Entity\User;
use PHP\MVC\Repository\SessionRepository;
use PHP\MVC\Repository\UserRepository;

class SessionService
{
    public static string $COOKIE_NAME = "V-COOKIE";

    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->sessionRepository = new SessionRepository();
        $this->userRepository = new UserRepository();
    }

    public function create(string $email):Session
    {
        $session = new Session();
        $session->id = uniqid();
        $session->email = $email;
        $this->sessionRepository->save($session);

        setcookie(self::$COOKIE_NAME, $session->id, time() + (60 * 60 * 24 * 7), "/");
        return $session;
    }

    public function current(): ?User
    {
        if(isset($_COOKIE[self::$COOKIE_NAME])){
            $sessionId = $_COOKIE[self::$COOKIE_NAME];

            $session = $this->sessionRepository->findById($sessionId);

            return $this->userRepository->getByEmail($session->email);
        }
        return null;
    }

    public function destroy()
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME];

        $this->sessionRepository->destroy($sessionId);
        setcookie(self::$COOKIE_NAME, '', 1, '/');
    }
}