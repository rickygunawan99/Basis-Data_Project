<?php


namespace PHP\MVC\Model;


class UserCheckoutRequest
{
    public string $email;
    public int $idProduct;
    public int $productPrice;
}