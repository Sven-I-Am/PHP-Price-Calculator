<?php
declare(strict_types=1);

class Customer
{
    private string $firstName;
    private string $lastName;
    private int $groupId;
    private ?int $fixedDiscount;
    private ?int $varDiscount;
    private int $id;


    public function __construct(string $firstName, string $lastName, int $groupId, ?int $fixedDiscount, ?int $varDiscount, int $id)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->groupId = $groupId;
        $this->fixedDiscount = $fixedDiscount;
        $this->varDiscount = $varDiscount;
        $this->id = $id;
    }

    public static function getCustomer(PDO $PDO, int $id): customer
    {
        $handle = $PDO->prepare('SELECT * FROM customer c WHERE c.id = :id');
        $handle->bindValue('id', $id);
        $handle->execute();
        $rawData = $handle->fetch();
        return new Customer (
            $rawData['firstname'],
            $rawData['lastname'],
            (int)$rawData['group_id'],
            (int)$rawData['fixed_discount'],
            (int)$rawData['variable_discount'],
            $id);
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

}