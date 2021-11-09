<?php
//
class CustomerLoader
{
    public static function getAllCustomers(PDO $PDO): array
    {
        $handler = $PDO->query('SELECT * FROM customer');
        $allCustomers= $handler->fetchAll(); //this is an array
        $customers=[];
        foreach ($allCustomers as $customer){
            array_push($customers, $customer);
        }
        return $customers;
    }
}