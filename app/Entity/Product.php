<?php


namespace PHP\MVC\Entity;


class Product
{
    public ?int $idProduct;
    public ?int $idProduser;
    public string $description;
    public int $jmlItem;
    public int $harga;
    public int $stock;
}