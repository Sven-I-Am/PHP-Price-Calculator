<?php
//PDO is a global class that we use to extend connection it stands for Php Data Object
class Connection extends PDO
{
    //from some of the basic commands that PDO allows we construct the Connection class.
    public function __construct(){
    //driveroptions is a variable array containing the options we want the connection to using in the parent::constuct.
        $driverOptions = [
            //do "SET NAMES utf-8" the way PDO class understands.
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            //error handling only exceptions
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // default fetch mode --> associative, this way we return an associative array, based on row values & column names.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
        //calls on PDO so that we can call on the database, also checks permissions.
        parent::__construct("mysql:host=".SERVER.";dbname=".DB, LOGIN, PASS, $driverOptions);
    }

}