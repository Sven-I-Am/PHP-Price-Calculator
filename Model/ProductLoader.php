<?php

class ProductLoader
{
    public static function getAllProducts(PDO $PDO): array
    {
        $handler = $PDO->query('SELECT * FROM product');
        $allProducts= $handler->fetchAll(); //this is an array
        $products=[];
        foreach ($allProducts as $product){
            array_push($products, $product);
        }
        return $products;
    }
}