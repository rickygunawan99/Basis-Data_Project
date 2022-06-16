<?php

namespace PHP\MVC\Repository;

require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use PDOException;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\User;

class UserRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function save(User $user) : bool
    {
        try {
            $role = $user->role == "admin" ? 2 : 3;

            $statement = $this->connection->prepare("INSERT INTO users(email, password, username, no_hp, role) 
                                                    VALUES (?,?,?,?,?)");
            return $statement->execute([$user->email,$user->password,$user->username,$user->nohp,$role]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getByEmail(string $email) : ?User
    {
        try {
            $statement = $this->connection->prepare(
                "SELECT users.email 'email', users.password 'password',
                          users.username 'username' ,role.nama 'role', users.no_hp 'no_hp'
                          FROM users 
                          JOIN role ON (users.role = role.id)
                          WHERE email = ?");
            $statement->execute([$email]);

            if($row = $statement->fetch()){
                $user = new User();
                $user->email = $row['email'];
                $user->username = $row['username'];
                $user->password = $row['password'];
                $user->role = $row['role'];
                return $user;
            }
            return null;
        }
        finally {
            $statement->closeCursor();
        }
    }
    
    public function editProfile(string $field, User $user, string $newValue){
        $statement = $this->connection->prepare("UPDATE users SET " . $field . " = ? WHERE email = ?");
        $statement->execute([$newValue, $user->email]);
    }

    public function countTotalAdmin():int
    {
        $statement = $this->connection->query("SELECT COUNT(*) as 'total'
                            FROM users
                            WHERE role = 2");
        $statement->execute();
        if($row = $statement->fetch()){
            return $row['total'];
        }
        return -1;
    }
}
