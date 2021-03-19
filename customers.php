<?php
include 'includes/cons.php';
if (! isset($_SESSION['user'])) {
    include_once 'funcs/login.php';
    displayLoginPage('');
}else if (isset($_POST['action']) && "add_customer" == $_POST['action']) {
    include 'funcs/customer.php';
    addCustomer();
    $page = $_SERVER['HTTP_REFERER'];
    if (strpos($page, 'customers.php') !== false) {
        header('Location: customers.php');
    }else{
        header('Location: index.php?action=showsendMoneyForm');
    }
}else if (isset($_GET['action']) && "showFormToAddCustomer" == $_GET['action']) {
    include 'funcs/customer.php';
    echo showFormToAddCustomer();
    //header('Location: index.php');
}else if (isset($_POST['action']) && "getAllValidCustomers" == $_POST['action']) {
    return "Hi";
    //header('Location: index.php');
}else{
    include_once 'includes/pageCustomer.php';
}?>