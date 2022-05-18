<?php


namespace PHP\MVC\Repository;

use PDO;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\Transaction;

class TransactionsRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function getAllTransaction():array
    {
        try {
            $sql = "SELECT transactions.id as 'id_transaksi', produser.nama_produser as 'produser', 
                       products.description as 'description',transactions.email as 'email',
                       transactions.total_harga as 'harga',
                       transactions.status_pemesanan as 'status', 
                       transactions.tanggal_pembelian as 'tgl_pembelian'
                FROM transactions
                JOIN users ON (transactions.email = users.email)
                JOIN products ON (transactions.id_products = products.id)
                JOIN produser ON (products.id_produser = produser.id)
                WHERE status_pemesanan = 0 
                ORDER BY tgl_pembelian DESC; ";
            $statement = $this->connection->prepare($sql);

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        finally
        {
            $statement->closeCursor();
        }
    }
    
    public function getTransactionId(int $id):array
    {
        try {
            $statement = $this->connection->prepare("SELECT t.id as 'id_transaksi',
                                    p.nama_produser AS 'produser',
                                    pr.description as 'description',
                                    u.email AS 'email',
                                    t.total_harga AS 'harga',
                                    u.no_hp AS 'no_hp', 
                                    p.nama_voucher AS 'nama_voucher',
                                    t.status_pemesanan as 'status',
                                    t.kode_voucher AS 'kode_voucher',
                                    t.tanggal_pembelian AS 'tgl_pembelian',
                                    t.email_admin AS 'email_admin'
                                    FROM transactions AS t
                                    JOIN users AS u ON (t.email = u.email)
                                    JOIN products AS pr ON (t.id_products = pr.id)
                                    JOIN produser AS p ON (pr.id_produser = p.id)       
                                    WHERE t.id = ?");
            $statement->execute([$id]);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        finally
        {
            $statement->closeCursor();
        }
    }

    public function updateTransactionById(Transaction $transaction,string $email_admin)
    {
        try {
            $statement = $this->connection->prepare(
                "UPDATE transactions SET status_pemesanan = ?, kode_voucher = ?, email_admin = ? WHERE id = ?");
            $statement->execute([$transaction->statusPemesanan,$transaction->kodeVoucher,$email_admin, $transaction->idTransaksi]);
        } finally {
            $statement->closeCursor();
        }
    }

    public function report():array
    {
       $statement = $this->connection->query("SELECT SUM(transactions.total_harga) as 'total', 
                                        DATE(transactions.tanggal_pembelian) 'date', COUNT(status_pemesanan) 'jumlah'
                                        FROM transactions
                                        WHERE transactions.status_pemesanan = 1
                                        GROUP BY MONTH(transactions.tanggal_pembelian), YEAR(transactions.tanggal_pembelian)");
       return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
