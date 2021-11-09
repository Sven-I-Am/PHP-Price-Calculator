<?php

class Product
{
    private int $id;
    private string $name;
    private int $price;


    public function __construct(string $name, int $price, int $id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public static function getProduct(PDO $PDO, int $id): product
    {
        $handle = $PDO->prepare('SELECT * FROM product c WHERE c.id = :id');
        $handle->bindValue('id', $id);
        $handle->execute();
        $rawData = $handle->fetch();
        return new Product (
            $rawData['name'],
            (int)$rawData['price'],
            $id);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @return int
     */
    public function getPrice(): int
    {
        return number_format($this->price/100, 2);

    }
}