<?php


namespace PHP\MVC\Model;


use PHP\MVC\Entity\Product;

class UpdateProductRequest
{
    public Product $product;
    public int $old_price;
}