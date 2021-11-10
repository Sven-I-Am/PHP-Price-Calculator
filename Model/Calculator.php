<?php

// Calculator does: the math for discounts based on selected customer and product.
// currently it stages the totaldiscount and variable discount as integers value 0,
// all logic for all discounts working


class Calculator
{
    // public static function allows us to call it without having instantiated the calculator itself
    public static function finalPrice (Customer $showCustomer, Product $showProduct, CustomerGroup $showGroup){
        $prodPrice = $showProduct->getPrice();

        //from Customer class
        $fixCust = $showCustomer->getFixedDiscount();
        $varCust = $showCustomer->getVarDiscount();

        //from CustomerGroup class
        $fixGroup = $showGroup->getFixedDiscount();
        $varGroup = $showGroup->getVarDiscount();

        $subtotal = self::getSubTotal($prodPrice, $fixCust, $fixGroup);

        $varDisc = self::getVarDisc($varCust, $varGroup);
        $endVar = self::getVar($subtotal, $varDisc);
        return $subtotal - $endVar;
    }

    public static function  getSubTotal($a,$b,$c): float
    {
        $subtotal = $a - $b - $c;
        if ($subtotal < 0) {
            $subtotal = 0;
        }
        return $subtotal;
    }
        public static function getVar($subtotal, $varDisc): float
    {
        return $subtotal * $varDisc;
    }
    // which is bigger variable discount customer or group? also conversion to  we can multiply with%
    public static function  getVarDisc($varCust, $varGroup): float
    {
        if ($varCust > $varGroup){
            $varDisc = $varCust/100;
        }
        else {
            $varDisc = $varGroup/100;
        }
        return $varDisc;
    }
}