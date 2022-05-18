<?php


namespace PHP\MVC\Repository;

use PDO;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\Product;
use PHP\MVC\Entity\Produser;

class ProduserRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function save(Produser $produser)
    {
        try {
            $statement = $this->connection->prepare("INSERT INTO produser(nama_produser, nama_voucher) VALUES (?,?)");
            return $statement->execute([$produser->produserName,$produser->voucherName]);
        }
        finally
        {
            $statement->closeCursor();
        }
    }

    public function getProduserByName(string $name) : array
    {
        try {
            $statement = $this->connection->prepare("SELECT id,nama_produser,nama_voucher FROM produser WHERE nama_produser = ?");
            $statement->execute([$name]);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        finally
        {
            $statement->closeCursor();
        }
    }
    
    public function getAllProduser():array 
    {
        try {
            $statement = $this->connection->prepare("SELECT id AS 'id_produser', nama_produser, nama_voucher FROM produser");

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        finally
        {
            $statement->closeCursor();
        }
    }

    public function getProduserBySearch(string $key):array
    {
        try {
            $statement = $this->connection->query("SELECT id AS 'id_produser', nama_produser, nama_voucher FROM produser WHERE nama_produser LIKE '%$key%'");

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        finally
        {
            $statement->closeCursor();
        }
    }

    public function getProduserById(int $id_produser):Produser
    {
        try {
            $statement = $this->connection->prepare("SELECT id 'id_produser', nama_produser, nama_voucher FROM produser WHERE id = ?");
            $statement->execute([$id_produser]);

            if($row = $statement->fetch()){
                $produser = new Produser();
                $produser->idProduser = $row['id_produser'];
                $produser->produserName = $row['nama_produser'];
                $produser->voucherName = $row['nama_voucher'];
                return $produser;
            }
            return null;
        }
        finally
        {
            $statement->closeCursor();
        }
    }

    public function updateProduserById(Produser $produser)
    {
        try {
            $statement = $this->connection->prepare("UPDATE produser SET nama_produser = ?, nama_voucher = ? WHERE id = ?");
            $statement->execute([$produser->produserName, $produser->voucherName, $produser->idProduser]);
        } finally {
            $statement->closeCursor();
        }
    }
    
    public function getVouchersName():array 
    {
        try {
            $statement = $this->connection->query("SELECT id, nama_voucher FROM produser");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } finally
        {
            $statement->closeCursor();
        }
    }

    public function getVoucherByName(string $name):array
    {
        try {
            $statement = $this->connection->query("SELECT id, nama_voucher FROM produser 
                                                WHERE nama_voucher LIKE '%$name%'");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } finally
        {
            $statement->closeCursor();
        }
    }
}