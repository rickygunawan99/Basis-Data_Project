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
                                    t.email_admin AS 'email_admin',
                                    t.id_products AS 'id_prod'
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

    public function processTransactionById(Transaction $transaction,string $email_admin)
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

    public function save(Transaction $transaction):int
    {
        $statement = $this->connection->prepare("INSERT INTO transactions(email, total_harga, id_products)
                                                VALUES (?,?,?)");
        $statement->execute([$transaction->email, $transaction->totalHarga, $transaction->idProduct]);

        return $this->connection->lastInsertId();
    }
    
    public function countMonthlyTotalConfirm():int
    {
        $statement = $this->connection->query("SELECT COUNT(*) as 'total'
                            FROM transactions
                            WHERE status_pemesanan = 1
                            AND YEAR(tanggal_pembelian) = YEAR(now())
                            AND MONTH(tanggal_pembelian) = MONTH(now())");
        $statement->execute();
        if($row = $statement->fetch()){
            return $row['total'];
        }
        return -1;
    }

    public function countMonthlyTotalCancel():int
    {
        $statement = $this->connection->query("SELECT COUNT(*) as 'total'
                            FROM transactions
                            WHERE status_pemesanan = -1
                            AND YEAR(tanggal_pembelian) = YEAR(now())
                            AND MONTH(tanggal_pembelian) = MONTH(now())");
        $statement->execute();
        if($row = $statement->fetch()){
            return $row['total'];
        }
        return 0;
    }

    public function countMonthlyTotalWaiting(): int
    {
        $statement = $this->connection->query("SELECT COUNT(*) as 'total'
                            FROM transactions
                            WHERE status_pemesanan = 0
                            AND YEAR(tanggal_pembelian) = YEAR(now())
                            AND MONTH(tanggal_pembelian) = MONTH(now())");
        $statement->execute();
        if($row = $statement->fetch()){
            return $row['total'];
        }
        return 0;
    }

    public function detail(int $month, int $year): ?array
    {
        $statement = $this->connection->prepare("SELECT COUNT(*) 'terjual', produser.nama_produser 'produser',
                                            produser.nama_voucher 'voucher', id_products, products.jml_item 'nominal',
                                            transactions.total_harga 'harga', transactions.id_products 'id_prod', SUM(total_harga) 'total_bayar'
                                    FROM transactions
                                    JOIN products on (transactions.id_products = products.id)
                                    JOIN produser on (products.id_produser = produser.id)
                                    WHERE status_pemesanan = 1 AND MONTH(tanggal_pembelian) = ? AND YEAR(tanggal_pembelian) = ?
                                    GROUP BY id_products
                                    ORDER BY terjual DESC");
        $statement->execute([$month,$year]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

//    public function totalSalaryMonth(int $month, int $year): int
//    {
//        $statement = $this->connection->prepare("SELECT SUM(transactions.total_harga) 'total'
//                        FROM transactions
//                        WHERE MONTH(tanggal_pembelian) = ? AND YEAR(tanggal_pembelian) = ? AND status_pemesanan = 1"
//                        );
//        $statement->execute([$month,$year]);
//        if($row = $statement->fetch(PDO::FETCH_ASSOC)){
//            return $row['total'] ?? 0;
//        }
//        return 0;
//    }
}
