<?php
declare(strict_types = 1);


class Controller
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
//        $models= ["Customer", "Connection", "CustomerGroup", "Product", "ProductLoader", "CustomerLoader"];
        //this is just example code, you can remove the line below
        $customer = new Customer('new customer', "", 0, 0, 0);
        $connection = new Connection('new connection');
        $customerGroup = new CustomerGroup('new customer group');
        $product = new Product(0, "", 0);
        $productLoader = new ProductLoader();
        $customerLoader = new CustomerLoader();

        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require 'View/homepage.php';
    }

}
