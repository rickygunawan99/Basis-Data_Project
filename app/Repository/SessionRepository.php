<?php

namespace PHP\MVC\Repository;

use PDO;
use PHP\MVC\Config\Database;
use PHP\MVC\Entity\Session;
use PHP\MVC\Entity\User;

use PHP\MVC\Config;

class SessionRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function save(Session $session)
    {
        $statement = $this->connection->prepare("INSERT INTO session(email,id) VALUES (?,?)");
        $statement->execute([$session->email,$session->id]);
    }
    
    public function current(string $id): ?User
    {
        $statement = $this->connection->prepare("SELECT u.email 'email', u.password 'password',
                                    u.username 'username', u.no_hp 'no_hp', role.name 'role'
                                    FROM session 
                                    JOIN users AS 'u' ON(session.email = users.email)
                                    JOIN role ON (users.role = role.name)
                                    WHERE session.id = ?");
        $statement->execute([$id]);

        if($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $user = new User();
            $user->email = $row['email'];
            $user->role = $row['role'];
            $user->password = $row['password'];
            $user->username = $row['username'];
            return $user;
        }
        return null;
    }

    public function destroy(string $id)
    {
        $statement = $this->connection->prepare("DELETE FROM session WHERE id = ?");
        $statement->execute([$id]);
    }
    
    public function findById(?string $id): ?Session
    {
        $statement = $this->connection->prepare("SELECT id, email
                                    FROM session WHERE id = ?");
        $statement->execute([$id]);

        if($row = $statement->fetch()){
            $session = new Session();
            $session->id = $row['id'];
            $session->email = $row['email'];
            return $session;
        }

        return null;
    }
}