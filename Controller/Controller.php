<?php
declare(strict_types = 1);

//Controller does:
// assign $customers/$products for select,
// also show selected customer and product if submitted.
// Calls Calculator after submission.

class Controller
{
    private Connection $db;

    //create a new connection based on the database value.
    public function __construct(){
        $this->db = new Connection();
    }

    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        // Paamayim Nekudotayim, aka "Scope resolution operator" allows access to static, constant, and overridden properties or methods of a class.
        // When referencing these items from outside the class definition, use the name of the class.  https://www.php.net/manual/en/language.oop5.paamayim-nekudotayim.php

        //Here we access the getAllcustomers from customerloader using the connection made through the newly created controller
        $customers =  CustomerLoader::getAllCustomers($this->db);
        $products =  ProductLoader::getAllProducts($this->db);
        $productsLow = ProductLoader::getAllProductsLow($this->db);
        $productsMed = ProductLoader::getAllProductsMed($this->db);
        $productsHigh = ProductLoader::getAllProductsHigh($this->db);

        if(!empty($_SESSION["customer"]) && !empty($_SESSION["product"])){
            $showCustomer = Customer::getCustomer($this->db, (int)$_SESSION["customer"]);
            $showProduct = Product::getProduct($this->db, (int)$_SESSION["product"]);
            $test = $showCustomer->getGroupId();
            $showGroup = CustomerGroup::getCustomerGroup($this->db, $test);
            $showGroup->setDiscounts();
            $quantity = $_SESSION['quantity'];
            $bulk = Calculator::getBulk($quantity);
            $bulkDiscount = Calculator::getBulkDiscount($bulk);
            $bulkPrice = Calculator::getBulkPrice($showProduct->getPrice(), $bulk);
            $quantitySubTotal = Calculator::getQuantitySubTotal($bulkPrice, $quantity);
            $subtotal = Calculator::getSubTotal($quantitySubTotal,$showCustomer->getFixedDiscount(),$showGroup->getFixedDiscount());
            $varDisc = Calculator::getVarDisc($showCustomer->getVarDiscount(), $showGroup->getVarDiscount());
            $finalPrice = Calculator::finalPrice($showCustomer, $showProduct, $showGroup, $quantity);
        }

        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require 'View/homepage.php';
    }

}
