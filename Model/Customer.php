<?php
declare(strict_types=1);

class Customer
{
    private string $customer;

    public function __construct(string $customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer() : string
    {
        return $this->customer;
    }
}