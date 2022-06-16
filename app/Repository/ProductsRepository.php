<?php

namespace PHP\MVC\Repository;

use PDO;
use PDOException;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\Product;
use PHP\MVC\Entity\Transaction;

class ProductsRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function getAllProduct():array
    {
        try {
            $sql = "SELECT products.id as 'id_product', products.description as 'description', products.jml_item as 'jml_item',
                produser.nama_produser 'nama_produser', produser.nama_voucher 'nama_voucher',
                products.harga as 'harga', products.stock as 'stock'
                       FROM products
                JOIN produser ON (products.id_produser = produser.id); ";
            $statement = $this->connection->prepare($sql);

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } finally {
            $statement->closeCursor();
        }
    }

    public function getProductByProduserIdAndItem(int $id, int $jml_item, int $harga) : ?Product
    {
        try {
            $statement = $this->connection->prepare("SELECT id, id_produser, jml_item, harga FROM products WHERE id_produser = ? AND jml_item = ? AND  harga = ?");
            $statement->execute([$id,$jml_item,$harga]);

            if($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $product = new Product();
                $product->idProduct = $row['id'];
                $product->idProduser = $row['id_produser'];
                $product->jmlItem = $row['jml_item'];
                $product->harga = $row['harga'];
                return $product;
            }
            return null;
        } finally {
            $statement->closeCursor();
        }
    }

    public function save(Product $product) : bool
    {
        try {
            $statement = $this->connection->prepare("INSERT INTO products(id_produser, description, jml_item, harga, stock) VALUES (?,?,?,?,?)");
            return $statement->execute([$product->idProduser, $product->description, $product->jmlItem, $product->harga, $product->stock]);
        } finally {
            $statement->closeCursor();
        }
    }
    
    public function getProductById(int $id) : array
    {
        try {
            $statement = $this->connection->prepare("SELECT products.id as 'id_product', 
                                    products.description as 'description', 
                                    produser.nama_produser 'nama_produser', produser.id as 'id_produser',
                                    produser.nama_voucher 'nama_voucher', products.jml_item as 'jml_item', 
                                    products.harga as 'harga', products.stock as 'stock' FROM products
                                    JOIN produser ON (products.id_produser = produser.id) 
                                    WHERE products.id = ?");

            $statement->execute([$id]);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } finally {
            $statement->closeCursor();
        }
    }

    public function updateProduct(Product $product)
    {
        try {
            $statement = $this->connection->prepare("UPDATE products SET description = ?, jml_item = ?, harga = ?, stock = ? WHERE id = ? ");

            $statement->execute([$product->description, $product->jmlItem, $product->harga, $product->stock, $product->idProduct]);
        } catch (PDOException $e) {

        }
    }

    public function getProductBySearch(string $search)
    {
        $statement = $this->connection->query("SELECT products.id as 'id_product', products.description as 'description', 
                                produser.nama_produser 'nama_produser', produser.id as 'id_produser',
                                produser.nama_voucher 'nama_voucher', products.jml_item as 'jml_item', 
                                products.harga as 'harga', products.stock as 'stock' FROM products
                                JOIN produser ON (products.id_produser = produser.id) 
                                WHERE products.description LIKE '%$search%' 
                                OR nama_voucher LIKE '%$search%' 
                                OR nama_produser LIKE '$search%'");


        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getByProduserId(int $id){
        try {
            $statement = $this->connection->prepare("SELECT products.id as 'id_product', products.description as 'description', 
                                    products.jml_item AS 'jml_item',  products.harga AS 'harga', products.stock AS 'stock'
                                    FROM products 
                                    WHERE products.id_produser = ?");
            $statement->execute([$id]);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } finally
        {
            $statement->closeCursor();
        }
    }

    public function updateStockById(Transaction $transaction)
    {
        $statement = $this->connection->prepare("UPDATE products SET
                                    stock = stock - 1
                                    WHERE id = ?");

        $statement->execute([$transaction->idProduct]);
    }
}