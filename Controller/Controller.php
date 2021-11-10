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
        // 
        $customers =  CustomerLoader::getAllcustomers($this->db);
        $products =  ProductLoader::getAllProducts($this->db);
        if(!empty($_SESSION["customer"]) && !empty($_SESSION["product"])){
            $showCustomer = Customer::getCustomer($this->db, (int)$_SESSION["customer"]);
            $showProduct = Product::getProduct($this->db, (int)$_SESSION["product"]);
            $test = $showCustomer->getGroupId();
            $showGroup = CustomerGroup::getCustomerGroup($this->db, $test);
            $finalPrice = Calculator::finalPrice($showCustomer, $showProduct, $showGroup);
        }

        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require 'View/homepage.php';
    }

}
