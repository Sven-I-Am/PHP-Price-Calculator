<?php

class Product
{
    private $product;

    public function __construct(string $product)
    {
        $this->product = $product;
    }

    public function getProduct() : string
    {
        return $this->product;
    }
}