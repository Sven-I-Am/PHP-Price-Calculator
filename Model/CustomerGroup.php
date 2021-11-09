<?php

class CustomerGroup
{
    private $customerGroup;

    public function __construct(string $customerGroup)
    {
        $this->customerGroup = $customerGroup;
    }

    public function getCustomerGroup() : string
    {
        return $this->customerGroup;
    }
}