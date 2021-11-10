<?php

// Calculator does: the math for discounts based on selected customer and prodcuct.
// currently it stages the totaldiscount and variable discount as integers value 0,
// when we get the
//todo: add the logic for adding the fixed discounts from group_id and selecting the highest variable discount.

class Calculator
{
    public static function finalPrice (Customer $showCustomer, Product $showProduct /*we need to add the group discount*/){
        $prodPrice = $showProduct->getPrice();
        $fixedTotal = 0;
        $varDisc = 0;
        $fixCust = $showCustomer->getFixedDiscount();
        $varCust = $showCustomer->getVarDiscount();
        if ($fixCust != NULL){
            $fixedTotal += $fixCust;
        }
        if ($varCust != NULL){
            $varDisc = $varCust/100;
        }
        $preVar = $prodPrice - $fixedTotal;
        return $preVar - ($preVar*$varDisc);
    }
}