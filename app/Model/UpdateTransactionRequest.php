<?php


namespace PHP\MVC\Model;


use PHP\MVC\Entity\Transaction;
use PHP\MVC\Entity\User;

class UpdateTransactionRequest
{
    public Transaction $transaction;
    public string $emailAdmin;
}