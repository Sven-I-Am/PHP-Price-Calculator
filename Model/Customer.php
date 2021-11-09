<?php
declare(strict_types=1);

class Customer
{
    private string $firstName;
    private string $lastName;
    private int $groupId;
    private int $fixedDiscount;
    private int $varDiscount;

    public function __construct(string $firstName, string $lastName,int $groupId, int $fixedDiscount,int $varDiscount)

    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->groupId = $groupId;
        $this->fixedDiscount = $fixedDiscount;
        $this->varDiscount = $varDiscount;
    }
    /**
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }
    /**
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }
    /**
     * @return string
     */
    public function getFullName() : string
    {
        return $this->firstName." ".$this->lastName;
    }
    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }
    /**
     * @return int
     */
    public function getFixedDiscount(): int
    {
        return $this->fixedDiscount;
    }
    /**
     * @return int
     */
    public function getVarDiscount(): int
    {
        return $this->varDiscount;
    }
    public function loadCustomer(PDO $PDO, int $groupId): array {

    }

}