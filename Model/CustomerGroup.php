<?php

class CustomerGroup
{
    private int $id;
    private string $groupname;
    private int $parentId;
    private ?int $fixedDiscount;
    private ?int $varDiscount;
    private PDO $PDO;
    private CustomerGroup $parent;


    public function __construct(int $id, string $groupname, int $parentId, ?int $fixedDiscount, ?int $varDiscount, PDO $PDO)
    {
        $this->id = $id;
        $this->groupname = $groupname;
        $this->parentId = $parentId;
        $this->fixedDiscount = $fixedDiscount;
        $this->varDiscount = $varDiscount;
        $this->PDO = $PDO;
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
            (int)$rawData['variable_discount'],
            $PDO
        );
    }

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
    public function setDiscounts()
    {
        $parentId = $this->getParentId();
        while($parentId != 0){
            $parent = self::getCustomerGroup($this->PDO,$this->parentId);
            $parentId = $parent->getParentId();
            $this->parentId = $parentId;
            $this->fixedDiscount += $parent->getFixedDiscount();
            if ($this->varDiscount < $parent->varDiscount){
                $this->varDiscount = $parent->varDiscount;
            }
        }
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