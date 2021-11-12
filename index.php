<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
//    echo '<h2>$_COOKIE</h2>';
//    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
//include all your model files here
require 'Model/Connection.php';
require 'Model/Customer.php';
require 'Model/CustomerLoader.php';
require 'Model/CustomerGroup.php';
require 'Model/Product.php';
require 'Model/ProductLoader.php';
require 'Model/Calculator.php';
require ".env";

//include all your controllers here
require 'Controller/Controller.php';

//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!

$controller = new Controller();
if (!empty($_POST['login'])){
    $_SESSION['customer'] = $_POST['login'];
}
if (!empty($_POST['product'])) {
    $_SESSION['customer'] = $_POST['customer'];
    $_SESSION['product'] = $_POST['product'];
    $_SESSION['quantity'] = (int)$_POST['quantity'];
}
if (!empty($_POST['low']) || !empty($_POST['med']) || !empty($_POST['high'])){
    $_POST['login'] = $_SESSION['customer'];
}

whatIsHappening();
$controller->render($_GET, $_POST);

