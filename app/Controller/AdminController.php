<?php

namespace PHP\MVC\Controller;

use PHP\MVC\App\View;
use PHP\MVC\Entity\Product;
use PHP\MVC\Entity\Produser;
use PHP\MVC\Entity\Transaction;
use PHP\MVC\Exception\ValidationException;
use PHP\MVC\Model\UpdateProduserRequest;
use PHP\MVC\Model\RegisterProductRequest;
use PHP\MVC\Model\registerProduserRequest;
use PHP\MVC\Model\UpdateProductRequest;
use PHP\MVC\Model\UpdateTransactionRequest;
use PHP\MVC\Repository\ProduserRepository;
use PHP\MVC\Service\AdminService;
use PHP\MVC\Service\SessionService;

class AdminController
{
    private AdminService $adminService;
    private SessionService $sessionService;

    public function __construct()
    {
        $produserRepository = new ProduserRepository();
        $this->adminService = new AdminService($produserRepository);
        $this->sessionService = new SessionService();
    }

    public function dashboard()
    {
        $user = null;
        if(isset($_COOKIE[SessionService::$COOKIE_NAME])) {
            $user = $this->sessionService->current();
        }

        if(isset($_GET['s_tr_id']) && trim($_GET['s_tr_id']) != "") {
            $transaction_id = $this->adminService->getTransactionById($_GET['s_tr_id']);
        }else{
            $transaction_id = $this->adminService->getAllTransaction();
        }

        if(isset($_GET['s_product']) && trim($_GET['s_product']) != "") {
            $product = $this->adminService->getProductBySearch($_GET['s_product']);
        }else{
            $product = $this->adminService->getAllProduct();
        }

        if(isset($_GET['s_produser']) && trim($_GET['s_produser']) != "") {
            $produser = $this->adminService->getProduserBySearch($_GET['s_produser']);
        }else{
            $produser = $this->adminService->getAllProduser();
        }

        View::show("Admin/dashboard",[
            'title' => 'login admin',
            'data_transaksi' => $transaction_id,
            'data_products' => $product,
            'data_produser' => $produser,
            'user' => $user
        ]);
    }

    public function editProduct(int $value)
    {
        $product = $this->adminService->getProductEntity($value);

        View::show("Admin/edit-product", [
            'title' => 'Edit Product',
            'product' => $product,
            'id' => $value
        ]);
    }

    public function postEditProduct($value)
    {
        $user = $this->sessionService->current();

        $request = new UpdateProductRequest();
        $request->product = new Product();
        $request->product->idProduct = $value;
        $request->product->idProduser = $_POST['idProduser'];
        $request->product->description = $_POST['description'];
        $request->product->harga = $_POST['harga'];
        $request->product->jmlItem = $_POST['jml_item'];
        $request->product->stock = $_POST['stock'];
        $request->old_price = $this->adminService->getProductEntity($value)[0]['harga'];

        try {
            $this->adminService->updateProductById($request, $user);
            View::show("Admin/edit-product", [
                'title' => 'Edit Product',
                'product' => $this->adminService->getProductEntity($value),
                'id' => $value,
                'status' => 'success',
                'message' => 'Update product sukses'
            ]);
        }catch (ValidationException $exception){
            View::show("Admin/edit-product", [
                'title' => 'Edit Product',
                'product' => $this->adminService->getProductEntity($value),
                'id' => $value,
                'status' => 'failed',
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function addProduser()
    {
        View::show("Admin/add-produser", [
            'title' => 'Tambah produser'
        ]);
    }

    public function postAddProduser()
    {
        session_start();
        $request = new registerProduserRequest();
        $request->namaProduser = $_POST['produserName'];
        $request->namaVoucher = $_POST['voucherName'];

        try {
            $this->adminService->registerProduser($request);
            $_SESSION['status'] = true;
            View::redirect("/admin");
        }catch (ValidationException $exception){
            View::show("Admin/add-produser", [
                'title' => 'Tambah produser',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function addProduct()
    {
        View::show("Admin/add-product", [
            'title' => 'Tambah produk',
            'produsers' => $this->adminService->getAllProduser()
        ]);
    }

    public function postAddProduct()
    {
        $request = new RegisterProductRequest();
        $request->product = new Product();

        $request->product->idProduser = intval($_POST['produser']);
        $request->product->description = $_POST['description'];
        $request->product->jmlItem = $_POST['jml_item'];
        $request->product->harga = $_POST['harga'];
        $request->product->stock = $_POST['stock'];

        try {

            $this->adminService->registerProduct($request);
            View::show("Admin/add-product", [
                'title' => 'Berhasil Tambah produk',
                'produsers' => $this->adminService->getAllProduser(),
                'success' => 'Berhasil tambah produk'
            ]);

        }catch (ValidationException $exception){
            View::show("Admin/add-product", [
                'title' => 'Tambah produk',
                'produsers' => $this->adminService->getAllProduser(),
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function editTransaction(int $id_transaction)
    {
        $data = $this->adminService->getTransactionById($id_transaction)[0];

        View::show("Admin/edit-transaction", [
            'title' => 'Edit Product',
            'id_transaction' => $id_transaction,
            'data' => $data
        ]);
    }

    public function postEditTransaction(int $id_transaction)
    {
        $request = new UpdateTransactionRequest();
        $request->transaction = new Transaction();
        $request->transaction->idTransaksi = $id_transaction;
        $request->transaction->statusPemesanan = $_POST['status'];
        $request->emailAdmin = $this->sessionService->current()->email;
        $request->transaction->idProduct = $_POST['id_prod'];
        if($_POST['status'] != -1) $request->transaction->kodeVoucher = uniqid("{$id_transaction}");
        else $request->transaction->kodeVoucher = null;

        try {
            $response = $this->adminService->processTransactionById($request);
            View::show("Admin/edit-transaction", [
                'title' => 'Edit Product',
                'id_transaction' => $id_transaction,
                'status' => 'success',
                'message' => 'Update berhasil dilakukan',
                'data' => $this->adminService->getTransactionById($response->transaction->idTransaksi)[0]
            ]);
        }catch (ValidationException $exception){
            View::show("Admin/edit-transaction", [
                'title' => 'Edit Product',
                'id_transaction' => $id_transaction,
                'status' => 'failed',
                'message' => 'Update gagal dilakukan',
                'data' => $this->adminService->getTransactionById($id_transaction)[0]
            ]);
        }
    }

    public function editProduser(int $id_produser)
    {
        $produser = $this->adminService->getProduserById($id_produser);
        View::show('Admin/edit-produser', [
            'title' => 'Edit Produser',
            'produser_id' => $produser->idProduser,
            'produser_name' => $produser->produserName,
            'voucher_name' => $produser->voucherName
        ]);
    }

    public function postEditProduser(int $id_produser)
    {
        $request = new UpdateProduserRequest();
        $request->produser = new Produser();
        $request->produser->idProduser = $id_produser;
        $request->produser->produserName = $_POST['namaProduser'];
        $request->produser->voucherName = $_POST['namaVoucher'];

        try {
            $this->adminService->updateProduserById($request);

            $produser = $this->adminService->getProduserById($id_produser);
            View::show('Admin/edit-produser', [
                'title' => 'Edit Produser',
                'produser_id' => $produser->idProduser,
                'produser_name' => $produser->produserName,
                'voucher_name' => $produser->voucherName,
                'status' => 'success',
                'message' => 'Update berhasil'
            ]);
        }catch (ValidationException $exception){
            $produser = $this->adminService->getProduserById($id_produser);
            View::show('Admin/edit-produser', [
                'title' => 'Edit Produser',
                'produser_id' => $produser->idProduser,
                'produser_name' => $produser->produserName,
                'voucher_name' => $produser->voucherName,
                'status' => 'failed',
                'message' => $exception->getMessage()
            ]);
        }
    }
}