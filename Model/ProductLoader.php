<?php

class ProductLoader
{
    public static function getAllProducts(PDO $PDO): array
    {
        $handler = $PDO->query('SELECT * FROM product ORDER BY name');
        $allProducts= $handler->fetchAll(); //this is an array
        $products=[];
        foreach ($allProducts as $product){
            array_push($products, $product);
        }
        return $products;
    }

    public static function getAllProductsLow(PDO $PDO): array
    {
        $handler = $PDO->query('SELECT * FROM product WHERE price < 2500 ORDER BY name');
        $allProducts= $handler->fetchAll(); //this is an array
        $products=[];
        foreach ($allProducts as $product){
            array_push($products, $product);
        }
        return $products;
    }

    public static function getAllProductsMed(PDO $PDO): array
    {
        $handler = $PDO->query('SELECT * FROM product WHERE price BETWEEN 2500 AND 7500 ORDER BY name');
        $allProducts= $handler->fetchAll(); //this is an array
        $products=[];
        foreach ($allProducts as $product){
            array_push($products, $product);
        }
        return $products;
    }

    public static function getAllProductsHigh(PDO $PDO): array
    {
        $handler = $PDO->query('SELECT * FROM product WHERE price > 7500 ORDER BY name');
        $allProducts= $handler->fetchAll(); //this is an array
        $products=[];
        foreach ($allProducts as $product){
            array_push($products, $product);
        }
        return $products;
    }
}