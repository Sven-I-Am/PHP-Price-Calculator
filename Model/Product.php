<?php

class Product
{
    private int $id;
    private string $name;
    private int $price;


    public function __construct(int $id, string $name, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
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