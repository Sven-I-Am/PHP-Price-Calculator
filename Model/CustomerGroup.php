<?php

class CustomerGroup
{
    private string $id;
    private string $groupname;
    private int $parentId;
    private ?int $fixedDiscount;
    private ?int $varDiscount;


    public function __construct(string $id, string $groupname, int $parentId, ?int $fixedDiscount, ?int $varDiscount)
    {
        $this->id = $id;
        $this->groupname = $groupname;
        $this->parentId = $parentId;
        $this->fixedDiscount = $fixedDiscount;
        $this->varDiscount = $varDiscount;
    }

    public static function getCustomerGroup(PDO $PDO, int $id): CustomerGroup
    {
        $handle = $PDO->prepare('SELECT * FROM customer_group c WHERE c.id = :id');
        $handle->bindValue('id', $id);
        $handle->execute();
        $rawData = $handle->fetch();
        return new CustomerGroup (
            (int)$rawData['id'],
            $rawData['name'],
            (int)$rawData['parent_id'],
            (int)$rawData['fixed_discount'],
            (int)$rawData['variable_discount']);
    }

    /**
     * @return string
     */
    /**
     * @return string
     */
    public function getid(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getGroupname(): string
    {
        return $this->groupname;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @return int|null
     */
    public function getFixedDiscount(): ?int
    {
        return $this->fixedDiscount;
    }

    /**
     * @return int|null
     */
    public function getVarDiscount(): ?int
    {
        return $this->varDiscount;
    }


}