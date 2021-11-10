<?php

// Calculator does: the math for discounts based on selected customer and product.
// currently it stages the totaldiscount and variable discount as integers value 0,
// all logic for all discounts working


class Calculator
{
    // public static function allows us to call it without having instantiated the calculator itself
    public static function finalPrice (Customer $showCustomer, Product $showProduct, CustomerGroup $showGroup){
        $prodPrice = $showProduct->getPrice();
        $fixedTotal = 0;
        $varDisc = 0;
        
        //from Customer class
        $fixCust = $showCustomer->getFixedDiscount();
        $varCust = $showCustomer->getVarDiscount();

        //from CustomerGroup class
        $fixGroup = $showGroup->getFixedDiscount();
        $varGroup = $showGroup->getVarDiscount();

        // addition fixed discount customer and fixed discount group (previously added in class function).
        $fixedTotal += $fixCust +  $fixGroup;
        echo $varCust.'<br>';
        echo $varGroup.'<br>';

        // which is bigger variable discount customer or group? also conversion to  we can multiply with%
        if ($varCust > $varGroup){
            $varDisc = $varCust/100;
        }
        else {
            $varDisc = $varGroup/100;
        }
        //total before the variable discount is taken into account is called $preVar
        $preVar = $prodPrice - $fixedTotal;
        // total never below 0 here
        if ($preVar < 0) {
            $preVar = 0;
                }
        return $preVar* (1-$varDisc);
    }
}