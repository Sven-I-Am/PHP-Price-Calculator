<?php

// Calculator does: the math for discounts based on selected customer and prodcuct.
// currently it stages the totaldiscount and variable discount as integers value 0,
// all logic for basic discounts working
//todo: add the logic for adding the fixed discounts from customer_group and selecting the highest variable discount.

class Calculator
{
    public static function finalPrice (Customer $showCustomer, Product $showProduct, CustomerGroup $showGroup){
        $prodPrice = $showProduct->getPrice();
        $fixedTotal = 0;
        $varDisc = 0;
        $fixCust = $showCustomer->getFixedDiscount();
        $varCust = $showCustomer->getVarDiscount();
        $fixGroup = $showGroup->getFixedDiscount();
        $varGroup = $showGroup->getVarDiscount();
        $fixedTotal += $fixCust +  $fixGroup;

        //$fixedtotal klopt volledig.
        echo $varCust.'<br>';
        echo $varGroup.'<br>';
        if ($varCust > $varGroup){
            $varDisc = $varCust/100;
        }
        else {
            $varDisc = $varGroup/100;
        }
        $preVar = $prodPrice - $fixedTotal;
        if ($preVar < 0) {
            $preVar = 0;
                }
        return $preVar - ($preVar*$varDisc);
    }
}