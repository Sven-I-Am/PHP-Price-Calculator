<?php
declare(strict_types = 1);

class Controller
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        //this is just example code, you can remove the line below
        $customer = new Customer('new customer');
        $connection = new Connection('new connection');
        $customerGroup = new CustomerGroup('new customer group');
        $product = new Product('new product');

        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require 'View/homepage.php';
    }
}