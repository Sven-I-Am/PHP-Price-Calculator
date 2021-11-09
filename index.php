<?php
declare(strict_types=1);

//include all your model files here
require 'Model/Connection.php';
require 'Model/Customer.php';
require 'Model/CustomerLoader.php';
require 'Model/CustomerGroup.php';
require 'Model/Product.php';
require 'Model/ProductLoader.php';
require ".env";


//include all your controllers here
require 'Controller/Controller.php';

//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!

$controller = new Controller();


$controller->render($_GET, $_POST);