<?php

class CustomerGroup
{
    private int $id;
    private string $groupname;
    private int $parentIdFix;
    private int $parentIdVar;
    private ?int $fixedDiscount;
    private ?int $varDiscount;
    private PDO $PDO;
    private CustomerGroup $parent;


    public function __construct(int $id, string $groupname, int $parentIdFix, int $parentIdVar, ?int $fixedDiscount, ?int $varDiscount, PDO $PDO)
    {
        $this->id = $id;
        $this->groupname = $groupname;
        $this->parentIdFix = $parentIdFix;
        $this->parentIdVar = $parentIdVar;
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
            (int)$rawData['parent_id'],
            (int)$rawData['fixed_discount'],
            (int)$rawData['variable_discount'],
            $PDO
        );
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
    public function getParentIdFix(): int
    {
        return $this->parentIdFix;
    }

    /**
     * @return int
     */
    public function getParentIdVar(): int
    {
        return $this->parentIdVar;
    }
    /**
     * @return int|null
     */
    public function getFixedDiscount(): ?int
    {
        $parentIdFix = $this->getParentIdFix();
        while($parentIdFix != 0){
            $parent = self::getCustomerGroup($this->PDO,$this->parentIdFix);
            $parentIdFix = $parent->getParentIdFix();
            $this->parentIdFix = $parentIdFix;
            $this->fixedDiscount += $parent->getFixedDiscount();
        }
        return $this->fixedDiscount;

    }

    /**
     * @return int|null
     */
    // for ($parentId, $parentId>=, i++)
    public function getVarDiscount(): ?int
    {
        $parentIdVar = $this->getParentIdVar();
        while($parentIdVar != 0){

            $parent = self::getCustomerGroup($this->PDO,$this->parentIdVar);
            $parentIdVar = $parent->getParentIdVar();
            $this->parentIdVar = $parentIdVar;
            echo $this->varDiscount;
            echo $parent->varDiscount;
            if ($this->varDiscount < $parent->varDiscount){
                $this->varDiscount = $parent->varDiscount;

            }
            echo $this->varDiscount;
            echo $parent->varDiscount;
        }
        return $this->varDiscount;

    }


}