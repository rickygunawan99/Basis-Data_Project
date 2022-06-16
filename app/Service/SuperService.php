<?php


namespace PHP\MVC\Service;


use PDO;
use PHP\MVC\Entity\User;
use PHP\MVC\Exception\ValidationException;
use PHP\MVC\Model\UserRegisterRequest;
use PHP\MVC\Model\UserRegisterResponse;
use PHP\MVC\Repository\HistoryRepository;
use PHP\MVC\Repository\TransactionsRepository;
use PHP\MVC\Repository\UserRepository;

class SuperService
{

    private UserRepository $userRepository;
    private TransactionsRepository $transactionsRepository;
    private HistoryRepository $historyRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->transactionsRepository = new TransactionsRepository();
        $this->historyRepository = new HistoryRepository();
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
        }

        if($user != null && ($user->nohp == $request->nohp)){
            throw new ValidationException("No hp sudah digunakan");
        }

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_BCRYPT);
        $user->role = "admin";
        $user->nohp = $request->nohp;

        $this->userRepository->save($user);

        $response = new UserRegisterResponse();
        $response->user = $user;

        return $response;

    }

    private function validateUserRegisterRequest(UserRegisterRequest $request){
        if($request->email == null || trim($request->email) == ""|| trim($request->password) == "" || trim($request->nohp) == "" ||
            $request->password == null || trim($request->username) == "" || $request->username == null || $request->nohp == null)
            throw new ValidationException("Harap lengkapi data diri");

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

    public function detailAdmin(int $month, int $year)
    {
        return $this->transactionsRepository->countDetailAdmin($month,$year);
    }

    public function detailUpdate(int $year, int $month, int $day)
    {
        return $this->historyRepository->detailUpdate($year,$month,$day);
    }
}