<?php


namespace PHP\MVC\Service;


use Exception;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\Session;
use PHP\MVC\Entity\User;
use PHP\MVC\Exception\ValidationException;
use PHP\MVC\Model\UserLoginRequest;
use PHP\MVC\Model\UserLoginResponse;
use PHP\MVC\Model\UserRegisterRequest;
use PHP\MVC\Model\UserRegisterResponse;
use PHP\MVC\Repository\ProductsRepository;
use PHP\MVC\Repository\ProduserRepository;
use PHP\MVC\Repository\SessionRepository;
use PHP\MVC\Repository\UserRepository;

class UserServices
{
    private UserRepository $userRepository;
    private ProduserRepository $produserRepository;
    private ProductsRepository $productsRepository;
    private SessionRepository $sessionRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->sessionRepository = new SessionRepository();
        $this->produserRepository = new ProduserRepository();
        $this->productsRepository = new ProductsRepository();
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
}