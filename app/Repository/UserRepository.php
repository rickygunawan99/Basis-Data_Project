<?php

namespace PHP\MVC\Repository;

require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
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

            $statement = $this->connection->prepare("INSERT INTO users(email, password, username, role) 
                                                    VALUES (?,?,?,?)");
            return $statement->execute([$user->email,$user->password,$user->username,$role]);
        } finally {
            $statement->closeCursor();
        }
    }

    public function getByEmail(string $email) : ?User
    {
        try {
            $statement = $this->connection->prepare(
                "SELECT users.email 'email', users.password 'password',
                          users.username 'username' ,role.nama 'role' FROM users 
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
}
