<?php

class Calculator
{

    public static function finalPrice (Customer $cust, Product $prod /*we need to add the group discount*/){
        $prodPrice = $prod->getPrice();
        $fixedTotal = 0;
        $varDisc = 0;
        $fixCust = $cust->getFixedDiscount();
        $varCust = $cust->getVarDiscount();
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