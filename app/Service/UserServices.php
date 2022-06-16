<?php


namespace PHP\MVC\Service;


use Exception;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\Session;
use PHP\MVC\Entity\Transaction;
use PHP\MVC\Entity\User;
use PHP\MVC\Exception\ValidationException;
use PHP\MVC\Model\UpdatePasswordRequest;
use PHP\MVC\Model\UserCheckoutRequest;
use PHP\MVC\Model\UserCheckoutResponse;
use PHP\MVC\Model\UserLoginRequest;
use PHP\MVC\Model\UserLoginResponse;
use PHP\MVC\Model\UserRegisterRequest;
use PHP\MVC\Model\UserRegisterResponse;
use PHP\MVC\Repository\ProductsRepository;
use PHP\MVC\Repository\ProduserRepository;
use PHP\MVC\Repository\SessionRepository;
use PHP\MVC\Repository\TransactionsRepository;
use PHP\MVC\Repository\UserRepository;

class UserServices
{
    private UserRepository $userRepository;
    private ProduserRepository $produserRepository;
    private ProductsRepository $productsRepository;
    private SessionRepository $sessionRepository;
    private TransactionsRepository $transactionRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->sessionRepository = new SessionRepository();
        $this->produserRepository = new ProduserRepository();
        $this->productsRepository = new ProductsRepository();
        $this->transactionRepository = new TransactionsRepository();
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
            $user->role = "user";
            $user->nohp = $request->nohp;

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

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->getByEmail($request->email);

        if($user == null ){
            throw new ValidationException("Email dan password salah");
        }

        if(password_verify($request->password,$user->password)){
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        }else{
            throw new ValidationException("Email atau password salah");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request){
        if(trim($request->password) == "" || trim($request->email) == "" ||
            $request->email == null || $request->password == null)
            throw new ValidationException("Email dan password tidak boleh kosong");

        $pattern = "#^([a-zA-Z0-9]*)@([a-z]*).com$#";
        if(!preg_match($pattern,$request->email,$variabel)){
            throw new ValidationException("Format email tidak sesuai");
        }
    }

    public function checkout(UserCheckoutRequest $request) : UserCheckoutResponse
    {
        $this->validateUserCheckout($request);

        $transaction = new Transaction();
        $transaction->idProduct = $request->idProduct;
        $transaction->email = $request->email;
        $transaction->totalHarga = $request->productPrice;

        try {
            Database::beginTransaction();
            $id = $this->transactionRepository->save($transaction);
            Database::commit();

            $response = new UserCheckoutResponse();
            $response->id = $id;

            return $response;
        }catch (ValidationException $exception){
            Database::rollback();
            throw $exception;
        }
    }

    private function validateUserCheckout(UserCheckoutRequest $request){
        if($this->getVoucherById($request->idProduct)[0]['stock'] <= 0 ){
            throw new ValidationException("Product habis terjual");
        }
    }

    public function editUsername(User $user, string $newUsername){
        $this->validateUserEditUsername($newUsername);

        $this->userRepository->editProfile("username", $user, $newUsername);
    }

    private function validateUserEditUsername(string $newUsername){
        if($newUsername == null || trim($newUsername) == ""){
            throw new ValidationException("Username tidak boleh kosong");
        }
    }

    public function updatePassword(User $user, UpdatePasswordRequest $request)
    {
        $this->validateUpdatePassword($request);

        if(!password_verify($request->oldpass, $user->password)){
            throw new ValidationException("Password lama salah");
        }

        $newPassword = password_hash($request->newpass, PASSWORD_BCRYPT );

        $this->userRepository->editProfile("password", $user, $newPassword);
    }

    private function validateUpdatePassword(UpdatePasswordRequest $request)
    {
        if($request->oldpass == null || $request->newpass == null || $request->confpass == null ||
           trim($request->oldpass) == "" || trim($request->newpass) == "" || trim($request->confpass) == ""){
            throw new ValidationException("Input tidak boleh kosong");
        }

        if($request->newpass != $request->confpass){
            throw new ValidationException("Input password baru dan password konfirmasi berbeda");
        }
    }

    public function getVoucherById(int $id):array
    {
        return $this->productsRepository->getProductById($id);
    }

    public function getVoucherByProduserId(int $id):array
    {
        return $this->productsRepository->getByProduserId($id);
    }

    public function getAllVoucher():array
    {
        return $this->produserRepository->getVouchersName();
    }

    public function getVoucherByName(string $name):array
    {
        return $this->produserRepository->getVoucherByName($name);
    }

    public function getTransactionById(int $id):array
    {
        return $this->transactionRepository->getTransactionId($id);
    }

    public function getHistory(string $email):array
    {
        return $this->transactionRepository->getHistoryByEmail($email);
    }
}