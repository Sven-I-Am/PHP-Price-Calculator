<?php
declare(strict_types = 1);


class Controller
{
    private Connection $db;
    //render function with both $_GET and $_POST vars available if it would be needed.

    public function __construct(){
        $this->db = new Connection();
    }
    public function render(array $GET, array $POST)
    {
//        $models= ["Customer", "Connection", "CustomerGroup", "Product", "ProductLoader", "CustomerLoader"];
        //this is just example code, you can remove the line below
        $customers =  CustomerLoader::getAllcustomers($this->db);
        $products =  ProductLoader::getAllProducts($this->db);
        if(!empty($_SESSION["customer"]) && !empty($_SESSION["product"])){
            $showCustomer = Customer::getCustomer($this->db, (int)$_SESSION["customer"]);
            $showProduct = Product::getProduct($this->db, (int)$_SESSION["product"]);
            var_dump($customer);
            var_dump($product);
        }



        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require 'View/homepage.php';
    }

}
