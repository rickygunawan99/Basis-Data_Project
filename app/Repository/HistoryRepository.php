<?php


namespace PHP\MVC\Repository;


use PDO;
use PDOException;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\Product;
use PHP\MVC\Entity\User;

class HistoryRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection= Database::getConnection();
    }

    public function detailUpdate(int $year, int $month, int $day):array
    {
        $statement = $this->connection->prepare("SELECT products.description 'desc', history.harga_lama 'hrg_lama',
                                                   history.harga_baru 'hrg_baru',tgl_update 'tgl', users.email 'email_admin'
                                            FROM history
                                            JOIN products ON (products.id = history.id_product)
                                            JOIN users ON (users.email = history.email_admin)
                                            WHERE YEAR(tgl_update) = ?
                                            AND MONTH(tgl_update) = ?
                                            AND DAY(tgl_update) = ?");
        $statement->execute([$year,$month,$day]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(Product $product, User $user, int $old_price):void
    {
        try {
            $statement = $this->connection->prepare("INSERT INTO history(id_product, email_admin, harga_lama, harga_baru)
                                    VALUES (?,?,?,?)");
            $statement->execute([$product->idProduct, $user->email, $old_price, $product->harga]);
        }catch (PDOException $e){

        }
    }
}