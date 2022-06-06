<?php


namespace PHP\MVC\Service;


use PDO;
use PHP\MVC\Entity\User;
use PHP\MVC\Exception\ValidationException;
use PHP\MVC\Model\UserRegisterRequest;
use PHP\MVC\Model\UserRegisterResponse;
use PHP\MVC\Repository\TransactionsRepository;
use PHP\MVC\Repository\UserRepository;

class SuperService
{
    private PDO $pdo;

    private UserRepository $userRepository;
    private TransactionsRepository $transactionsRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->transactionsRepository = new TransactionsRepository();
    }

    public function getReport(): array
    {
        return $this->transactionsRepository->report();
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {

        $this->validateUserRegisterRequest($request);

        $user = $this->userRepository->getByEmail($request->email);

        if($user != null){
            throw new ValidationException("Email tidak dapat digunakan");
        }else{
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);
            $user->role = "admin";

            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->user = $user;

            return $response;
        }
    }

    private function validateUserRegisterRequest(UserRegisterRequest $request){
        if($request->email == null || trim($request->email) == ""|| trim($request->password) == "" ||
            $request->password == null || trim($request->username) == "" || $request->username == null)
            throw new ValidationException("Username, id, dan password tidak boleh kosong");

        $pattern = "#^([a-z0-9]*)@([a-z]*).com$#";
        if(!preg_match($pattern,$request->email,$variabel)){
            throw new ValidationException("Format email tidak sesuai");
        }
    }

    public function countMothlyTotalConfirm():int
    {
        return $this->transactionsRepository->countMonthlyTotalConfirm();
    }

    public function countMothlyTotalWaiting():int
    {
        return $this->transactionsRepository->countMonthlyTotalWaiting();
    }

    public function countMothlyTotalCancel():int
    {
        return $this->transactionsRepository->countMonthlyTotalCancel();
    }

    public function countTotalAdmin():int
    {
        return $this->userRepository->countTotalAdmin();
    }

    public function detail(int $month, int $year)
    {
        return $this->transactionsRepository->detail($month, $year);
    }

    public function totalSalaryMonth(int $month, int $year){
        return $this->transactionsRepository->totalSalaryMonth($month, $year);
    }
}