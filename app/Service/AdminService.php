<?php


namespace PHP\MVC\Service;


use mysql_xdevapi\Exception;
use PDOException;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\Product;
use PHP\MVC\Entity\Produser;
use PHP\MVC\Entity\Transaction;
use PHP\MVC\Entity\User;
use PHP\MVC\Exception\ValidationException;
use PHP\MVC\Model\RegisterProductRequest;
use PHP\MVC\Model\RegisterProductResponse;
use PHP\MVC\Model\registerProduserRequest;
use PHP\MVC\Model\RegisterProduserResponse;
use PHP\MVC\Model\UpdateProductRequest;
use PHP\MVC\Model\UpdateProductResponse;
use PHP\MVC\Model\UpdateProduserRequest;
use PHP\MVC\Model\UpdateProduserResponse;
use PHP\MVC\Model\UpdateTransactionRequest;
use PHP\MVC\Model\UpdateTransactionResponse;
use PHP\MVC\Model\UserRegisterRequest;
use PHP\MVC\Repository\HistoryRepository;
use PHP\MVC\Repository\ProductsRepository;
use PHP\MVC\Repository\ProduserRepository;
use PHP\MVC\Repository\TransactionsRepository;

class AdminService
{
    private ProduserRepository $produserRepository;
    private ProductsRepository $productsRepository;
    private TransactionsRepository $transactionsRepository;
    private HistoryRepository $historyRepository;

    public function __construct(ProduserRepository $produserRepository)
    {
        $this->produserRepository = $produserRepository;
        $this->productsRepository = new ProductsRepository();
        $this->transactionsRepository = new TransactionsRepository();
        $this->historyRepository = new HistoryRepository();
    }

    public function registerProduser(RegisterProduserRequest $request) : ?RegisterProduserResponse
    {
        $this->validateProduserRegisterRequest($request);

//        $produser = $this->produserRepository->getProduserByName($request->namaProduser);
//
//        if($produser != null){
//            foreach ($produser as $row){
//                if(strtolower($row['nama_produser']) == strtolower($request->namaProduser)
//                    && strtolower($row['nama_voucher']) == strtolower($request->namaVoucher)){
//                    throw new ValidationException("Register gagal, data sudah ada");
//                }
//            }
//        }

        try {
            $produser = new Produser();
            $produser->produserName = $request->namaProduser;
            $produser->voucherName = $request->namaVoucher;
            $this->produserRepository->save($produser);

            $response = new RegisterProduserResponse();
            $response->produser = $produser;

            return $response;
        }catch (PDOException $exception){
            throw new ValidationException("Data produser yang sama sudah ada!");
        }
    }

    private function validateProduserRegisterRequest(RegisterProduserRequest $request){
        if($request->namaProduser == null || trim($request->namaProduser) == ""
            || trim($request->namaVoucher) == "" || $request->namaVoucher == null)
            throw new ValidationException("Nama produser dan nama voucher tidak boleh kosong");
    }

    public function registerProduct(RegisterProductRequest $request) : ?RegisterProductResponse
    {
        $this->validateProductRegisterRequest($request);


        $product = $this->productsRepository->getProductByProduserIdAndItem($request->product->idProduser, $request->product->jmlItem,$request->product->harga);

        if($product != null){
            throw new ValidationException("Data product sudah ada");
        }

        $product = new Product();
        $product->idProduser = $request->product->idProduser;
        $product->description = ucwords($request->product->description);
        $product->jmlItem = $request->product->jmlItem;
        $product->harga = $request->product->harga;
        $product->stock = $request->product->stock;

        if ( $this->productsRepository->save($product) ){
            $response = new RegisterProductResponse();
            $response->product = $product;

            return $response;
        }
        return null;
    }

    private function validateProductRegisterRequest(RegisterProductRequest $request){

        if($request->product->description == null || trim($request->product->description) == "" ||
            $request->product->jmlItem == null || trim($request->product->jmlItem) == "" ||
            $request->product->harga == null || trim($request->product->harga) == "" ||
            $request->product->stock == null || trim($request->product->stock) == "" )
        {
            throw new ValidationException("Data tidak boleh ada yang kosong");
        }
    }

    public function updateProductById(UpdateProductRequest $request, User $user)
    {
        $this->validateUpdateProductRequest($request);

        try {

            Database::beginTransaction();

            $product = $this->productsRepository->getProductByProduserIdAndItem($request->product->idProduser,$request->product->jmlItem,$request->product->harga);

            if($product != null && $product->idProduct != $request->product->idProduct)
            {
                throw new ValidationException("Produk dengan data yang sama sudah ada");
            }

            $product = $request->product;

            $this->productsRepository->updateProduct($product);

            $this->historyRepository->save($product, $user, $request->old_price);
        }catch (PDOException $e){
            Database::rollback();
        } finally {
            Database::commit();
        }
    }

    private function validateUpdateProductRequest(UpdateProductRequest $request)
    {
        if($request->product->description == null || trim($request->product->description) == "" ||
            $request->product->jmlItem == null || trim($request->product->jmlItem) == "" ||
            $request->product->harga == null || trim($request->product->harga) == "" ||
            $request->product->stock == null || trim($request->product->stock) == "" )
        {
            throw new ValidationException("Data tidak boleh ada yang kosong");
        }
    }

    public function updateProduserById(UpdateProduserRequest $request) : UpdateProduserResponse
    {
        $this->validateUpdateProduserById($request);
//
//        $produser = $this->produserRepository->getProduserByName($request->produser->produserName);

//        if($produser != null )
//        {
//            foreach ($produser as $row) {
//                if($row['id'] != $request->produser->idProduser) {
//                    if(strtolower($row['nama_produser']) == strtolower($request->produser->produserName) &&
//                        strtolower($row['nama_voucher']) == strtolower($request->produser->voucherName))
//                        throw new ValidationException("Produser dengan data yang sama sudah ada");
//                }
//            }
//        }

        try {

            $produser = $request->produser;
            $this->produserRepository->updateProduserById($produser);

            $response = new UpdateProduserResponse();
            $response->produser = $produser;

            return $response;
        }catch (\PDOException $exception){
            throw new ValidationException("Produser dengan data yang sama sudah ada");
        }
    }

    private function validateUpdateProduserById(UpdateProduserRequest $request)
    {
        if ($request->produser->produserName == null || trim($request->produser->produserName) == "" ||
            $request->produser->voucherName == null || trim($request->produser->voucherName) == "") {
            throw new ValidationException("Data produser tidak boleh ada yang kosong");
        }
    }

    public function processTransactionById(UpdateTransactionRequest $request):UpdateTransactionResponse
    {
        try {
            Database::beginTransaction();
            $this->transactionsRepository->processTransactionById($request->transaction, $request->emailAdmin);
            $this->productsRepository->updateStockById($request->transaction);
            Database::commit();

            $response = new UpdateTransactionResponse();
            $response->transaction = new Transaction();
            $response->transaction->idTransaksi = $request->transaction->idTransaksi;
            return $response;
        }catch (ValidationException $exception){
            Database::rollback();
            throw $exception;
        }
    }

    public function getTransactionById(int $id): array
    {
        return $this->transactionsRepository->getTransactionId($id);
    }

    public function getProductEntity(int $id) : array
    {
        return $this->productsRepository->getProductById($id);
    }

    public function getProductBySearch(string $search):array
    {
        return $this->productsRepository->getProductBySearch($search);
    }

    public function getAllProduser():array
    {
        return $this->produserRepository->getAllProduser();
    }

    public function getProduserBySearch(string $key):array
    {
        return $this->produserRepository->getProduserBySearch($key);
    }

    public function getAllProduct():array
    {
        return $this->productsRepository->getAllProduct();
    }

    public function getAllTransaction():array
    {
        return $this->transactionsRepository->getAllTransaction();
    }

    public function getProduserById(int $idProduser):Produser
    {
        return $this->produserRepository->getProduserById($idProduser);
    }
}