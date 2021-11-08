<?php

class Customer_Group
{
    private $customer_group;

    public function __construct(string $customer_group)
    {
        $this->customer_group = $customer_group;
    }

    public function getCustomerGroup() : string
    {
        return $this->customer_group;
    }
}